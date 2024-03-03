<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goal as GoalModel;

/**
 * Goal represents the model behind the search form of `app\models\Goal`.
 */
class Goal extends GoalModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goal_id', 'goal_type', 'goal_year'], 'integer'],
            [['goal_name', 'goal_description', 'goal_date_register'], 'safe'],
            [['goal_percentage_min', 'goal_percentage_max', 'goal_value'], 'number'],
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
        $query = GoalModel::find();

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
            'goal_id' => $this->goal_id,
            'goal_date_register' => $this->goal_date_register,
            'goal_type' => $this->goal_type,
            'goal_year' => $this->goal_year,
            'goal_percentage_min' => $this->goal_percentage_min,
            'goal_percentage_max' => $this->goal_percentage_max,
            'goal_value' => $this->goal_value,
        ]);

        $query->andFilterWhere(['ilike', 'goal_name', $this->goal_name])
            ->andFilterWhere(['ilike', 'goal_description', $this->goal_description]);

        return $dataProvider;
    }
}
