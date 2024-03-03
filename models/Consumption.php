<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.consumption".
 *
 * @property int $consumption_id
 * @property float|null $consumption_value
 * @property string $consumption_date_register
 * @property int|null $consumption_type Coluna que registra o tipo consumo:  1 - Água 2 -  Energia 3 - Diesel 4 - Gás
 * @property float|null $consumption_reverse_pules Armazena pulsos reservados (principalmente no caso aparelhos DuoDigit - SigFox)
 * @property float|null $consumption_circuit_temperature
 * @property float|null $consumption_battery_voltage
 * @property string|null $consumption_flags #Se dispositivo for DuoDigit (Sigfox) --> Ler bits da direita para esquerda (position 0 até 7)  Flag dispositivo comissionado bit0 = 1 Flag alarme acionado bit1 = 1 Flag transmissão IHM bit2 = 1 Flag comissionamento IHM bit3 = 1 Flag transmissão com pedido de downlink bit4 = 1 Flag bateria fraca bit5 = 1 Flag autoriza operar valvula bit6 = 1 Flag mensagem de teste via software bit7 = 1
 * @property string|null $consumption_datetime
 * @property float|null $consumption_full_value
 */
class Consumption extends \yii\db\ActiveRecord
{

    public $month_number;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.consumption';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['consumption_value', 'consumption_reverse_pules', 'consumption_circuit_temperature', 'consumption_battery_voltage', 'consumption_full_value'], 'number'],
            [['consumption_date_register'], 'required'],
            [['consumption_date_register', 'consumption_datetime'], 'safe'],
            [['consumption_type'], 'default', 'value' => null],
            [['consumption_type'], 'integer'],
            [['consumption_flags'], 'string'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consumption_id' => 'Consumption ID',
            'consumption_value' => 'Consumption Value',
            'consumption_date_register' => 'Consumption Date Register',
            'consumption_type' => 'Consumption Type',
            'consumption_reverse_pules' => 'Consumption Reverse Pules',
            'consumption_circuit_temperature' => 'Consumption Circuit Temperature',
            'consumption_battery_voltage' => 'Consumption Battery Voltage',
            'consumption_flags' => 'Consumption Flags',
            'consumption_datetime' => 'Consumption Datetime',
            'consumption_full_value' => 'Consumption Full Value',
        ];
    }

    public function getDeviceMessage()
    {
        return $this->hasOne(DeviceMessage::class, ['message_id' => 'fk_message_id']);
    }

    public function getSiteDevice()
    {
        return $this->hasOne(SiteDevice::class, ['device_id' => 'fk_device_id']);
    }

    public function getSite()
    {
        return $this->hasOne(Sites::class, ['site_id' => 'fk_site_id']);
    }

    public function getMessageConsumption()
    {
        return $this->hasOne(MessageConsumption::class, ['fk_consumption_id' => 'consumption_id']);
    }
}
