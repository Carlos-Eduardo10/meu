<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sites as SitesModel;

/**
 * Sites represents the model behind the search form of `app\models\Sites`.
 */
class Sites extends SitesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_id'], 'integer'],
            [['site_name', 'site_date_register'], 'safe'],
            [['site_active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */


    public function search($params)
    {
        $query = Sites::find()
            ->joinWith(['userSite'])
            ->where(['user_site.fk_user_id' => \Yii::$app->user->identity->user_id]);


        // Criar o provedor de dados com a consulta filtrada
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'site_id' => $this->site_id,
            'site_date_register' => $this->site_date_register,
            'site_active' => $this->site_active,
        ]);

        $query->andFilterWhere(['ilike', 'site_name', $this->site_name]);

        return $dataProvider;
    }
}
