<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.hardware".
 *
 * @property int $hardware_id
 * @property string $hardware_name
 * @property string $hardware_date_register
 */
class Hardware extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.hardware';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hardware_name', 'hardware_date_register'], 'required'],
            [['hardware_name'], 'string'],
            [['hardware_date_register'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hardware_id' => 'Hardware ID',
            'hardware_name' => 'Hardware Name',
            'hardware_date_register' => 'Hardware Date Register',
        ];
    }
}
