<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Branch as BranchModel;

/**
 * Branch represents the model behind the search form of `app\models\Branch`.
 */
class Branch extends BranchModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'branch_description', 'branch_date_register', 'branch_code', 'branch_cnpj', 'branch_zip_code', 'branch_adress', 'branch_country', 'branch_state', 'branch_city', 'branch_latitude', 'branch_longitude'], 'safe'],
            [['branch_active'], 'boolean'],
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
        $query = BranchModel::find();

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
            'branch_id' => $this->branch_id,
            'branch_date_register' => $this->branch_date_register,
            'branch_active' => $this->branch_active,
        ]);

        $query->andFilterWhere(['ilike', 'branch_name', $this->branch_name])
            ->andFilterWhere(['ilike', 'branch_description', $this->branch_description])
            ->andFilterWhere(['ilike', 'branch_code', $this->branch_code])
            ->andFilterWhere(['ilike', 'branch_cnpj', $this->branch_cnpj])
            ->andFilterWhere(['ilike', 'branch_zip_code', $this->branch_zip_code])
            ->andFilterWhere(['ilike', 'branch_adress', $this->branch_adress])
            ->andFilterWhere(['ilike', 'branch_country', $this->branch_country])
            ->andFilterWhere(['ilike', 'branch_state', $this->branch_state])
            ->andFilterWhere(['ilike', 'branch_city', $this->branch_city])
            ->andFilterWhere(['ilike', 'branch_latitude', $this->branch_latitude])
            ->andFilterWhere(['ilike', 'branch_longitude', $this->branch_longitude]);

        return $dataProvider;
    }
}
