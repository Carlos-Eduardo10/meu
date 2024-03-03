<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class Dashboard extends Model
{

    public static function branchsParaConsulta()
    {
        $branches = [];

        $clientUserId = ClientUser::find()
            ->select('fk_client_id')
            ->where(['fk_user_id' => \Yii::$app->user->identity->id])
            ->scalar();

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $branch = Branch::find()
                ->from('telemetria.view_site')
                ->where(['site_id' => Yii::$app->session->get('search')])
                ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                ->one();
            if ($branch) {
                $branches[] = ['name' => $branch->branch_name, 'latitude' => $branch->branch_latitude, 'longitude' => $branch->branch_longitude];
            }
        }

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'branch') {
            $branchs = Branch::find()
                ->from('telemetria.view_site')
                ->where(['client_id' => $clientUserId])
                ->andWhere(['branch_id' => Yii::$app->session->get('search')])
                ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                ->all();
            foreach ($branchs as $branch) {
                $branches[] = ['name' => $branch->branch_name, 'latitude' => $branch->branch_latitude, 'longitude' => $branch->branch_longitude];
            }
        }

        if (!Yii::$app->session->get('search_tipo')) {
            $branchs = Branch::find()
                ->from('telemetria.view_site')
                ->where(['client_id' => $clientUserId])
                ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                ->all();
            foreach ($branchs as $branch) {
                $branches[] = ['name' => $branch->branch_name, 'latitude' => $branch->branch_latitude, 'longitude' => $branch->branch_longitude];
            }
        }

        return $branches;
    }

    public static function branchsParaConsultaGeral()
    {

        $branchs = [];

        $clientUserId = ClientUser::find()
            ->select('fk_client_id')
            ->where(['fk_user_id' => \Yii::$app->user->identity->id])
            ->scalar();

        if (\Yii::$app->session->get('search')) {
            if (\Yii::$app->session->get('search_tipo') == 'site') {
                $branchs = Branch::find()
                    ->from('telemetria.view_site')
                    ->where(['client_id' => $clientUserId])
                    ->andwhere(['site_id' => \Yii::$app->session->get('search')])
                    ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                    ->all();
            } else if (\Yii::$app->session->get('search_tipo') == 'branch') {
                $branchs = Branch::find()
                    ->from('telemetria.view_site')
                    ->where(['client_id' => $clientUserId])
                    ->andwhere(['branch_id' => \Yii::$app->session->get('search')])
                    ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                    ->all();
            }
        } else {
            $branchs = Branch::find()
                ->from('telemetria.view_site')
                ->where(['client_id' => $clientUserId])
                ->andWhere(['not', ['branch_latitude' => null, 'branch_longitude' => null]]) // adicionado esta linha
                ->all();
        }

        foreach ($branchs as $branch) {
            $branchs[] = ['name' => $branch->branch_name, 'latitude' => $branch->branch_latitude, 'longitude' => $branch->branch_longitude];
        }

        return $branchs;
    }


    public static function sitesParaConsulta()
    {
        $clientSiteIds = [];

        $userId = Yii::$app->user->identity->user_id;
        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column(); // Isso retorna um array com os `site_id`.

        $clientUserId = ClientUser::find()
            ->select('fk_client_id')
            ->where(['fk_user_id' => \Yii::$app->user->identity->id])
            ->scalar();

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $clientSiteIds[] = Yii::$app->session->get('search');
        }

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'branch') {
            $clientSites = Sites::find()
                ->from('telemetria.view_site')
                ->where(['client_id' => $clientUserId])
                ->where(['branch_id' => Yii::$app->session->get('search')])
                ->all();

            foreach ($clientSites as $clientSite) {
                $clientSiteIds[] = $clientSite->site_id;
            }
        }

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'group') {
            $groups = GroupSite::find()
                ->from('telemetria.group_site')
                ->where(['fk_group_id' => Yii::$app->session->get('search')])
                ->all();

            foreach ($groups as $g) {
                $clientSiteIds[] = $g->fk_site_id;
            }
        }

        if (!Yii::$app->session->get('search_tipo')) {

            $clientSites = Sites::find()
                ->from('telemetria.view_site')
                ->where(['site_id' => $siteIds])
                ->all();

            foreach ($clientSites as $clientSite) {
                $clientSiteIds[] = $clientSite->site_id;
            }
        }
        return $clientSiteIds;
    }

    public static function sitesParaConsultaGeral()
    {
        $clientSiteIds = [];

        $clientUserId = ClientUser::find()
            ->select('fk_client_id')
            ->where(['fk_user_id' => \Yii::$app->user->identity->id])
            ->scalar();

        $clientSites = Sites::find()
            ->from('telemetria.view_site')
            ->where(['client_id' => $clientUserId])
            ->all();

        foreach ($clientSites as $clientSite) {
            $clientSiteIds[] = $clientSite->site_id;
        }

        return $clientSiteIds;
    }

    public static function metas()
    {
        $clientGoals = Sites::find()
            ->select("goal_value")
            ->from('telemetria.view_goal')
            ->where(['in', 'fk_site_id', self::sitesParaConsulta()])
            ->groupBy("fk_site_id, goal_value")
            ->asArray()
            ->all();

        return $clientGoals;
    }

    public static function consumoDoDia($r = 1)
    {

        $totalMonthlyValue = 0;
        #$date = "2023-10-15";
        $date = date("Y-m-d");


        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => $r])
            ->column();

        $query = Sites::find()
            ->select(['SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_water']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', $sites]);
        }
        $result =   $query->andWhere(['>=', 'v_consumption_datetime', date("{$date} 00:00:00")])
            ->andWhere(['<=', 'v_consumption_datetime', date("{$date} 23:59:59")])
            ->groupBy("v_site_id")
            ->asArray()
            ->all();

        $totalConsumption = 0;

        foreach ($result as $siteData) {
            // Verifique se 'total_consumption' está presente no resultado
            if (isset($siteData['total_consumption'])) {
                // Adicione o valor de consumo do site atual ao total
                $totalConsumption += $siteData['total_consumption'];
            }
        }


        $monthlyValues = [];
        foreach (self::metas() as $monthlyGoal) {
            $goalValue = $monthlyGoal['goal_value'];
            $goalValue = trim($goalValue, "{}");
            $monthlyValues[] = explode(",", $goalValue);
        }

        if (!empty($monthlyValues) && isset($monthlyValues[0])) {
            // Calcular a soma dos valores mensais
            $totalMonthlyValue = $monthlyValues[0][date("m", strtotime($date)) - 1];
        }

        $daysInMonth = date('t');

        $dailyAverage = $totalMonthlyValue / $daysInMonth;

        return [
            'consume' => round($totalConsumption, 2),
            'average' => $dailyAverage
        ];
    }

    public static function consumoEnergiaDoDia($type = 2)
    {

        $date = date("Y-m-d");

        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => "5"]);


        $query = Sites::find()
            ->select(['SUM(v_consumption_value) AS maior_consumo'])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', $sites]);
        }



        $result =   $query->andWhere(['>=', 'v_consumption_datetime', date("{$date} 00:00:00")])
            ->andWhere(['<=', 'v_consumption_datetime', date("{$date} 23:59:59")])
            ->scalar();

        $monthlyValues = [];
        foreach (self::metas() as $monthlyGoal) {
            $goalValue = $monthlyGoal['goal_value'];
            $goalValue = trim($goalValue, "{}");
            $monthlyValues[] = explode(",", $goalValue);
        }

        // Calcular a soma dos valores mensais
        $totalMonthlyValue = 0;
        foreach ($monthlyValues as $values) {
            $totalMonthlyValue += array_sum($values);
        }

        $daysInMonth = date('t');

        $dailyAverage = $totalMonthlyValue / $daysInMonth;


        return [
            'consume' => round($result, 2),
            'average' => $dailyAverage
        ];
    }

    public static function maiorDemandaEnergiaPontaDoReferidoMes()
    {

        $date = date("Y-m");      

        $query = Sites::find()
            ->select([
                'v_consumption_demand_active_peak_kw',
                new \yii\db\Expression("TO_CHAR(v_consumption_datetime, 'DD/MM/YYYY às HH24:MI:SS') AS formatted_datetime")
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }

        //$query->andWhere(['EXTRACT(YEAR FROM v_consumption_datetime)::text || \'-\' || EXTRACT(MONTH FROM v_consumption_datetime)::text' => $date]);
        $query->andWhere(["to_char(v_consumption_datetime, 'YYYY-MM')" => $date] );
        $query->andWhere(['v_consumption_type' => 2])
            ->orderBy(['v_consumption_demand_active_peak_kw' => SORT_DESC]);

        $result = $query->asArray()->one();

        //var_dump($result);
        return $result;
    }


    public static function maiorDemandaEnergiaForaPontaDoReferidoMes($type = 2)
    {

        $date = date("Y-m");

        $query = Sites::find()
            ->select([
                'v_consumption_demand_active_out_peak_kw',
                new \yii\db\Expression("TO_CHAR(v_consumption_datetime, 'DD/MM/YYYY às HH24:MI:SS') AS formatted_datetime")
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        
        //$query->andWhere(['EXTRACT(YEAR FROM v_consumption_datetime)::text || \'-\' || EXTRACT(MONTH FROM v_consumption_datetime)::text' => $date]);
        
        $query->andWhere(["to_char(v_consumption_datetime, 'YYYY-MM')" => $date] );

        $query->andWhere(['v_consumption_type' => 2])
            ->orderBy(['v_consumption_demand_active_out_peak_kw' => SORT_DESC]);

        $result = $query->asArray()->one();

        return $result;
    }

    public static function ultimaLeituraDemandaEnergia()
    {
        $query = Sites::find()
            ->select([
                'v_consumption_demand_active_kw',
                new \yii\db\Expression("TO_CHAR(v_consumption_datetime, 'DD/MM/YYYY às HH24:MI:SS') AS formatted_datetime")
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $query->andWhere(['v_consumption_type' => 2])
            ->orderBy(['v_consumption_datetime' => SORT_DESC]);

        $result = $query->asArray()->one();
        
        return $result;
    }



    public static function consumoTotalEnergiaDoReferidoMes($type = 2)
    {

        $date = date("Y-m");

        $query = Sites::find()
            ->select([
                'SUM(v_consumption_energy_active_kwh) AS total_energy',
                new \yii\db\Expression("TO_CHAR(MAX(v_consumption_datetime), 'DD/MM/YYYY às HH24:MI:SS') AS max_date"),
                new \yii\db\Expression("TO_CHAR(MIN(v_consumption_datetime), 'DD/MM/YYYY às HH24:MI:SS') AS min_date")
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        
        //$query->andWhere(['EXTRACT(YEAR FROM v_consumption_datetime)::text || \'-\' || EXTRACT(MONTH FROM v_consumption_datetime)::text' => $date]);
        $query->andWhere(["to_char(v_consumption_datetime, 'YYYY-MM')" => $date] );

        
        $query->andWhere(['v_consumption_type' => 2]);

        $result = $query->asArray()->one();

        //var_dump($result);

        return $result;
    }

    public static function ultimofatorDePotencia()
    {
        $query = Sites::find()
            ->select([
                'v_consumption_power_factor',
                new \yii\db\Expression("TO_CHAR(v_consumption_datetime, 'DD/MM/YYYY às HH24:MI:SS') AS formatted_datetime")
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $query->andWhere(['v_consumption_type' => 2])
            ->orderBy(['v_consumption_datetime' => SORT_DESC]);

        $result = $query->asArray()->one();
        
        return $result;
    }


    public static function consumoDoMes($month = null, $year = null, $r = 1)
    {

        $dailyAverage = 0;

        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");

        $lastday = date('t', strtotime("{$year}-{$month}-01"));

        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => $r])
            ->column();



        $query = Sites::find()
            ->select(['v_site_id', 'SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_water']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->andWhere(['in', 'v_site_id', $sites]);
        }

        $result = $query->andWhere(['>=', 'DATE(v_consumption_datetime)', date("{$year}-{$month}-01 00:00:00")])
            ->andWhere(['<=', 'DATE(v_consumption_datetime)', date("{$year}-{$month}-{$lastday} 23:59:59")])
            ->groupBy("v_site_id")
            ->asArray()
            ->all();

        $totalConsumption = 0;

        foreach ($result as $siteData) {
            // Verifique se 'total_consumption' está presente no resultado
            if (isset($siteData['total_consumption'])) {
                // Adicione o valor de consumo do site atual ao total
                $totalConsumption += $siteData['total_consumption'];
            }
        }


        $monthlyValues = [];
        foreach (self::metas() as $monthlyGoal) {
            $goalValue = $monthlyGoal['goal_value'];
            $goalValue = trim($goalValue, "{}");
            $monthlyValues[] = explode(",", $goalValue);
        }
        if (!empty($monthlyValues) && isset($monthlyValues[0])) {
            // Calcular a soma dos valores mensais
            $dailyAverage =  $monthlyValues[0][$month - 1];
        }

        return [
            'consume' => round($totalConsumption, 2),
            'average' => $dailyAverage
        ];
    }

    public static function consumoEnergiaDoMes(
        $month = null,
        $year = null,
        $type = 2
    ) {

        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");

        $lastday = date('t', strtotime("{$year}-{$month}-01"));

        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => "5"]);

        $query = Sites::find()
            ->select(['SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_energy']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', $sites]);
        }



        $result = $query->andWhere(['>=', 'DATE(v_consumption_datetime)', date("{$year}-{$month}-01 00:00:00")])
            ->andWhere(['<=', 'DATE(v_consumption_datetime)', date("{$year}-{$month}-{$lastday} 23:00:00")])
            ->scalar();

        $monthlyValues = [];
        foreach (self::metas() as $monthlyGoal) {
            $goalValue = $monthlyGoal['goal_value'];
            $goalValue = trim($goalValue, "{}");
            $monthlyValues[] = explode(",", $goalValue);
        }

        // Calcular a soma dos valores mensais
        $totalMonthlyValue = 0;
        foreach ($monthlyValues as $values) {
            $totalMonthlyValue += array_sum($values);
        }

        $dailyAverage = $totalMonthlyValue;

        return [
            'consume' => round($result, 2),
            'average' => $dailyAverage
        ];
    }

    public static function consumoPorDia($year = null, $month = null)
    {

        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");
        $lastDayOfMonth = date("t", strtotime("$year-$month-01"));

        $dailyConsumption = Sites::find()
            ->select([
                'DATE(v_consumption_datetime) AS date',
                'SUM(v_consumption_value) AS total_consumption'
            ])
            ->from(['telemetria.m_view_client_consumption_water']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $dailyConsumption->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $result = $dailyConsumption->andWhere(['>=', 'DATE(v_consumption_datetime)', "{$year}-{$month}-01 00:00:00"])
            ->andWhere(['<=', 'DATE(v_consumption_datetime)', "{$year}-{$month}-{$lastDayOfMonth} 23:59:59"])
            ->groupBy('date')
            ->asArray()
            ->all();


        // Inicializar o array com os valores de consumo por dia começando em 0
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dailyConsumptionArray = array_fill(1, $daysInMonth, 0);

        // Preencher o array com os valores de consumo retornados pela consulta
        foreach ($result as $row) {
            $day = (int) date("d", strtotime($row['date']));
            $consumption = $row['total_consumption'];
            $dailyConsumptionArray[$day] = round($consumption, 2);
        }

        // Gerar o array final em ordem crescente de dias
        $dailyConsumptionResult = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dailyConsumptionResult[] = $dailyConsumptionArray[$day];
        }

        return [
            'consume' => $dailyConsumptionResult,
        ];
    }

    public static function consumoPorHora($year = null, $month = null, $day = null)
    {
        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");
        $day = ($day) ? $day : date("Y-m-d");

        $dailyConsumption = Sites::find()
            ->select(['EXTRACT(HOUR FROM v_consumption_datetime) AS hour', 'SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_water']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $dailyConsumption->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $result = $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()])
            ->andWhere(['>=', 'v_consumption_datetime', date("{$day} 00:00:00")])
            ->andWhere(['<=', 'v_consumption_datetime', date("{$day} 23:59:59")])
            ->groupBy(['hour'])
            ->asArray()
            ->all();


        // Inicializar o array com os valores de consumo por hora começando em 0
        $hourlyConsumption = array_fill(0, 24, 0);

        // Preencher o array com os valores de consumo retornados pela consulta
        foreach ($result as $row) {
            $hour = $row['hour'];
            $consumption = $row['total_consumption'];
            $hourlyConsumption[$hour] = round($consumption, 2);
        }

        return [
            'consume' => $hourlyConsumption,
        ];
    }

    public static function consumoPorHoraEnergia($day)
    {

        $date = $day;

        $dailyConsumption = Sites::find()
            ->select([
                new \yii\db\Expression('CASE WHEN cast(v_consumption_datetime as time) = \'23:59:59\' THEN \'00:00\' ELSE to_char(v_consumption_datetime, \'HH24:MI\') END AS hour_number'),
                new \yii\db\Expression('TO_CHAR(v_consumption_datetime, \'HH24:MI\') AS hour_number'),
                new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime) AS day_number'),
                'v_consumption_demand_active_peak_kw',
                'v_consumption_demand_active_out_peak_kw'
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $dailyConsumption->where(['v_site_id' => Yii::$app->session->get('search')]);
            $dailyConsumption->andWhere(['TO_CHAR(v_consumption_datetime, \'YYYY-MM-DD\')' => $date]);
        } else {
            $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }

        $result = $dailyConsumption
            ->orderBy(new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime)'))
            ->asArray()
            ->all();

        return $result;
    }


    public static function consumoMensalEnergia($month)
    {
        $query = Sites::find()
            ->select([
                new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime) AS day_number '),
                new \yii\db\Expression('MAX(v_consumption_demand_active_peak_kw) AS max_consumption_value_peak '),
                new \yii\db\Expression('MAX(v_consumption_demand_active_out_peak_kw) AS max_consumption_value_out_peak'),
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
            $query->andWhere(['v_consumption_type' => 2]);
            $query->andWhere(['TO_CHAR(v_consumption_datetime, \'MM-YYYY\')' => $month]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
            $query->andWhere(['v_consumption_type' => 2]);
        }

        $result = $query
            ->groupBy(new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime)'))
            ->asArray()
            ->all();


        return $result;
    }

    public static function consumoEnergia($month)
    {

        $query = Sites::find()
            ->select([
                new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime) AS day_number '),
                new \yii\db\Expression('SUM(v_consumption_energy_active_peak_kwh) AS total_energy_active_peak_kwh '),
                new \yii\db\Expression('SUM(v_consumption_energy_active_out_peak_kwh) AS total_energy_active_out_peak_kwh'),
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
            $query->andWhere(['v_consumption_type' => 2]);
            $query->andWhere(['TO_CHAR(v_consumption_datetime, \'MM-YYYY\')' => $month]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
            $query->andWhere(['v_consumption_type' => 2]);
        }

        $result = $query
            ->groupBy(new \yii\db\Expression('EXTRACT(DAY FROM v_consumption_datetime)'))
            ->asArray()
            ->all();



        return $result;
    }

    public static function consumoEnergiaPostoTarifado($month)
    {


        $query = Sites::find()
            ->select([
                new \yii\db\Expression('SUM(v_consumption_energy_active_peak_kwh) AS soma_total_energy_active_peak_kwh'),
                new \yii\db\Expression('SUM(v_consumption_energy_active_out_peak_kwh) AS soma_total_energy_active_out_peak_kwh'),
            ])
            ->from(['telemetria.m_view_client_consumption_energy']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'site') {
            $query->where(['v_site_id' => Yii::$app->session->get('search')]);
            $query->andWhere(['v_consumption_type' => 2]);
            $query->andWhere(['TO_CHAR(v_consumption_datetime, \'MM-YYYY\')' => $month]);
        } else {
            $query->where(['in', 'v_site_id', self::sitesParaConsulta()]);
            $query->andWhere(['v_consumption_type' => 2]);
        }

        $result = $query
            ->asArray()
            ->all();

        return $result;
    }

    public static function consumoPorHoraDinamico()
    {
        $fromDate = date('Y-m-d H:i:s', strtotime('-3 days'));
        $toDate = date('Y-m-d H:i:s');

        $dailyConsumption = Sites::find()
            ->select(['EXTRACT(HOUR FROM v_consumption_datetime) AS hour', 'SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_water']);

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $dailyConsumption->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }

        $result = $dailyConsumption
            ->andWhere(['>=', 'v_consumption_datetime', $fromDate])
            ->andWhere(['<=', 'v_consumption_datetime', $toDate])
            ->groupBy(['hour'])
            ->asArray()
            ->all();

        // Inicializar o array com os valores de consumo por hora começando em 0
        $hourlyConsumption = array_fill(0, 24, 0);

        // Preencher o array com os valores de consumo retornados pela consulta
        foreach ($result as $row) {
            $hour = $row['hour'];
            $consumption = $row['total_consumption'];
            $hourlyConsumption[$hour] += round($consumption, 2);
        }

        return [
            'consume' => $hourlyConsumption,
        ];
    }

    public static function consumoPorHoraAcumulado($year = null, $month = null, $day = null)
    {
        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");
        $day = ($day) ? $day : date("Y-m-d");

        $dailyConsumption = Sites::find()
            ->select(['EXTRACT(HOUR FROM v_consumption_datetime) AS hour', 'SUM(v_consumption_value) AS total_consumption'])
            ->from(['telemetria.m_view_client_consumption_water']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $dailyConsumption->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $dailyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $result = $dailyConsumption->andWhere(['>=', 'v_consumption_datetime', date("{$day} 00:00:00")])
            ->andWhere(['<=', 'v_consumption_datetime', date("{$day} 23:59:59")])
            ->groupBy(['hour'])
            ->asArray()
            ->all();

        // Inicializar o array com os valores de consumo por hora começando em 0
        $hourlyConsumption = array_fill(0, 24, 0);

        // Preencher o array com os valores de consumo retornados pela consulta
        foreach ($result as $row) {
            $hour = $row['hour'];
            $consumption = round($row['total_consumption'], 2);
            $hourlyConsumption[$hour] = round($consumption, 2);
        }

        // Criar o array acumulado
        $accumulatedConsumption = [];
        $previousValue = 0;
        foreach ($hourlyConsumption as $hour => $consumption) {
            $previousValue += $consumption;
            $accumulatedConsumption[$hour] = round($previousValue, 2);
        }
        return [
            'consume' => $accumulatedConsumption,
        ];
    }

    public static function consumoPorMes($year = null)
    {
        $year = ($year) ? $year : date("Y");

        $monthlyConsumption = Sites::find()
            ->select([
                'EXTRACT(MONTH FROM v_consumption_datetime) AS month',
                'SUM(v_consumption_value) AS total_consumption'
            ])
            ->from(['telemetria.m_view_client_consumption_water']);
        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $monthlyConsumption->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $monthlyConsumption->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }
        $result = $monthlyConsumption->andWhere(['>=', 'DATE(v_consumption_datetime)', "{$year}-01-01 00:00:00"])
            ->andWhere(['<=', 'DATE(v_consumption_datetime)', "{$year}-12-31 23:59:59"])
            ->groupBy('month')
            ->asArray()
            ->all();

        // Inicializar o array com os valores de consumo por mês começando em 0
        $monthlyConsumptionArray = array_fill(1, 12, 0);

        // Preencher o array com os valores de consumo retornados pela consulta
        foreach ($result as $row) {
            $month = (int) $row['month'];
            $consumption = $row['total_consumption'];
            $monthlyConsumptionArray[$month] = round($consumption, 2);
        }

        // Gerar o array final em ordem crescente de meses
        $monthlyConsumptionResult = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyConsumptionResult[] = $monthlyConsumptionArray[$month];
        }


        return [
            'consume' => $monthlyConsumptionResult,
        ];
    }

    public static function medias($year = null, $month = null)
    {
        $userId = \Yii::$app->user->identity->id;
        $year = ($year) ? $year : date("Y");
        $month = ($month) ? $month : date("m");

        $clientUserId = ClientUser::find()
            ->select('fk_client_id')
            ->where(['fk_user_id' => $userId])
            ->scalar();

        $clientbranchs = Branch::find()
            ->from('telemetria.view_client_branch')
            ->where(['client_id' => $clientUserId])
            ->all();

        $clientBranchIds = [];
        foreach ($clientbranchs as $clientBranche) {
            $clientBranchIds[] = $clientBranche->branch_id;
        }

        $clientGoals = Sites::find()
            ->select("goal_value")
            ->from('telemetria.view_goal')
            ->where(['in', 'fk_site_id', self::sitesParaConsulta()])
            ->groupBy(["fk_site_id", "goal_value"])
            ->asArray()
            ->all();


        $monthlyValues = [];
        foreach ($clientGoals as $monthlyGoal) {
            $goalValue = $monthlyGoal['goal_value'];
            $goalValue = trim($goalValue, "{}");
            $values = explode(",", $goalValue);
            $values = array_map('intval', $values); // Converter os valores para inteiros
            $monthlyValues[] = $values;
        }

        $totalMonthlyValues = array_reduce($monthlyValues, function ($carry, $values) {
            foreach ($values as $key => $value) {
                if (!isset($carry[$key])) {
                    $carry[$key] = 0;
                }
                $carry[$key] += $value;
            }
            return $carry;
        }, []);



        $clientBaseline = Branch::find()
            ->select("config_value")
            ->from('telemetria.view_branch_baseline')
            ->where(['in', 'fk_branch_id', $clientBranchIds])
            ->asArray()
            ->all();


        $monthlyBaselineValues = [];
        foreach ($clientBaseline as $monthlyGoal) {
            $goalValue = $monthlyGoal['config_value'];
            $goalValue = trim($goalValue, "{}");
            $values = explode(",", $goalValue);
            $values = array_map('intval', $values); // Converter os valores para inteiros
            $monthlyBaselineValues[] = $values;
        }



        // Calcular a soma dos valores mensais
        $totalBaselineMonthlyValues = array_reduce($monthlyBaselineValues, function ($carry, $values) {
            foreach ($values as $key => $value) {
                if (!isset($carry[$key])) {
                    $carry[$key] = 0;
                }
                $carry[$key] += $value;
            }
            return $carry;
        }, []);




        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $averageDailyValues = array_fill(0, $daysInMonth, round((isset($totalMonthlyValues[$month - 1]) ? $totalMonthlyValues[$month - 1] : 0) / $daysInMonth, 2));
        $averageHourValues = array_fill(0, 24, round((isset($averageDailyValues[0]) ? $averageDailyValues[0] : 0) / 24, 2));


        if (isset($totalBaselineMonthlyValues) && !empty($totalBaselineMonthlyValues) && $daysInMonth != 0) {
            $averageDailyBaselineValues = array_fill(0, $daysInMonth, round($totalBaselineMonthlyValues[$month - 1] / $daysInMonth, 2));
        } else {
            $averageDailyBaselineValues = 0;
        }

        if (isset($totalBaselineMonthlyValues) && !empty($totalBaselineMonthlyValues) && $daysInMonth != 0) {
            $averageHourBaselineValues = array_slice(array_fill(0, $daysInMonth, round(($totalBaselineMonthlyValues[$month - 1] / $daysInMonth) / 2, 2)), 0, 24);
        } else {
            $averageHourBaselineValues = 0;
        }

        $accumulatedHourValues = [];
        $accumulator = 0;
        foreach ($averageHourValues as $value) {
            $accumulator += $value;
            $accumulatedHourValues[] = round($averageDailyValues[0], 2);
        }

        $accumulatedHourValuesBase = [];
        $accumulator = 0;
        foreach ($averageHourValues as $value) {
            $accumulator += $value;
            $accumulatedHourValuesBase[] = $accumulator;
        }

        return [
            'monthlyValues' => $totalMonthlyValues,
            'monthlyBaselineValues' => $totalBaselineMonthlyValues,
            'dailyValues' => $averageDailyValues,
            'hourValues' => $averageHourValues,
            'dailyBaselineValues' => $averageDailyBaselineValues,
            'averageHourBaselineValues' => $averageHourBaselineValues,
            'acuBase' => $accumulatedHourValuesBase,
            'acuHours' => $accumulatedHourValues,
        ];
    }

    public static function ultimaLeituraConsumo($r = 1)
    {

        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => $r]);

        $query = Sites::find()
            ->select(['v_consumption_value', 'v_consumption_id'])
            ->from('telemetria.m_view_client_consumption');



        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', $sites]);
        }

        $result = $query->orderBy(['v_consumption_id' => SORT_DESC,])
            ->asArray()
            ->one();

        $query2 = Consumption::find()
            ->select(['v_consumption_value', 'v_consumption_id'])
            ->from('telemetria.m_view_client_consumption_water');

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query2->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query2->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }

        $result2 = $query2->orderBy(['v_consumption_id' => SORT_DESC])
            ->asArray()
            ->one();

        return [
            'lastConsume' => round((isset($result['v_consumption_value']) && $result['v_consumption_value'] > 0) ? $result['v_consumption_value'] : 1, 2),
            'lastConsumeCompare' => round((isset($result2['v_consumption_value']) && $result2['v_consumption_value'] > 0) ? $result2['v_consumption_value'] : 1, 2),
        ];
    }

    public static function ultimaLeituraConsumoEnergia($type = 2)
    {

        $sites = Sites::find()
            ->select(["site_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => self::sitesParaConsulta()])
            ->andWhere(["resource_id" => "5"]);

        $query = Sites::find()
            ->select(['v_consumption_value', 'v_consumption_id'])
            ->from('telemetria.m_view_client_consumption_energy');

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query->where(['in', 'v_site_id', $sites]);
        }



        $result = $query->orderBy(['v_consumption_id' => SORT_DESC,])
            ->asArray()
            ->one();

        $query2 = Consumption::find()
            ->select(['v_consumption_value', 'v_consumption_id'])
            ->from('telemetria.m_view_client_consumption_energy');

        if (Yii::$app->session->get('search_tipo') && Yii::$app->session->get('search_tipo') === 'device') {
            $query2->where(['v_device_id' => Yii::$app->session->get('search')]);
        } else {
            $query2->where(['in', 'v_site_id', self::sitesParaConsulta()]);
        }

        $result2 = $query2->orderBy(['v_consumption_id' => SORT_DESC])
            ->asArray()
            ->one();

        $lastConsume = 0;
        if (isset($result['v_consumption_value'])) {
            $lastConsume = round(($result['v_consumption_value'] > 0) ? $result['v_consumption_value'] : 1, 2);
        }
        return [
            'lastConsume' => $lastConsume,
            'lastConsumeCompare' => round(($result2['v_consumption_value'] > 0) ? $result2['v_consumption_value'] : 1, 2),
        ];
    }

    public static function mesesDoAnoReduzido()
    {
        return [
            '01' => 'Jan',
            '02' => 'Fev',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'Mai',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Set',
            '10' => 'Out',
            '11' => 'Nov',
            '12' => 'Dez',
        ];
    }

    public static function diasDoMesReduzido($month = null)
    {
        $month = ($month) ? $month : date("m");
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        $days = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $days[$day] = str_pad($day, 2, '0', STR_PAD_LEFT);
        }
        return $days;
    }

    public static function horasDoDiaReduzido()
    {
        $hs = [];
        for ($h = 0; $h <= 23; $h++) {
            $hf = ($h < 10) ? "0$h:00" : "$h:00";
            $hs[$h] = $hf;
        }
        return $hs;
    }

    public static function consumoAcumuladoPorDia($ano, $mes)
    {
        $diasDoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        $consumoAcumulado = [];
        $soma = 0;
        $consumoDia = self::consumoPorDia($ano, $mes);

        for ($i = 1; $i <= $diasDoMes; $i++) {
            $soma = $soma + $consumoDia['consume'][$i - 1];
            $consumoAcumulado[$i - 1] = round($soma, 2);
        }

        return $consumoAcumulado;
    }

    public static function userSiteResource()
    {

        $userId = Yii::$app->user->identity->user_id;
        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column(); // Isso retorna um array com os `site_id`.

        $sites = Sites::find()
            ->select(["resource_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => $siteIds])
            ->column(); // Obtém um array dos resultados

        return $sites;
    }

    public static function resourceSite($id)
    {

        $sites = Sites::find()
            ->select(["resource_id"])
            ->from(["telemetria.view_site_resource"])
            ->where(["site_id" => $id])
            ->column(); // Obtém um array dos resultados

        return $sites;
    }
}
