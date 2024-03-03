<?php

namespace app\controllers;

use app\models\Alarm;
use app\models\AlarmLog as ModelsAlarmLog;
use app\models\ClientUser;
use app\models\Dashboard;
use app\models\search\Alarm as AlarmSearch;
use app\models\search\AlarmLog;
use app\models\SiteAlarm as ModelsSiteAlarm;
use app\models\Sites;
use Yii;
use yii\db\IntegrityException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AlarmController implements the CRUD actions for Alarm model.
 */
class AlarmController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Alarm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $searchModel = new AlarmLog();
        $dataProvider = $searchModel->search($this->request->queryParams);


        $total = ModelsAlarmLog::find()->where(['in', 'alarmlog_table_id', Dashboard::sitesParaConsultaGeral()])->count();
        $abertos = ModelsAlarmLog::find()->where(['in', 'alarmlog_table_id', Dashboard::sitesParaConsultaGeral()])->andWhere(['alarmlog_status' => 1])->count();
        $fechados = $total - $abertos;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalizador' => ['total' => $total, 'abertos' => $abertos, 'fechados' => $fechados]
        ]);
    }

    public function actionGetAlarms()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $alarms = ModelsAlarmLog::find()
            ->where(['in', 'alarmlog_table_id', Dashboard::sitesParaConsultaGeral()])
            ->orderBy('alarmlog_date DESC')
            ->limit(5)
            ->all();

        return $alarms;
    }


    public function actionCriar()
    {

        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $searchModel = new AlarmSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $model = new Alarm();
        $model->alarm_active = true;
        $sites = ModelsSiteAlarm::sitesParaConsulta();

        $query1 = ArrayHelper::map($sites, 'site_id', 'site_name');


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($model->site_id as $siteId) {
                    $siteAlarm = new ModelsSiteAlarm();
                    $siteAlarm->fk_site_id = $siteId;
                    $siteAlarm->fk_alarm_id = $model->alarm_id;
                    $siteAlarm->save();
                }
                return $this->redirect(['criar']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('criar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'query1' => $query1,
        ]);
    }

    /**
     * Displays a single Alarm model.
     * @param int $alarm_id Alarm ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($alarm_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($alarm_id),
        ]);
    }

    /**
     * Creates a new Alarm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {


        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $model = new Alarm();
        $model->alarm_active = true;
        $sites = ModelsSiteAlarm::sitesParaConsulta();

        $query1 = ArrayHelper::map($sites, 'site_id', 'site_name');


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($model->site_id as $siteId) {
                    $siteAlarm = new ModelsSiteAlarm();
                    $siteAlarm->fk_site_id = $siteId;
                    $siteAlarm->fk_alarm_id = $model->alarm_id;
                    $siteAlarm->save();
                }
                return $this->redirect(['criar']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'query1' => $query1,
        ]);
    }

    /**
     * Updates an existing Alarm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $alarm_id Alarm ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($alarm_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $model = $this->findModel($alarm_id);
        $model->alarm_emails = $model->alarm_emails->getValue();
        $sites = ModelsSiteAlarm::sitesParaConsulta();
        $query1 = ArrayHelper::map($sites, 'site_id', 'site_name');

        // Carregando os ModelsSiteAlarm associados ao Alarm
        $siteAlarms = ModelsSiteAlarm::findAll(['fk_alarm_id' => $alarm_id]);

        // Criando uma lista de IDs dos Sites associados ao Alarm
        $model->site_id = ArrayHelper::getColumn($siteAlarms, 'fk_site_id');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                ModelsSiteAlarm::deleteAll(['fk_alarm_id' => $model->alarm_id]);
                foreach ($model->site_id as $siteId) {
                    $siteAlarm = new ModelsSiteAlarm();
                    $siteAlarm->fk_site_id = $siteId;
                    $siteAlarm->fk_alarm_id = $model->alarm_id;
                    $siteAlarm->save();
                }
                return $this->redirect(['criar']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'query1' => $query1,
        ]);
    }

    /**
     * Deletes an existing Alarm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $alarm_id Alarm ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($alarm_id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($alarm_id);
        ModelsSiteAlarm::deleteAll(['fk_alarm_id' => $alarm_id]);
        $model->delete();
        $session->setFlash('success', 'Registro excluído com sucesso.');
        return $this->redirect(['criar']);
    }

    /**
     * Finds the Alarm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $alarm_id Alarm ID
     * @return Alarm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alarm_id)
    {
        if (($model = Alarm::findOne(['alarm_id' => $alarm_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
