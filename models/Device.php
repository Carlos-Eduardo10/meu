<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.device".
 *
 * @property string $device_id
 * @property bool $device_active
 * @property string $device_date_register
 * @property string|null $device_description
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'device_active', 'device_date_register'], 'required'],
            [['device_id', 'device_description'], 'string'],
            [['device_active'], 'boolean'],
            [['device_date_register'], 'safe'],
            [['device_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'device_id' => 'Código',
            'device_active' => 'Status',
            'device_date_register' => 'Data de Cadastro',
            'device_description' => 'Descrição',
        ];
    }

    /**
     * Define a relação com SiteDevice.
     * @return ActiveQuery
     */
    public function getSiteDevice()
    {
        return $this->hasOne(SiteDevice::class, ['fk_device_id' => 'device_id']);
    }
}
