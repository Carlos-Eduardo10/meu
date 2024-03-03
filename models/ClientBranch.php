<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.client_branch".
 *
 * @property int $fk_client_id
 * @property int $fk_branch_id
 */
class ClientBranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.client_branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_client_id', 'fk_branch_id'], 'required'],
            [['fk_client_id', 'fk_branch_id'], 'default', 'value' => null],
            [['fk_client_id', 'fk_branch_id'], 'integer'],
            [['fk_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaBranch::class, 'targetAttribute' => ['fk_branch_id' => 'branch_id']],
            [['fk_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaClient::class, 'targetAttribute' => ['fk_client_id' => 'client_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_client_id' => 'Fk Client ID',
            'fk_branch_id' => 'Fk Branch ID',
        ];
    }

    /**
     * Define a relação com BranchSite.
     * @return ActiveQuery
     */
    public function getBranchSite()
    {
        return $this->hasMany(BranchSite::class, ['fk_branch_id' => 'fk_branch_id']);
    }

    /**
     * Define a relação com ClientUser.
     * @return ActiveQuery
     */
    public function getClientUser()
    {
        return $this->hasOne(ClientUser::class, ['fk_client_id' => 'fk_client_id']);
    }
}
