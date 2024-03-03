<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hardware as HardwareModel;

/**
 * Hardware represents the model behind the search form of `app\models\Hardware`.
 */
class Hardware extends HardwareModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hardware_id'], 'integer'],
            [['hardware_name', 'hardware_date_register'], 'safe'],
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
        $query = HardwareModel::find();

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
            'hardware_id' => $this->hardware_id,
            'hardware_date_register' => $this->hardware_date_register,
        ]);

        $query->andFilterWhere(['ilike', 'hardware_name', $this->hardware_name]);

        return $dataProvider;
    }
}
