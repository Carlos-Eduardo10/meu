<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Network as NetworkModel;

/**
 * Network represents the model behind the search form of `app\models\Network`.
 */
class Network extends NetworkModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network_id'], 'integer'],
            [['network_data_register', 'network_name', 'network_description', 'network_slug'], 'safe'],
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
        $query = NetworkModel::find();

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
            'network_id' => $this->network_id,
            'network_data_register' => $this->network_data_register,
        ]);

        $query->andFilterWhere(['ilike', 'network_name', $this->network_name])
            ->andFilterWhere(['ilike', 'network_description', $this->network_description])
            ->andFilterWhere(['ilike', 'network_slug', $this->network_slug]);

        return $dataProvider;
    }
}
