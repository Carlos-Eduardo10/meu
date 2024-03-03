<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Country as CountryModel;

/**
 * Country represents the model behind the search form of `app\models\Country`.
 */
class Country extends CountryModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['country_city_code', 'country_city_name', 'country_state_code', 'country_name', 'country_code', 'country_state_name'], 'safe'],
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
        $query = CountryModel::find();

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
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['ilike', 'country_city_code', $this->country_city_code])
            ->andFilterWhere(['ilike', 'country_city_name', $this->country_city_name])
            ->andFilterWhere(['ilike', 'country_state_code', $this->country_state_code])
            ->andFilterWhere(['ilike', 'country_name', $this->country_name])
            ->andFilterWhere(['ilike', 'country_code', $this->country_code])
            ->andFilterWhere(['ilike', 'country_state_name', $this->country_state_name]);

        return $dataProvider;
    }
}
