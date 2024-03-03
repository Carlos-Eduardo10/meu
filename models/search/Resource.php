<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resource as ResourceModel;

/**
 * Resource represents the model behind the search form of `app\models\Resource`.
 */
class Resource extends ResourceModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id'], 'integer'],
            [['resource_name', 'resource_description', 'resource_date_register', 'resource_slug'], 'safe'],
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
        $query = ResourceModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'resource_id' => $this->resource_id,
            'resource_date_register' => $this->resource_date_register,
        ]);

        $query->andFilterWhere(['ilike', 'resource_name', $this->resource_name])
            ->andFilterWhere(['ilike', 'resource_description', $this->resource_description])
            ->andFilterWhere(['ilike', 'resource_slug', $this->resource_slug]);

        return $dataProvider;
    }
}
