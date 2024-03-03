<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.device_message".
 *
 * @property string $fk_device_id
 * @property int $fk_message_id
 */
class DeviceMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.device_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_device_id', 'fk_message_id'], 'required'],
            [['fk_device_id'], 'string'],
            [['fk_message_id'], 'default', 'value' => null],
            [['fk_message_id'], 'integer'],
            [['fk_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaDevice::class, 'targetAttribute' => ['fk_device_id' => 'device_id']],
            [['fk_message_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaMessage::class, 'targetAttribute' => ['fk_message_id' => 'message_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_device_id' => 'Fk Device ID',
            'fk_message_id' => 'Fk Message ID',
        ];
    }

    public function getSiteDevice()
    {
        return $this->hasOne(SiteDevice::class, ['fk_device_id' => 'fk_device_id']);
    }
}
