<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message as MessageModel;

/**
 * Message represents the model behind the search form of `app\models\Message`.
 */
class Message extends MessageModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_id', 'message_seq_number'], 'integer'],
            [['message_date_register', 'message_data', 'message_time', 'message_device_id'], 'safe'],
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
        $query = MessageModel::find();

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
            'message_id' => $this->message_id,
            'message_date_register' => $this->message_date_register,
            'message_seq_number' => $this->message_seq_number,
        ]);

        $query->andFilterWhere(['ilike', 'message_data', $this->message_data])
            ->andFilterWhere(['ilike', 'message_time', $this->message_time])
            ->andFilterWhere(['ilike', 'message_device_id', $this->message_device_id]);

        return $dataProvider;
    }
}
