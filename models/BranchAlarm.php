<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.branch_alarm".
 *
 * @property int $fk_branch_id
 * @property int $fk_alarm_id
 */
class BranchAlarm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.branch_alarm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_branch_id', 'fk_alarm_id'], 'required'],
            [['fk_branch_id', 'fk_alarm_id'], 'default', 'value' => null],
            [['fk_branch_id', 'fk_alarm_id'], 'integer'],
            [['fk_alarm_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaAlarm::class, 'targetAttribute' => ['fk_alarm_id' => 'alarm_id']],
            [['fk_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelemetriaBranch::class, 'targetAttribute' => ['fk_branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fk_branch_id' => 'Fk Branch ID',
            'fk_alarm_id' => 'Fk Alarm ID',
        ];
    }
}
