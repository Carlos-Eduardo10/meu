<?php


namespace app\models;

use yii\db\ActiveRecord;

class GroupSite extends ActiveRecord
{
    public static function tableName()
    {
        return 'telemetria.group_site';
    }

    public $site_id;
    public $group_id;

    public function rules()
    {
        return [
            [['fk_site_id', 'fk_group_id'], 'required'],
            [['fk_site_id', 'fk_group_id'], 'integer'],
        ];
    }

    public static function primaryKey()
{
    return ['fk_site_id']; // substitua 'site_id' pelo nome real da coluna que deseja usar como chave primária
}

public function attributeLabels()
    {
        return [
            'fk_site_id' => 'Site',
            'fk_group_id' => 'Grupo',
        ];
    }

    // Defina as regras de validação e outros métodos relacionados ao modelo aqui, se necessário
}
