<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Group as GroupModel;

/**
 * Group represents the model behind the search form of `app\models\Group`.
 */
class Group extends GroupModel
{   

    public $totalSites;

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'totalSites', 'group_resource_type'], 'integer'],
            [['group_name', 'group_active', 'group_date_register'], 'safe'],
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
        $query = GroupModel::find();

        // add conditions that should always apply here

        $query->leftJoin('telemetria.group_site', 'group_id = group_site.fk_group_id')
          ->groupBy('group_id')
          ->select(['group.*', 'COUNT(telemetria.group_site.fk_group_id) AS totalSites']);


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
            'group_id' => $this->group_id,
            'group_resource_type' => $this->group_resource_type,
            'group_date_register' => $this->group_date_register,
        ]);

        $query->andFilterWhere(['ilike', 'group_name', $this->group_name])
            ->andFilterWhere(['ilike', 'group_active', $this->group_active]);

        $query->orderBy('group_name ASC');

        return $dataProvider;
    }
}
