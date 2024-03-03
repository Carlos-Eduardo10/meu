<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.alarmlog".
 *
 * @property int $alarmlog_id
 * @property int $alarmlog_origin 1 - Automático  Gerado através da análise automática  2 - Configurado  Fruto dos que são criados no painel de configuração, seja no ambiente ADMIN ou CLIENTE.
 * @property string|null $alarmlog_email
 * @property string|null $alarmlog_table_name
 * @property int|null $alarmlog_table_id
 * @property int|null $alarmlog_status 2 - Verificado (quando alguém abriu o log) 1 - Informado (quando foi disparado, mas ninguém leu a mensagem/log)
 * @property string|null $alarmlog_description
 * @property int|null $alarmlog_type 1 - Meta 2 - Volume consumido 3 - Hardware
 * @property string $alarmlog_date
 */
class AlarmLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.alarmlog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alarmlog_origin', 'alarmlog_date', 'alarmlog_simplified'], 'required'],
            [['alarmlog_origin', 'alarmlog_table_id', 'alarmlog_status', 'alarmlog_type'], 'default', 'value' => null],
            [['alarmlog_origin', 'alarmlog_table_id', 'alarmlog_status', 'alarmlog_type, '], 'integer'],
            [['alarmlog_table_name', 'alarmlog_description'], 'string'],
            [['alarmlog_date', 'alarmlog_email','alarmlog_simplified'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alarmlog_id' => 'Código',
            'alarmlog_origin' => 'Origem',
            'alarmlog_email' => 'E-mails',
            'alarmlog_table_name' => 'Table',
            'alarmlog_table_id' => 'Site',
            'alarmlog_status' => 'Status',
            'alarmlog_description' => 'Descrição',
            'alarmlog_type' => 'Tipo',
            'alarmlog_date' => 'Data',
            'alarmlog_simplified' => 'Data',
            
        ];
    }

    public function getSites()
    {
        return $this->hasOne(Site::class, ['site_id' => 'alarmlog_table_id']);
    }
}
