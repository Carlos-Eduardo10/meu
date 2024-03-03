<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Config as ConfigModel;

/**
 * Config represents the model behind the search form of `app\models\Config`.
 */
class Config extends ConfigModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['config_id', 'config_table_id', 'config_type'], 'integer'],
            [['config_date_register', 'config_table_name', 'config_value', 'config_description'], 'safe'],
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
        $query = ConfigModel::find();

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
            'config_id' => $this->config_id,
            'config_date_register' => $this->config_date_register,
            'config_table_id' => $this->config_table_id,
            'config_type' => $this->config_type,
        ]);

        $query->andFilterWhere(['ilike', 'config_table_name', $this->config_table_name])
            ->andFilterWhere(['ilike', 'config_value', $this->config_value])
            ->andFilterWhere(['ilike', 'config_description', $this->config_description]);

        return $dataProvider;
    }
}
