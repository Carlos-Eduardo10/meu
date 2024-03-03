<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class ResetForm extends Model
{

    public $user_password;
    public $confirm_password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // password is required
            [['user_password'], 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'user_password', 'message' => 'As senhas não coincidem.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_password' => 'Senha'
        ];
    }

}
