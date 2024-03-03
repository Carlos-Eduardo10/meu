<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "telemetria.site".
 *
 * @property int $site_id
 * @property string $site_name
 * @property string $site_date_register
 * @property bool|null $site_active
 */
class Sites extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetria.site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_name', 'site_date_register'], 'required'],
            [['site_name'], 'string'],
            [['site_date_register'], 'safe'],
            [['site_active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'site_id' => 'Código',
            'site_name' => 'Nome',
            'site_date_register' => 'Data de Cadastro',
            'site_active' => 'Status',
        ];
    }

    /**
     * Define a relação com BranchSite.
     * @return ActiveQuery
     */
    public function getBranchSite()
    {
        return $this->hasOne(BranchSite::class, ['fk_site_id' => 'site_id']);
    }

    /**
     * Define a relação com Branch através de BranchSite.
     * @return ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['branch_id' => 'fk_branch_id'])
            ->via('branchSite');
    }

    public function getUserSite()
    {
        return $this->hasMany(UserSite::class, ['fk_site_id' => 'site_id']);
    }

    public static function retornaNomeBusca()
    {
        if (\Yii::$app->session->get('search')) {
            if (\Yii::$app->session->get('search_tipo') == 'site') {
                $data = Sites::find()->where(['site_id' => \Yii::$app->session->get('search')])->one();
                return "SITE: {$data->site_name}  <a title='Limpar' href='/sites/reset-select' class='ml-4 clean-search'><i class='fa fa-trash'></i></a>";
            }
            if (\Yii::$app->session->get('search_tipo') == 'group') {
                $data = Group::find()->where(['group_id' => \Yii::$app->session->get('search')])->one();
                return "GRUPO: {$data->group_name}  <a title='Limpar' href='/sites/reset-select' class='ml-4 clean-search'><i class='fa fa-trash'></i></a>";
            }

            if (\Yii::$app->session->get('search_tipo') == 'branch') {
                $data = Branch::find()->where(['branch_id' => \Yii::$app->session->get('search')])->one();
                return "Unidade: {$data->branch_name}  <a title='Limpar' href='/sites/reset-select' class='ml-4 clean-search'><i class='fa fa-trash'></i></a>";
            }
            if (\Yii::$app->session->get('search_tipo') == 'device') {
                $data = Device::find()->where(['device_id' => \Yii::$app->session->get('search')])->one();
                return "DEVICE: {$data->device_id} <a title='Limpar' href='/sites/reset-select' class='ml-4 clean-search'><i class='fa fa-trash'></i></a>";
            }
            return " Geral ";
        }

        return null;
    }


   
    public static function retornaSiteType()
    {
        if (\Yii::$app->session->get('search')) {
            if (\Yii::$app->session->get('search_tipo') == 'site') {
                $data = Sites::find()->where(['site_id' => \Yii::$app->session->get('search')])->one();
                return $data->site_type;
            }
           
            return " Geral ";
        }

        return null;
    }

    public static function retornaNomeBuscaCampo()
    {
        if (\Yii::$app->session->get('search')) {
            if (\Yii::$app->session->get('search_tipo') == 'site') {
                $data = Sites::find()->where(['site_id' => \Yii::$app->session->get('search')])->one();
                return "SITE: {$data->site_name}";
            }
            if (\Yii::$app->session->get('search_tipo') == 'branch') {
                $data = Branch::find()->where(['branch_id' => \Yii::$app->session->get('search')])->one();
                return "Unidade: {$data->branch_name}";
            }
            if (\Yii::$app->session->get('search_tipo') == 'device') {
                $data = Device::find()->where(['device_id' => \Yii::$app->session->get('search')])->one();
                return "DEVICE: {$data->device_id}";
            }
            return " Geral ";
        }

        return null;
    }

    public static function selectBaseLine()
    {
        $baseline = 0;

        if (Yii::$app->session->get('search')) {
            if (Yii::$app->session->get('search_tipo') == 'group') {
                $baseline = Config::find()
                    ->select('config_value')
                    ->from('telemetria.view_branch_baseline')
                    ->where(['client_id' => Yii::$app->session->get('search')])
                    ->all();
                return $baseline;
            } else if (Yii::$app->session->get('search_tipo') == 'client') {

                $baseline = Config::find()
                    ->select('config_value')
                    ->from('telemetria.view_branch_baseline')
                    ->where(['client_id' => Yii::$app->session->get('search')])
                    ->all();

                return $baseline;
            } else if (Yii::$app->session->get('search_tipo') == 'branch') {

                $baseline = Config::find()
                    ->select('config_value')
                    ->from('telemetria.view_branch_baseline')
                    ->where(['branch_id' => Yii::$app->session->get('search')])
                    ->all();

                return $baseline;
            }
        } else {

            $baseline = Config::find()
                ->select('config_value')
                ->from('telemetria.view_branch_baseline')
                ->where(['client_id' => Yii::$app->session->get('search')])
                ->all();
            return $baseline;
        }
    }


    public static function selectConsumptionMonth()
    {
        $baseline = 0;

        if (Yii::$app->session->get('search')) {

            if (Yii::$app->session->get('search_tipo') == 'client') {
                $baseline = Consumption::find()
                    ->select([
                        new \yii\db\Expression("date_trunc('month', v_consumption_datetime) as month_reference"),
                        new \yii\db\Expression("to_char(date_trunc('month', v_consumption_datetime), 'MM') as month_number"),
                        new \yii\db\Expression("sum(v_consumption_value) as consumption_value")
                    ])
                    ->from('telemetria.m_view_client_consumption')
                    ->where(['v_client_id' => Yii::$app->session->get('search')])
                    ->andWhere(['not', new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime) IS NULL')])
                    ->groupBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->orderBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->all();

                return $baseline;
            } else if (Yii::$app->session->get('search_tipo') == 'branch') {

                $baseline = Consumption::find()
                    ->select([
                        new \yii\db\Expression("date_trunc('month', v_consumption_datetime) as month_reference"),
                        new \yii\db\Expression("to_char(date_trunc('month', v_consumption_datetime), 'MM') as month_number"),
                        new \yii\db\Expression("sum(v_consumption_value) as consumption_value")
                    ])
                    ->from('telemetria.m_view_client_consumption')
                    ->where(['v_branch_id' => Yii::$app->session->get('search')])
                    ->andWhere(['not', new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime) IS NULL')])
                    ->groupBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->orderBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->all();

                return $baseline;
            } else if (Yii::$app->session->get('search_tipo') == 'site') {
                $baseline = Consumption::find()
                    ->select([
                        new \yii\db\Expression("date_trunc('month', v_consumption_datetime) as month_reference"),
                        new \yii\db\Expression("to_char(date_trunc('month', v_consumption_datetime), 'MM') as month_number"),
                        new \yii\db\Expression("sum(v_consumption_value) as consumption_value")
                    ])
                    ->from('telemetria.m_view_client_consumption')
                    ->where(['v_site_id' => Yii::$app->session->get('search')])
                    ->andWhere(['not', new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime) IS NULL')])
                    ->groupBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->orderBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->all();

                return $baseline;
            } else if (Yii::$app->session->get('search_tipo') == 'group') {

                $siteIdsAdicionados = GroupSite::find()
                    ->select('fk_site_id')
                    ->where(['fk_group_id' => \Yii::$app->session->get('search')])
                    ->column();

                $baseline = Consumption::find()
                    ->select([
                        new \yii\db\Expression("date_trunc('month', v_consumption_datetime) as month_reference"),
                        new \yii\db\Expression("to_char(date_trunc('month', v_consumption_datetime), 'MM') as month_number"),
                        new \yii\db\Expression("sum(v_consumption_value) as consumption_value")
                    ])
                    ->from('telemetria.m_view_client_consumption')
                    ->where(['IN', 'v_site_id', $siteIdsAdicionados])
                    ->andWhere(['not', new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime) IS NULL')])
                    ->groupBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->orderBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                    ->all();

                return $baseline;
            }
        } else {
            $baseline = Consumption::find()
                ->select([
                    new \yii\db\Expression("date_trunc('month', v_consumption_datetime) as month_reference"),
                    new \yii\db\Expression("to_char(date_trunc('month', v_consumption_datetime), 'MM') as month_number"),
                    new \yii\db\Expression("sum(v_consumption_value) as consumption_value")
                ])
                ->from('telemetria.m_view_client_consumption')
                ->where(['v_client_id' => Yii::$app->session->get('search')])
                ->andWhere(['not', new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime) IS NULL')])
                ->groupBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                ->orderBy([new \yii\db\Expression('date_trunc(\'month\', v_consumption_datetime)')])
                ->all();

            return $baseline;
        }
    }
}
