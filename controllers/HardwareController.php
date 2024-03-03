<?php

namespace app\controllers;

use app\models\Hardware;
use app\models\search\Hardware as HardwareSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HardwareController implements the CRUD actions for Hardware model.
 */
class HardwareController extends Controller
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
     * Lists all Hardware models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HardwareSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hardware model.
     * @param int $hardware_id Hardware ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($hardware_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($hardware_id),
        ]);
    }

    /**
     * Creates a new Hardware model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Hardware();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'hardware_id' => $model->hardware_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hardware model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $hardware_id Hardware ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($hardware_id)
    {
        $model = $this->findModel($hardware_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'hardware_id' => $model->hardware_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hardware model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $hardware_id Hardware ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($hardware_id)
    {
        $this->findModel($hardware_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hardware model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $hardware_id Hardware ID
     * @return Hardware the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($hardware_id)
    {
        if (($model = Hardware::findOne(['hardware_id' => $hardware_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
