<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.branch".
 *
 * @property int $branch_id
 * @property string $branch_name
 * @property string|null $branch_description
 * @property string $branch_date_register
 * @property bool $branch_active
 * @property string|null $branch_code Código único da unidade que deverá ser gerado com a combinação do HASH "client_code" + hash único.
 * @property string $branch_cnpj
 * @property string $branch_zip_code
 * @property string $branch_adress
 * @property string $branch_country
 * @property string $branch_state
 * @property string $branch_city
 * @property string|null $branch_latitude
 * @property string|null $branch_longitude
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_name', 'branch_date_register', 'branch_active', 'branch_cnpj', 'branch_zip_code', 'branch_adress', 'branch_country', 'branch_state', 'branch_city'], 'required'],
            [['branch_name', 'branch_description', 'branch_code', 'branch_cnpj', 'branch_zip_code', 'branch_adress', 'branch_country', 'branch_state', 'branch_city', 'branch_latitude', 'branch_longitude'], 'string'],
            [['branch_date_register'], 'safe'],
            [['branch_active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_name' => 'Branch Name',
            'branch_description' => 'Branch Description',
            'branch_date_register' => 'Branch Date Register',
            'branch_active' => 'Branch Active',
            'branch_code' => 'Branch Code',
            'branch_cnpj' => 'Branch Cnpj',
            'branch_zip_code' => 'Branch Zip Code',
            'branch_adress' => 'Branch Adress',
            'branch_country' => 'Branch Country',
            'branch_state' => 'Branch State',
            'branch_city' => 'Branch City',
            'branch_latitude' => 'Branch Latitude',
            'branch_longitude' => 'Branch Longitude',
        ];
    }

    /**
     * Define a relação com BranchSite.
     * @return ActiveQuery
     */
    public function getBranchSite()
    {
        return $this->hasMany(BranchSite::class, ['fk_branch_id' => 'branch_id']);
    }

    /**
     * Define a relação com ClientBranch.
     * @return ActiveQuery
     */
    public function getClientBranch()
    {
        return $this->hasMany(ClientBranch::class, ['fk_branch_id' => 'branch_id']);
    }

    /**
     * Define a relação com ClientUser através de ClientBranch.
     * @return ActiveQuery
     */
    public function getClientUser()
    {
        return $this->hasMany(ClientUser::class, ['fk_client_id' => 'fk_client_id'])
            ->via('clientBranche');
    }

    /**
     * Define a relação com Site através de BranchSite.
     * @return ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::class, ['site_id' => 'fk_site_id'])
            ->via('branchSite');
    }
}
