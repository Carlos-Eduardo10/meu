<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.hardware_network".
 *
 * @property int $fk_hardware_id
 * @property int $fk_network_id
 */
class HardwareNetwork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.hardware_network';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_hardware_id', 'fk_network_id'], 'required'],
            [['fk_hardware_id', 'fk_network_id'], 'default', 'value' => null],
            [['fk_hardware_id', 'fk_network_id'], 'integer'],
            [['fk_hardware_id', 'fk_hardware_id'], 'unique', 'targetAttribute' => ['fk_hardware_id', 'fk_hardware_id']],
            [['fk_hardware_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaHardware::class, 'targetAttribute' => ['fk_hardware_id' => 'hardware_id']],
            [['fk_network_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaNetwork::class, 'targetAttribute' => ['fk_network_id' => 'network_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_hardware_id' => 'Fk Hardware ID',
            'fk_network_id' => 'Fk Network ID',
        ];
    }
}
