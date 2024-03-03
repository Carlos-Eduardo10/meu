<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemetria.alarm".
 *
 * @property int $alarm_id
 * @property string $alarm_name
 * @property string|null $alarm_description
 * @property int|null $alarm_type 1 - Volume consumo 2 - Vazão 3 - Etc...
 * @property bool $alarm_active
 * @property int|null $alarm_operator Armazena o condicional selecionado na criação do alarme, ou seja, > ou <=
 * @property int|null $alarm_reference Referência:  1 - Meta cadastrada 2 - Constante
 * @property float|null $alarm_value
 * @property float|null $alarm_tolerance Aplicada ao percentual
 * @property int|null $alarm_reading_periodicity 1 - Horária 2 - Diária 3 - Semanal, etc.
 * @property float|null $alarm_limit Percentual para ser acionado
 * @property string|null $alarm_week_days
 * @property string|null $alarm_start_time
 * @property string|null $alarm_end_time
 * @property string|null $alarm_emails
 */
class Alarm extends \yii\db\ActiveRecord
{

    public $alarm_type_point;
    public $site_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.alarm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alarm_name', 'alarm_active'], 'required'],
            [['alarm_name', 'alarm_description'], 'string'],
            [['alarm_week_days'], 'default', 'value' => null],
            [['alarm_week_days'], 'each', 'rule' => ['string']],
            [['alarm_type', 'alarm_operator', 'alarm_reference', 'alarm_reading_periodicity'], 'default', 'value' => null],
            [['alarm_type', 'alarm_operator', 'alarm_reference', 'alarm_reading_periodicity'], 'integer'],
            [['alarm_active'], 'boolean'],
            [['alarm_value', 'alarm_tolerance', 'alarm_limit'], 'number'],
            [['alarm_start_time', 'alarm_end_time', 'alarm_type_point', 'site_id', 'alarm_emails'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alarm_id' => 'Alarm ID',
            'alarm_name' => 'Nome do alarme',
            'alarm_description' => 'Alarm Description',
            'alarm_type' => 'Tipo',
            'alarm_active' => 'Habilitado',
            'alarm_operator' => 'Operador',
            'alarm_reference' => 'Alarm Reference',
            'alarm_value' => 'Valor',
            'alarm_tolerance' => 'Tolerância',
            'alarm_reading_periodicity' => 'Periodicidade leitura',
            'alarm_limit' => 'Alarm Limit',
            'alarm_week_days' => 'Dias da semana',
            'alarm_start_time' => 'Hora inicial',
            'alarm_end_time' => 'Hora final',
            'alarm_emails' => 'E-mails para envio',
            'site_id' => 'Sites Monitorados',
            'alarm_type_point' => 'Tipo de Ponto',
        ];
    }

    public function getAlarmTypeLabel()
    {
        $options = [
            '1' => 'Volume Consumido',
            '0' => 'Vazão',
        ];

        return $options[$this->alarm_type] ?? '';
    }

    public function getAlarmActiveLabel()
    {
        $options = [
            '1' => 'Sim',
            '0' => 'Não',
        ];

        return $options[$this->alarm_active] ?? '';
    }

    
}
