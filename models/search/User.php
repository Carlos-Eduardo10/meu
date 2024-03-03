<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User as UserModel;

/**
 * User represents the model behind the search form of `app\models\User`.
 */
class User extends UserModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_type'], 'integer'],
            [['user_name', 'user_description', 'user_date_register', 'user_password', 'user_email', 'user_token'], 'safe'],
            [['user_active', 'user_first_login'], 'boolean'],
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
        $query = UserModel::find();

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
            'user_id' => $this->user_id,
            'user_active' => $this->user_active,
            'user_date_register' => $this->user_date_register,
            'user_type' => $this->user_type,
            'user_first_login' => $this->user_first_login,
        ]);

        $query->andFilterWhere(['ilike', 'user_name', $this->user_name])
            ->andFilterWhere(['ilike', 'user_description', $this->user_description])
            ->andFilterWhere(['ilike', 'user_password', $this->user_password])
            ->andFilterWhere(['ilike', 'user_email', $this->user_email])
            ->andFilterWhere(['ilike', 'user_token', $this->user_token]);

        return $dataProvider;
    }
}
