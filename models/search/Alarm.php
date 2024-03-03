<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alarm as AlarmModel;

/**
 * Alarm represents the model behind the search form of `app\models\Alarm`.
 */
class Alarm extends AlarmModel
{
    /**
     * {@inheritdoc}
     */

     
    public function rules()
    {
        return [
            [['alarm_id', 'alarm_type', 'alarm_operator', 'alarm_reference', 'alarm_reading_periodicity'], 'integer'],
            [['alarm_name', 'alarm_description', 'alarm_week_days', 'alarm_start_time', 'alarm_end_time', 'alarm_emails'], 'safe'],
            [['alarm_active'], 'boolean'],
            [['alarm_value', 'alarm_tolerance', 'alarm_limit'], 'number'],
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
        $query = AlarmModel::find();

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
            'alarm_id' => $this->alarm_id,
            'alarm_type' => $this->alarm_type,
            'alarm_active' => $this->alarm_active,
            'alarm_operator' => $this->alarm_operator,
            'alarm_reference' => $this->alarm_reference,
            'alarm_value' => $this->alarm_value,
            'alarm_tolerance' => $this->alarm_tolerance,
            'alarm_reading_periodicity' => $this->alarm_reading_periodicity,
            'alarm_limit' => $this->alarm_limit,
            'alarm_start_time' => $this->alarm_start_time,
            'alarm_end_time' => $this->alarm_end_time,
        ]);

        $query->andFilterWhere(['ilike', 'alarm_name', $this->alarm_name])
            ->andFilterWhere(['ilike', 'alarm_description', $this->alarm_description])
            ->andFilterWhere(['ilike', 'alarm_week_days', $this->alarm_week_days])
            ->andFilterWhere(['ilike', 'alarm_emails', $this->alarm_emails]);

        return $dataProvider;
    }
}
