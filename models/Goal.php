<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.goal".
 *
 * @property int $goal_id
 * @property string $goal_name
 * @property string|null $goal_description
 * @property string $goal_date_register
 * @property int $goal_type 1 - Consumo (m3) 2 - Percentual (%)
 * @property int $goal_year
 * @property float|null $goal_percentage_min
 * @property float|null $goal_percentage_max
 * @property float|null $goal_value Campo, em array, que permite armazenar uma coleção de dados (ex: meta mês a mês do goal_type do tipo 1)
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.goal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goal_name', 'goal_date_register', 'goal_type', 'goal_year'], 'required'],
            [['goal_name', 'goal_description'], 'string'],
            [['goal_date_register'], 'safe'],
            [['goal_type', 'goal_year'], 'default', 'value' => null],
            [['goal_type', 'goal_year'], 'integer'],
            [['goal_percentage_min', 'goal_percentage_max', 'goal_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'goal_id' => 'Goal ID',
            'goal_name' => 'Goal Name',
            'goal_description' => 'Goal Description',
            'goal_date_register' => 'Goal Date Register',
            'goal_type' => 'Goal Type',
            'goal_year' => 'Goal Year',
            'goal_percentage_min' => 'Goal Percentage Min',
            'goal_percentage_max' => 'Goal Percentage Max',
            'goal_value' => 'Goal Value',
        ];
    }
}
