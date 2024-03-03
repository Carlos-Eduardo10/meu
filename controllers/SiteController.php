<?php

namespace app\controllers;

use app\models\BranchSite;
use app\models\ClientBranch;
use app\models\ClientUser;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ResetForm;
use app\models\ResetFormForm;
use app\models\User;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        
        return $this->redirect('/sites');
        // return $this->render('index');
    }

    

    public function actionCalendario()
    {
        return $this->render('calendario');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'authentication';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/sites/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/sites/index');
        }
        
        $model1 = new LoginForm();
        if ($model1->load(Yii::$app->request->post()) && $model->sendEmail($model1->email)) {
            Yii::$app->session->setFlash('success', 'Os dados para recuperar sua senha foram enviados para o e-mail: ' . $model1->email);
            return $this->redirect('/site/login');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'model1' => $model1,
        ]);
    }

    public function actionReset($token)
    {
        $this->layout = 'authentication';
        $model = new ResetForm();
        // Encontrar o usuário com base no token
        $user = User::findOne(['user_token' => $token]);
    
        if (!$user) {
            Yii::$app->session->setFlash('error', 'Token Inválido');
            return $this->redirect(['/site/login']);
        }
    
        
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Define a nova senha
            $user->user_password = md5($model->user_password);  // Use MD5 para criptografar a senha
    
            // Salva o usuário com a nova senha
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Senha redefinida com sucesso!');
                return $this->redirect(['/site/login']);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar a nova senha.');
            }
        }
        $model->user_password = '';
        return $this->render('reset', [
            'model' => $model,
        ]);
    }
    



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
