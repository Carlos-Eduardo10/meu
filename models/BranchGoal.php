<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.branch_goal".
 *
 * @property int $fk_branch_id
 * @property int $fk_goal_id
 */
class BranchGoal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.branch_goal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_branch_id', 'fk_goal_id'], 'required'],
            [['fk_branch_id', 'fk_goal_id'], 'default', 'value' => null],
            [['fk_branch_id', 'fk_goal_id'], 'integer'],
            [['fk_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaBranch::class, 'targetAttribute' => ['fk_branch_id' => 'branch_id']],
            [['fk_goal_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaGoal::class, 'targetAttribute' => ['fk_goal_id' => 'goal_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_branch_id' => 'Fk Branch ID',
            'fk_goal_id' => 'Fk Goal ID',
        ];
    }
}
