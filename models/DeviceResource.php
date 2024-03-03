<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.device_resource".
 *
 * @property string $fk_device_id
 * @property int $fk_resource_id
 */
class DeviceResource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.device_resource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_device_id', 'fk_resource_id'], 'required'],
            [['fk_device_id'], 'string'],
            [['fk_resource_id'], 'default', 'value' => null],
            [['fk_resource_id'], 'integer'],
            [['fk_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaDevice::class, 'targetAttribute' => ['fk_device_id' => 'device_id']],
            [['fk_resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaResource::class, 'targetAttribute' => ['fk_resource_id' => 'resource_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_device_id' => 'Fk Device ID',
            'fk_resource_id' => 'Fk Resource ID',
        ];
    }
}
