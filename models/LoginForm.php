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
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $email;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // email is string
            [['email'], 'string'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Usuário',
            'password' => 'Senha',
            'rememberMe' => 'Lembrar de mim'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuário ou senha inválidos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function sendEmail($email)
    {
        $user = User::findOne(['user_email' => $email]);
        if ($user) {
            
            if(!$user->user_token){
                $token = Yii::$app->security->generateRandomString();
                $user->user_token = $token;
                $user->save();
            } else {
                $token = $user->user_token;
            }

            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(['no-reply@wenergy.com.br' => 'Plataforma W-Energy'])
                ->setSubject('Recuperação de senha')
                ->setHtmlBody('
              <body style="font-size:18px;">
              <div id="info" style="font-size:15px; color:red;">
                  Este um e-mail automático gerado pelo software de *Telemetria - W-Energy*. Não responda essa mensagem.
              </div>
              <p><b>Olá, ' . $email . '!</b></p>
              <p>Sua solicitação de recuperação de senha foi recebida. Acesse o link abaixo para criar uma nova senha de acesso.</p>
              <p><b>Usuário:</b> ' . $email . '</p>          
              <p><a href="https://app.wenergy.com.br/site/reset?token=' . $token . '">Clique aqui para redefinir sua senha</a></p>       
              </body>')
                ->send();

            return true;
        } else {
            Yii::$app->session->setFlash('error', 'Usuário não encontrado');
        }
    }
}
