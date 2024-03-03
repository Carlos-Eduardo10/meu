<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.message".
 *
 * @property int $message_id
 * @property string $message_date_register
 * @property string|null $message_data
 * @property string|null $message_time
 * @property int|null $message_seq_number
 * @property string|null $message_device_id
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_date_register'], 'required'],
            [['message_date_register'], 'safe'],
            [['message_data', 'message_time', 'message_device_id'], 'string'],
            [['message_seq_number'], 'default', 'value' => null],
            [['message_seq_number'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'Message ID',
            'message_date_register' => 'Message Date Register',
            'message_data' => 'Message Data',
            'message_time' => 'Message Time',
            'message_seq_number' => 'Message Seq Number',
            'message_device_id' => 'Message Device ID',
        ];
    }
}
