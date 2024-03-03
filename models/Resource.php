<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.resource".
 *
 * @property int $resource_id
 * @property string $resource_name
 * @property string|null $resource_description
 * @property string $resource_date_register
 * @property string|null $resource_slug Campo que descreve (char) slug do resource. (ex: "agua", "energia", "gas", "diesel", "etc")
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.resource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_name', 'resource_date_register'], 'required'],
            [['resource_name', 'resource_description', 'resource_slug'], 'string'],
            [['resource_date_register'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resource_id' => 'Resource ID',
            'resource_name' => 'Resource Name',
            'resource_description' => 'Resource Description',
            'resource_date_register' => 'Resource Date Register',
            'resource_slug' => 'Resource Slug',
        ];
    }
}
