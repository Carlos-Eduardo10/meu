<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Device as DeviceModel;

/**
 * Device represents the model behind the search form of `app\models\Device`.
 */
class Device extends DeviceModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'device_date_register', 'device_description'], 'safe'],
            [['device_active'], 'boolean'],
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
    public function search($params, $id)
    {
        $query = DeviceModel::find()
        ->from(['telemetria.view_site_device'])
        ->where(['site_id' => $id]); // Adicione o filtro pelo ID aqui

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
            'device_active' => $this->device_active,
            'device_date_register' => $this->device_date_register,
        ]);

        $query->andFilterWhere(['ilike', 'device_id', $this->device_id])
            ->andFilterWhere(['ilike', 'device_description', $this->device_description]);

        return $dataProvider;
    }

    
}
