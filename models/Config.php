<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.config".
 *
 * @property int $config_id
 * @property string $config_date_register
 * @property string $config_table_name
 * @property int $config_table_id
 * @property int $config_type 1 - Base/Referência
 * @property string|null $config_value
 * @property string|null $config_description
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['config_date_register', 'config_table_name', 'config_table_id', 'config_type'], 'required'],
            [['config_date_register'], 'safe'],
            [['config_table_name', 'config_value', 'config_description'], 'string'],
            [['config_table_id', 'config_type'], 'default', 'value' => null],
            [['config_table_id', 'config_type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'config_id' => 'Config ID',
            'config_date_register' => 'Config Date Register',
            'config_table_name' => 'Config Table Name',
            'config_table_id' => 'Config Table ID',
            'config_type' => 'Config Type',
            'config_value' => 'Config Value',
            'config_description' => 'Config Description',
        ];
    }
}
