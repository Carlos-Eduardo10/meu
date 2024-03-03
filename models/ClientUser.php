<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.client_user".
 *
 * @property int $fk_user_id
 * @property int $fk_client_id
 */
class ClientUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.client_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_user_id', 'fk_client_id'], 'required'],
            [['fk_user_id', 'fk_client_id'], 'default', 'value' => null],
            [['fk_user_id', 'fk_client_id'], 'integer'],
            [['fk_user_id', 'fk_user_id'], 'unique', 'targetAttribute' => ['fk_user_id', 'fk_user_id']],
            [['fk_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaClient::class, 'targetAttribute' => ['fk_client_id' => 'client_id']],
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
            'fk_client_id' => 'Fk Client ID',
        ];
    }
    public static function getClientId()
    {
        $userId = Yii::$app->user->id;
        $clientUser = ClientUser::find()
            ->select(['fk_client_id'])
            ->where(['fk_user_id' => $userId])
            ->one();
    
        return $clientUser ? $clientUser->fk_client_id : null;
    }
    
    public static function getClientUrl()
    {
        $clientId = self::getClientId();
        if ($clientId) {
            $client = Client::find()
                ->select(['client_image_url'])
                ->where(['client_id' => $clientId])
                ->one();
    
            return $client ? $client->client_image_url : null;
        }
    
        return null;
    }
    
}
