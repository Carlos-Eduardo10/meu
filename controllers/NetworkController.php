<?php

namespace app\controllers;

use app\models\Network;
use app\models\search\Network as NetworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NetworkController implements the CRUD actions for Network model.
 */
class NetworkController extends Controller
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
     * Lists all Network models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NetworkSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Network model.
     * @param int $network_id Network ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($network_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($network_id),
        ]);
    }

    /**
     * Creates a new Network model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Network();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'network_id' => $model->network_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Network model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $network_id Network ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($network_id)
    {
        $model = $this->findModel($network_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'network_id' => $model->network_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Network model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $network_id Network ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($network_id)
    {
        $this->findModel($network_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Network model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $network_id Network ID
     * @return Network the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($network_id)
    {
        if (($model = Network::findOne(['network_id' => $network_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
