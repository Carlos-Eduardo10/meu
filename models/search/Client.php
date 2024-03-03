<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client as ClientModel;

/**
 * Client represents the model behind the search form of `app\models\Client`.
 */
class Client extends ClientModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['client_name', 'client_description', 'client_date_register', 'client_code', 'client_cnpj', 'client_zip_code', 'client_adress', 'client_country', 'client_state', 'client_city', 'client_latitude', 'client_longitude', 'client_image_url'], 'safe'],
            [['client_active'], 'boolean'],
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
        $query = ClientModel::find();

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
            'client_id' => $this->client_id,
            'client_date_register' => $this->client_date_register,
            'client_active' => $this->client_active,
        ]);

        $query->andFilterWhere(['ilike', 'client_name', $this->client_name])
            ->andFilterWhere(['ilike', 'client_description', $this->client_description])
            ->andFilterWhere(['ilike', 'client_code', $this->client_code])
            ->andFilterWhere(['ilike', 'client_cnpj', $this->client_cnpj])
            ->andFilterWhere(['ilike', 'client_zip_code', $this->client_zip_code])
            ->andFilterWhere(['ilike', 'client_adress', $this->client_adress])
            ->andFilterWhere(['ilike', 'client_country', $this->client_country])
            ->andFilterWhere(['ilike', 'client_state', $this->client_state])
            ->andFilterWhere(['ilike', 'client_city', $this->client_city])
            ->andFilterWhere(['ilike', 'client_latitude', $this->client_latitude])
            ->andFilterWhere(['ilike', 'client_longitude', $this->client_longitude])
            ->andFilterWhere(['ilike', 'client_image_url', $this->client_image_url]);

        return $dataProvider;
    }
}
