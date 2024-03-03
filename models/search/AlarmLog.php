<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AlarmLog as AlarmLogModel;
use app\models\Dashboard;
use app\models\SiteAlarm;
use app\models\Sites;
use yii\db\Expression;



/**
 * AlarmLog represents the model behind the search form of `app\models\AlarmLog`.
 */
class AlarmLog extends AlarmLogModel
{
     public $Date; // Novo atributo virtual
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alarmlog_id', 'alarmlog_origin', 'alarmlog_table_id', 'alarmlog_status', 'alarmlog_type'], 'integer'],
            [['alarmlog_email', 'alarmlog_table_name', 'alarmlog_description', 'alarmlog_date','Date'], 'safe'],
        ];
    }
    public $dateRange; // Adicione esta linha para definir o atributo dateRange

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
        $query = AlarmLogModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['in', 'alarmlog_table_id', Dashboard::sitesParaConsultaGeral()]);

        // grid filtering conditions
        $query->andFilterWhere([
            'alarmlog_id' => $this->alarmlog_id,
            'alarmlog_origin' => $this->alarmlog_origin,
            'alarmlog_table_id' => $this->alarmlog_table_id,
            'alarmlog_status' => $this->alarmlog_status,
            'alarmlog_type' => $this->alarmlog_type,
            'alarmlog_date' => $this->alarmlog_date,
            

        ]);
        if (!empty($this->Date)) {
            $query->andWhere(['like', new Expression("TO_CHAR(alarmlog_date, 'DD/MM/YYYY HH24:MI:SS')"), $this->Date]);
        }
        $query->andFilterWhere(['ilike', 'alarmlog_email', $this->alarmlog_email])
            ->andFilterWhere(['ilike', 'alarmlog_table_name', $this->alarmlog_table_name])
            ->andFilterWhere(['ilike', 'alarmlog_description', $this->alarmlog_description]);

        $query->orderBy('alarmlog_date DESC');

        return $dataProvider;
    }
}




