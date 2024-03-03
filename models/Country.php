<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.country".
 *
 * @property int $country_id
 * @property string $country_city_code
 * @property string $country_city_name
 * @property string $country_state_code
 * @property string|null $country_name
 * @property string|null $country_code
 * @property string|null $country_state_name
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_city_code', 'country_city_name', 'country_state_code'], 'required'],
            [['country_city_code', 'country_city_name', 'country_state_code', 'country_name', 'country_code', 'country_state_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'country_city_code' => 'Country City Code',
            'country_city_name' => 'Country City Name',
            'country_state_code' => 'Country State Code',
            'country_name' => 'Country Name',
            'country_code' => 'Country Code',
            'country_state_name' => 'Country State Name',
        ];
    }
}
