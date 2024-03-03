<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.site_device".
 *
 * @property int $fk_site_id
 * @property string $fk_device_id
 * @property string $site_device_start_of_link Registra a data inicial do vínculo do device na unidade
 * @property string|null $site_device_end_of_link Registra a data final do vínculo do device na unidade
 * @property bool $site_device_active
 */
class SiteDevice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.site_device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_site_id', 'fk_device_id', 'site_device_start_of_link', 'site_device_active'], 'required'],
            [['fk_site_id'], 'default', 'value' => null],
            [['fk_site_id'], 'integer'],
            [['fk_device_id'], 'string'],
            [['site_device_start_of_link', 'site_device_end_of_link'], 'safe'],
            [['site_device_active'], 'boolean'],
            [['fk_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaDevice::class, 'targetAttribute' => ['fk_device_id' => 'device_id']],
            [['fk_site_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaSite::class, 'targetAttribute' => ['fk_site_id' => 'site_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_site_id' => 'Fk Site ID',
            'fk_device_id' => 'Fk Device ID',
            'site_device_start_of_link' => 'Site Device Start Of Link',
            'site_device_end_of_link' => 'Site Device End Of Link',
            'site_device_active' => 'Site Device Active',
        ];
    }

    public function getSite()
    {
        return $this->hasOne(Sites::class, ['site_id' => 'fk_site_id']);
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['device_id' => 'fk_device_id']);
    }
}
