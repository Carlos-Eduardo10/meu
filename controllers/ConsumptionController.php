<?php

namespace app\controllers;

use app\models\Consumption;
use app\models\search\Consumption as ConsumptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConsumptionController implements the CRUD actions for Consumption model.
 */
class ConsumptionController extends Controller
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
     * Lists all Consumption models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConsumptionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Consumption model.
     * @param int $consumption_id Consumption ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($consumption_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($consumption_id),
        ]);
    }

    /**
     * Creates a new Consumption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Consumption();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'consumption_id' => $model->consumption_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Consumption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $consumption_id Consumption ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($consumption_id)
    {
        $model = $this->findModel($consumption_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'consumption_id' => $model->consumption_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Consumption model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $consumption_id Consumption ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($consumption_id)
    {
        $this->findModel($consumption_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Consumption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $consumption_id Consumption ID
     * @return Consumption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($consumption_id)
    {
        if (($model = Consumption::findOne(['consumption_id' => $consumption_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
