<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "telemetria.site_alarm".
 *
 * @property int $alarm_id
 * @property int $site_id
 * @property string $alarm_name
 * @property string|null $alarm_description
 * @property int|null $alarm_type 1 - Volume consumo 2 - Vazão 3 - Etc...
 * @property bool $alarm_active
 * @property int|null $alarm_operator Armazena o condicional selecionado na criação do alarme, ou seja, > ou <=
 * @property int|null $alarm_reference Referência:  1 - Meta cadastrada 2 - Constante
 * @property float|null $alarm_value
 * @property float|null $alarm_tolerance Aplicada ao percentual
 * @property int|null $alarm_reading_periodicity 1 - Horária 2 - Diária 3 - Semanal, etc.
 * @property float|null $alarm_limit Percentual para ser acionado
 * @property string|null $alarm_week_days
 * @property string|null $alarm_start_time
 * @property string|null $alarm_end_time
 * @property string|null $alarm_emails
 *
 * @property Site $site Relação com a tabela "sites"
 */
class SiteAlarm extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.site_alarm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // regras de validação aqui
            [['fk_site_id', 'fk_alarm_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // rótulos dos atributos aqui
        ];
    }

    public function getSite()
    {
        return $this->hasOne(Sites::className(), ['site_id' => 'fk_site_id']);
    }


    /**
     * Obtém a associação com a tabela "sites"
     * @return \yii\db\ActiveQuery
     */
    public static function sitesParaConsulta()
    {

        $userId = Yii::$app->user->identity->user_id;
        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column(); // Isso retorna um array com os `site_id`.

        $clientSites = Sites::find()
        ->from('telemetria.view_site')
        ->where(['site_id' => $siteIds])
        ->all();


        return $clientSites;
    }
}
