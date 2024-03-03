<?php

namespace app\controllers;

use app\models\Goal;
use app\models\search\Goal as GoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoalController implements the CRUD actions for Goal model.
 */
class GoalController extends Controller
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
     * Lists all Goal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GoalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goal model.
     * @param int $goal_id Goal ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($goal_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($goal_id),
        ]);
    }

    /**
     * Creates a new Goal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Goal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'goal_id' => $model->goal_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $goal_id Goal ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($goal_id)
    {
        $model = $this->findModel($goal_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'goal_id' => $model->goal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $goal_id Goal ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($goal_id)
    {
        $this->findModel($goal_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $goal_id Goal ID
     * @return Goal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($goal_id)
    {
        if (($model = Goal::findOne(['goal_id' => $goal_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
