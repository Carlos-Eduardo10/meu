<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Consumption as ConsumptionModel;

/**
 * Consumption represents the model behind the search form of `app\models\Consumption`.
 */
class Consumption extends ConsumptionModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['consumption_id', 'consumption_type'], 'integer'],
            [['consumption_value', 'consumption_reverse_pules', 'consumption_circuit_temperature', 'consumption_battery_voltage', 'consumption_full_value'], 'number'],
            [['consumption_date_register', 'consumption_flags', 'consumption_datetime'], 'safe'],
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
        $query = ConsumptionModel::find();

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
            'consumption_id' => $this->consumption_id,
            'consumption_value' => $this->consumption_value,
            'consumption_date_register' => $this->consumption_date_register,
            'consumption_type' => $this->consumption_type,
            'consumption_reverse_pules' => $this->consumption_reverse_pules,
            'consumption_circuit_temperature' => $this->consumption_circuit_temperature,
            'consumption_battery_voltage' => $this->consumption_battery_voltage,
            'consumption_datetime' => $this->consumption_datetime,
            'consumption_full_value' => $this->consumption_full_value,
        ]);

        $query->andFilterWhere(['ilike', 'consumption_flags', $this->consumption_flags]);

        return $dataProvider;
    }
}
