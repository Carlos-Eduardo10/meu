<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.group".
 *
 * @property int $group_id
 * @property string|null $group_name
 * @property string|null $group_active
 * @property string|null $group_date_register
 */
class Group extends \yii\db\ActiveRecord
{
    public $totalSites;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_name', 'group_active'], 'string'],
            [['group_name', 'group_active'], 'required'],
            [['group_date_register', 'group_resource_type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Código',
            'group_name' => 'Nome',
            'group_active' => 'Status',
            'group_date_register' => 'Data de Cadastro',
            'group_resource_type' => 'Recurso',
        ];
    }

    public function getGroupSites()
    {
        return $this->hasMany(GroupSite::className(), ['fk_group_id' => 'group_id']);
    }

    public static function GroupResources()
    {
        $data =  [
            1 => "Água",
            // 2 => "Energia",
            3 => "Gás",
            4 => "Diesel"
        ];

        return $data;
    }

    public static function GroupResourcesLabels($c = null)
    {
        $data = self::GroupResources();
        if ($c) {
            return $data[$c];
        }
        return false;
    }
}
