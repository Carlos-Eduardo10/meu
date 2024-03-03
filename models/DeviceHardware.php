<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.device_hardware".
 *
 * @property string $fk_device_id
 * @property int $fk_hardware_id
 */
class DeviceHardware extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.device_hardware';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_device_id', 'fk_hardware_id'], 'required'],
            [['fk_device_id'], 'string'],
            [['fk_hardware_id'], 'default', 'value' => null],
            [['fk_hardware_id'], 'integer'],
            [['fk_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaDevice::class, 'targetAttribute' => ['fk_device_id' => 'device_id']],
            [['fk_hardware_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaHardware::class, 'targetAttribute' => ['fk_hardware_id' => 'hardware_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_device_id' => 'Fk Device ID',
            'fk_hardware_id' => 'Fk Hardware ID',
        ];
    }
}
