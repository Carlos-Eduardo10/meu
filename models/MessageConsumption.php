<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.message_consumption".
 *
 * @property int $fk_message_id
 * @property int $fk_consumption_id
 */
class MessageConsumption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.message_consumption';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_message_id', 'fk_consumption_id'], 'required'],
            [['fk_message_id', 'fk_consumption_id'], 'default', 'value' => null],
            [['fk_message_id', 'fk_consumption_id'], 'integer'],
            [['fk_consumption_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaConsumption::class, 'targetAttribute' => ['fk_consumption_id' => 'consumption_id']],
            [['fk_message_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaMessage::class, 'targetAttribute' => ['fk_message_id' => 'message_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_message_id' => 'Fk Message ID',
            'fk_consumption_id' => 'Fk Consumption ID',
        ];
    }

    public function getDeviceMessage()
    {
        return $this->hasOne(DeviceMessage::class, ['fk_message_id' => 'fk_message_id']);
    }
}
