<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.client".
 *
 * @property int $client_id
 * @property string $client_name
 * @property string|null $client_description
 * @property string $client_date_register
 * @property bool $client_active
 * @property string|null $client_code Código único do cliente que deverá ser gerado via HASH ou correlato
 * @property string $client_cnpj
 * @property string $client_zip_code
 * @property string $client_adress
 * @property string $client_country
 * @property string $client_state
 * @property string $client_city
 * @property string|null $client_latitude
 * @property string|null $client_longitude
 * @property string|null $client_image_url
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name', 'client_date_register', 'client_active', 'client_cnpj', 'client_zip_code', 'client_adress', 'client_country', 'client_state', 'client_city'], 'required'],
            [['client_name', 'client_description', 'client_code', 'client_cnpj', 'client_zip_code', 'client_adress', 'client_country', 'client_state', 'client_city', 'client_latitude', 'client_longitude', 'client_image_url'], 'string'],
            [['client_date_register'], 'safe'],
            [['client_active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'client_name' => 'Client Name',
            'client_description' => 'Client Description',
            'client_date_register' => 'Client Date Register',
            'client_active' => 'Client Active',
            'client_code' => 'Client Code',
            'client_cnpj' => 'Client Cnpj',
            'client_zip_code' => 'Client Zip Code',
            'client_adress' => 'Client Adress',
            'client_country' => 'Client Country',
            'client_state' => 'Client State',
            'client_city' => 'Client City',
            'client_latitude' => 'Client Latitude',
            'client_longitude' => 'Client Longitude',
            'client_image_url' => 'Client Image Url',
        ];
    }
}
