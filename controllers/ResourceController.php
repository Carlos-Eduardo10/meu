<?php

namespace app\controllers;

use app\models\Resource;
use app\models\search\Resource as ResourceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResourceController implements the CRUD actions for Resource model.
 */
class ResourceController extends Controller
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
     * Lists all Resource models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resource model.
     * @param int $resource_id Resource ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($resource_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($resource_id),
        ]);
    }

    /**
     * Creates a new Resource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Resource();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'resource_id' => $model->resource_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $resource_id Resource ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($resource_id)
    {
        $model = $this->findModel($resource_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'resource_id' => $model->resource_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Resource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $resource_id Resource ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($resource_id)
    {
        $this->findModel($resource_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $resource_id Resource ID
     * @return Resource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($resource_id)
    {
        if (($model = Resource::findOne(['resource_id' => $resource_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
