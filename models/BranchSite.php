<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.branch_site".
 *
 * @property int $fk_branch_id
 * @property int $fk_site_id
 */
class BranchSite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.branch_site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_branch_id', 'fk_site_id'], 'required'],
            [['fk_branch_id', 'fk_site_id'], 'default', 'value' => null],
            [['fk_branch_id', 'fk_site_id'], 'integer'],
            [['fk_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaBranch::class, 'targetAttribute' => ['fk_branch_id' => 'branch_id']],
            [['fk_site_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaSite::class, 'targetAttribute' => ['fk_site_id' => 'site_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_branch_id' => 'Fk Branch ID',
            'fk_site_id' => 'Fk Site ID',
        ];
    }

    public function getSites()
    {
        return $this->hasMany(Sites::class, ['site_id' => 'fk_site_id']);
    }

    /**
     * Define a relação com Site.
     * @return ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::class, ['site_id' => 'fk_site_id']);
    }

    /**
     * Define a relação com Branch.
     * @return ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['branch_id' => 'fk_branch_id']);
    }

    

}
