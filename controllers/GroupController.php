<?php

namespace app\controllers;

use app\models\Dashboard;
use app\models\Group;
use app\models\GroupSite;
use app\models\search\Branch;
use app\models\search\Group as GroupSearch;
use app\models\search\Sites;
use app\models\search\SitesGroup;
use app\models\search\User;
use app\models\UserSite;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
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
     * Lists all Group models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSites($id)
    {
        $searchModel = new SitesGroup();
        $dataProvider = $searchModel->search($this->request->queryParams, $id);
        $group = Group::findOne($id);


        $userId = \Yii::$app->user->identity->user_id;

        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column();

        $siteIdsAdicionados = GroupSite::find()
            ->select('fk_site_id')
            ->where(['fk_group_id' => $group->group_id])
            ->column();

        $query = Sites::find()
            ->from('telemetria.view_site_resource')
            ->where(['site_id' => $siteIds, 'resource_id' => $group->group_resource_type]);

        if (!empty($siteIdsAdicionados)) {
            $query->andWhere(['NOT IN', 'site_id', $siteIdsAdicionados]);
        }

        $model = new GroupSite();
        $model->load($this->request->post());

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success', 'Site vinculado com sucesso.');
                return $this->redirect(['/group/sites', 'id' => $id]);
            }
        } else {
            $model->loadDefaultValues();
        }



        return $this->render('sites', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group' => $group,
            'model' => $model,
            'query' => $query,
        ]);
    }

    public function actionCreatesites($id)
    {

        return $this->render('createsites', []);
    }

    public function actionDeletesite($id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $model = GroupSite::findOne(['fk_site_id' => $id]);
        if ($model) {
            $groupId = $model->fk_group_id;

            // Excluir o site
            $model->delete();

            \Yii::$app->session->setFlash('success', 'Site excluído com sucesso.');
        } else {
            \Yii::$app->session->setFlash('error', 'Não foi possível encontrar o site.');
        }

        return $this->redirect(['/group/sites', 'id' => $groupId]);
    }

    /**
     * Displays a single Group model.
     * @param int $group_id Group ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($group_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($group_id),
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $model = new Group();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success', 'Grupo cadastrado com sucesso.');
                return $this->redirect(['sites', 'id' => $model->group_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $group_id Group ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($group_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }


        $model = $this->findModel($group_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Grupo atualizado com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $group_id Group ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($group_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        GroupSite::deleteAll(['fk_group_id' => $group_id]);
        $this->findModel($group_id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $group_id Group ID
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($group_id)
    {
        if (($model = Group::findOne(['group_id' => $group_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
