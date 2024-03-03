<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.network".
 *
 * @property int $network_id
 * @property string $network_data_register
 * @property string $network_name
 * @property string|null $network_description
 * @property string|null $network_slug Texto (char) que caracteriza a rede (ex: "sigfox", "lorawan", "etc")
 */
class Network extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.network';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network_data_register', 'network_name'], 'required'],
            [['network_data_register'], 'safe'],
            [['network_name', 'network_description', 'network_slug'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'network_id' => 'Network ID',
            'network_data_register' => 'Network Data Register',
            'network_name' => 'Network Name',
            'network_description' => 'Network Description',
            'network_slug' => 'Network Slug',
        ];
    }
}
