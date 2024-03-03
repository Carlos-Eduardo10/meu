<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.client_branch".
 *
 * @property int $fk_client_id
 * @property int $fk_branch_id
 */
class UserSite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.user_site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_user_id', 'fk_site_id'], 'required'],
            [['fk_user_id', 'fk_site_id'], 'default', 'value' => null],
            [['fk_user_id', 'fk_site_id'], 'integer'],
            [['fk_site_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaSite::class, 'targetAttribute' => ['fk_site_id' => 'site_id']],
            [['fk_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaUser::class, 'targetAttribute' => ['fk_user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_user_id' => 'Fk User ID',
            'fk_site_id' => 'Fk Site ID',
        ];
    }
    
    public function getUserSite()
    {
        return $this->hasMany(UserSite::class, ['fk_site_id' => 'site_id']);
    }

}
