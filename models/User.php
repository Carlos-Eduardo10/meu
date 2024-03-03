<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.user".
 *
 * @property int $user_id
 * @property string $user_name
 * @property string|null $user_description
 * @property bool $user_active
 * @property string $user_date_register
 * @property string|null $user_password
 * @property string|null $user_email
 * @property int|null $user_type 1 - Super Administrador (Sistema) 2 - Administrador (W-Energy) 3 - Operador (W-Energy) 4 - Administrador (Cliente) 5 - Operador (Cliente)
 * @property bool $user_first_login
 * @property string|null $user_token
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    public $auth_key;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_active', 'user_date_register', 'user_first_login'], 'required'],
            [['user_name', 'user_description', 'user_password', 'user_email', 'user_token'], 'string'],
            [['user_active', 'user_first_login'], 'boolean'],
            [['user_date_register'], 'safe'],
            [['user_type'], 'default', 'value' => null],
            [['user_type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_description' => 'User Description',
            'user_active' => 'User Active',
            'user_date_register' => 'User Date Register',
            'user_password' => 'User Password',
            'user_email' => 'User Email',
            'user_type' => 'User Type',
            'user_first_login' => 'User First Login',
            'user_token' => 'User Token',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne([
            'user_email' => $username,
            'user_type' => [4, 5],
            'user_active' => true
        ]);
    }


    public function validatePassword($password)
    {
        return $this->user_password === md5($password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        return static::findOne(['user_token' => $token]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function setPassword($password)
    {
        $this->user_password = md5($password);
    }
}
