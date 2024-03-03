<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Alarm;
use app\models\AlarmLog;
use app\models\Consumption;
use app\models\Device;
use app\models\SiteAlarm;
use app\models\SiteDevice;
use app\models\Sites;
use DateTime;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {

        $alarmes = Alarm::find()->where(['alarm_active' => true])->asArray()->all();
        $twoDaysAgo = (new DateTime())->modify('-2 days');

        foreach ($alarmes as $alarme) {
            $currentDay = strtolower(date('l'));
            $currentTime = date('H:i:s');
            $alarmDays = explode(',', trim($alarme['alarm_week_days'], '{}'));
            if (in_array($currentDay, $alarmDays)) {
                if ($currentTime >= $alarme['alarm_start_time'] && $currentTime <= $alarme['alarm_end_time']) {
                    $sites = SiteAlarm::find()
                        ->select('fk_site_id')
                        ->where(['fk_alarm_id' => $alarme['alarm_id']])
                        ->asArray()
                        ->all();


                        foreach ($sites as $site) {
                            $siteInfo = Sites::find()
                                ->where(['site_id' => $site['fk_site_id']])
                                ->andWhere(['not', ['site_active' => true]])
                                ->asArray()
                                ->one();

                        if ($siteInfo) {

                            $lastAlarm = AlarmLog::find()
                                ->where(['alarmlog_table_name' => 'site'])
                                ->andWhere(['alarmlog_origin' => $alarme['alarm_id']])
                                ->andWhere(['alarmlog_table_id' => $site['fk_site_id']])
                                ->andWhere(['alarmlog_type' => 0])
                                ->andWhere(['alarmlog_status' => 1])
                                ->orderBy('alarmlog_date DESC')
                                ->one();

                            $ultimaLeitura = Sites::find()
                                ->select(['v_consumption_value', 'v_consumption_datetime_message', 'v_consumption_datetime'])
                                ->from(['telemetria.view_client_consumption'])
                                ->where(['v_site_id' => $site['fk_site_id']])
                                ->orderBy('v_consumption_datetime DESC')
                                ->asArray()
                                ->one();

                            if (!$ultimaLeitura) {
                                if (!$ultimaLeitura || $ultimaLeitura['v_consumption_value'] <= $twoDaysAgo) {
                                    # Validação não correta if (!$lastAlarm) {

                                    $emails = str_getcsv(trim($alarme['alarm_emails'], '{}'), ',');
                                    $lastAlarm = new AlarmLog();
                                    $lastAlarm->alarmlog_origin = $alarme['alarm_id'];
                                    $email_array = $emails;
                                    $lastAlarm->alarmlog_email = $email_array;
                                    $lastAlarm->alarmlog_table_name = 'site';
                                    $lastAlarm->alarmlog_table_id = $site['fk_site_id'];
                                    $lastAlarm->alarmlog_status = 1;
                                    $lastAlarm->alarmlog_description = "Identificamos que o site " . $siteInfo['site_name'] . " não está mais enviando informações de consumo.";
                                    $lastAlarm->alarmlog_type = 0;

                                    if ($emails) {
                                        \Yii::$app->mailer->compose()
                                            ->setFrom('robogreen@wenergy.com.br')
                                            ->setTo($emails)
                                            ->setHtmlBody("Identificamos que o site " . $siteInfo['site_name'] . " não está mais enviando informações de consumo.")
                                            ->setSubject('W-energy - Nova ocorrência em ' . $siteInfo['site_name'])
                                            ->send();
                                    }
                                }
                                $lastAlarm->alarmlog_date = date('Y-m-d H:i:s');
                                $lastAlarm->save();
                            } else {

                                if ($lastAlarm) {
                                    $lastAlarm->alarmlog_status = 2;
                                    $lastAlarm->save();
                                }

                                $consumo = $ultimaLeitura['v_consumption_value'];
                                $vazao = ($ultimaLeitura['v_consumption_value'] * 1000) / 60;

                                $resultadoLeitura = ($alarme['alarm_type'] === 1) ? $consumo : $vazao;
                                $valorMedicao = $alarme['alarm_value'];

                                $resultadoToleranciaMaior = $valorMedicao + ($valorMedicao * ($alarme['alarm_tolerance'] / 100));
                                $resultadoToleranciaMenor = $valorMedicao - ($valorMedicao * ($alarme['alarm_tolerance'] / 100));

                                $registraAlarme = false;

                                if ($alarme['alarm_operator'] === 1) {
                                    if ($resultadoLeitura > $resultadoToleranciaMaior) {
                                        $registraAlarme = true;
                                    }
                                } else {
                                    if ($resultadoLeitura < $resultadoToleranciaMenor) {
                                        $registraAlarme = true;
                                    }
                                }

                                $lastAlarm = AlarmLog::find()
                                    ->where(['alarmlog_table_name' => 'site'])
                                    ->andWhere(['alarmlog_origin' => $alarme['alarm_id']])
                                    ->andWhere(['alarmlog_table_id' => $site['fk_site_id']])
                                    ->andWhere(['alarmlog_status' => 1])
                                    ->andWhere(['alarmlog_type' => $alarme['alarm_type']])
                                    ->orderBy('alarmlog_date DESC')
                                    ->one();


                                if ($registraAlarme) {
                                    if (!$lastAlarm) {
                                        $date = date('d/m/Y as H:i:s');
                                        $siteName = $siteInfo['site_name'];
                                        $msg = "Em {$date}, o site {$siteName}";
                                        $ultimoConsumo = round($resultadoLeitura, 2);
                                        $gap = ($alarme['alarm_type'] === 1) ? " o consumo " : " a vazão";
                                        $msg .= " registrou {$gap} de {$ultimoConsumo}";
                                        $metaDiaria = ($alarme['alarm_operator'] === 1) ? round($resultadoToleranciaMaior, 2) : round($resultadoToleranciaMenor, 2);
                                        $msg .= " quando a sua meta diária é de {$metaDiaria}";

                                        $emails = str_getcsv(trim($alarme['alarm_emails'], '{}'), ',');
                                        $lastAlarm = new AlarmLog();
                                        $lastAlarm->alarmlog_origin = $alarme['alarm_id'];
                                        $email_array = $emails;
                                        $lastAlarm->alarmlog_email = $email_array;
                                        $lastAlarm->alarmlog_table_name = 'site';
                                        $lastAlarm->alarmlog_table_id = $site['fk_site_id'];
                                        $lastAlarm->alarmlog_status = 1;
                                        $lastAlarm->alarmlog_description = $msg;
                                        $lastAlarm->alarmlog_type = $alarme['alarm_type'];
                                        $lastAlarm->alarmlog_date = date('Y-m-d H:i:s');
                                        $lastAlarm->save();

                                        if ($emails) {
                                            \Yii::$app->mailer->compose()
                                                ->setFrom('robogreen@wenergy.com.br')
                                                ->setTo($emails)
                                                ->setHtmlBody($msg)
                                                ->setSubject('W-energy - Nova ocorrência em ' . $siteInfo['site_name'])
                                                ->send();
                                        }
                                    }
                                } else {
                                    if ($lastAlarm) {
                                        $lastAlarm->alarmlog_status = 2;
                                        $lastAlarm->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return ExitCode::OK;
    }
}
