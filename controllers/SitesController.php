<?php

namespace app\controllers;

use app\models\Alarm;
use app\models\Branch;
use app\models\Sites;
use app\models\search\Sites as SitesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ClientUser;
use app\models\BranchSite;
use app\models\ClientBranch;
use app\models\Consumption;
use app\models\Dashboard;
use app\models\Device;
use app\models\DeviceMessage;
use app\models\Group;
use app\models\MessageConsumption;
use app\models\SiteDevice;
use app\models\UserSite;
use Symfony\Component\Console\Logger\ConsoleLogger;
use yii\db\Expression;
use yii\helpers\Json;



/**
 * SitesController implements the CRUD actions for Sites model.
 */
class SitesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    /**
     * Lists all Sites models.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $searchModel = new SitesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch()
    {


        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $searchTerm = \Yii::$app->request->get('term');
        $lowerSearchTerm = strtolower($searchTerm); // Converter o termo de pesquisa para minúsculas


        $sites = Sites::find()
        ->joinWith(['userSite'])
        ->where([
            'user_site.fk_user_id' => \Yii::$app->user->identity->user_id,
            'site_active' => true, // Adiciona a condição para excluir os registros com site_active igual a false
        ])
        ->andFilterWhere(['LIKE', 'LOWER(site_name)', $lowerSearchTerm]) // Aplica a condição de pesquisa case-insensitive
        ->asArray()
        ->all();
    

        // Extrai os IDs dos sites correspondentes
        $siteIds = array_column($sites, 'site_id');

        // Pesquisa por branchs
        $branches = Branch::find()
            ->joinWith(['branchSite'])
            ->where(['branch_site.fk_site_id' => $siteIds])
            ->andFilterWhere(['LIKE', 'LOWER(branch_name)', $lowerSearchTerm])
            ->asArray()
            ->all();

        // Pesquisa por dispositivos
        $devices = Device::find()
            ->joinWith(['siteDevice.site.branchSite.branch.clientBranch.clientUser'])
            ->where(['client_user.fk_user_id' => \Yii::$app->user->identity->user_id])
            ->andFilterWhere(['LIKE', 'LOWER(device_id)', $lowerSearchTerm])
            ->asArray()
            ->all();



        $data = [];

        // Formata os dados no formato esperado pelo plugin jQuery UI Autocomplete
        $formattedSites = [];
        foreach ($sites as $site) {
            $formattedSites[] = [
                'id' => $site['site_id'],
                'label' => '<b>Site: </b> <br> ' . $site['site_name'],
                'value' => 'Site: ' . $site['site_name'],
                'url' => '/sites/select?tipo=site&id=' . $site['site_id'],
            ];
        }

        $formattedBranches = [];
        foreach ($branches as $branch) {
            $formattedBranches[] = [
                'id' => $branch['branch_id'],
                'label' => '<b>Unidade:</b> ' . $branch['branch_name'],
                'value' => 'Unidade: ' . $branch['branch_name'],
                'url' => '/sites/select?tipo=branch&id=' . $branch['branch_id'],
            ];
        }

        // // Formata os dados dos dispositivos
        // $formattedDevices = [];
        // foreach ($devices as $device) {
        //     $formattedDevices[] = [
        //         'id' => $device['device_id'],
        //         'label' => '<b>DISPOSITIVO:</b> ' . $device['device_id'],
        //         'value' => 'DISPOSITIVO: ' . $device['device_id'],
        //         'url' => '/sites/select?tipo=device&id=' . $device['device_id'] . '',
        //     ];
        // }


        $data = array_merge($formattedSites, $formattedBranches);



        return Json::encode($data);
    }


    public function actionSelect($tipo, $id)
    {


        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $sites = Dashboard::resourceSite($id);

        \yii::$app->session->set('search', $id);
        \yii::$app->session->set('search_tipo', $tipo);

        // Verifica se o valor 1 está contido no array de recursos
        if (in_array(1, $sites)) {
            return $this->redirect(['sites/agua-express']);
        }

        if (in_array(2, $sites)) {
            return $this->redirect(['sites/energia']);
        }

        if (in_array(3, $sites)) {
            return $this->redirect(['sites/gas-express']);
        }

        if (in_array(4, $sites)) {
            return $this->redirect(['sites/diesel-express']);
        }

        if (in_array(5, $sites)) {
            return $this->redirect(['sites/energia2']);
        }


        return $this->redirect(['sites/agua-express']);
    }

    public function actionSelecionaSite($id)
    {
        if (\Yii::$app->user->isGuest) {
            return \Yii::$app->response->redirect(['site/login']);
        }

        // Obtém o array de recursos
        $sites = Dashboard::resourceSite($id);

        \yii::$app->session->set('search', $id);
        \yii::$app->session->set('search_tipo', 'site');

        // Verifica se o valor 1 está contido no array de recursos
        if (in_array(1, $sites)) {
            return $this->redirect(['sites/agua-express']);
        }

        if (in_array(2, $sites)) {
            return $this->redirect(['sites/energia']);
        }

        if (in_array(3, $sites)) {
            return $this->redirect(['sites/gas-express']);
        }

        if (in_array(4, $sites)) {
            return $this->redirect(['sites/diesel-express']);
        }

        if (in_array(5, $sites)) {
            return $this->redirect(['sites/energia2']);
        }
    }

    public function actionSelecionaGrupo($id)
    {
        if (\Yii::$app->user->isGuest) {
            return \Yii::$app->response->redirect(['site/login']);
        }

        // Obtém o array de recursos
        $resource = Group::find()->where(['group_id' => $id])->one();

        \yii::$app->session->set('search', $id);
        \yii::$app->session->set('search_tipo', 'group');

        // Verifica se o valor 1 está contido no array de recursos
        if ($resource->group_resource_type == 1) {
            return $this->redirect(['sites/agua']);
        }

        if ($resource->group_resource_type == 2) {
            return $this->redirect(['sites/energia']);
        }

        if ($resource->group_resource_type == 3) {
            return $this->redirect(['sites/gas']);
        }

        if ($resource->group_resource_type == 4) {
            return $this->redirect(['sites/diesel']);
        }

        if ($resource->group_resource_type == 5) {
            return $this->redirect(['sites/energia2']);
        }
    }


    public function actionResetSelect()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);
        return $this->redirect('/sites');
    }


    public function actionAgua()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('agua', [
            'consumoDoDia' => Dashboard::consumoDoDia(),
            'consumoDoMes' => Dashboard::consumoDoMes(),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(),
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionGas()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('gas', [
            'consumoDoDia' => Dashboard::consumoDoDia(),
            'consumoDoMes' => Dashboard::consumoDoMes(),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(),
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionEnergia()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $consumoEnergiaPontaDoReferidoMes = Dashboard::maiorDemandaEnergiaPontaDoReferidoMes();
        $consumoEnergiaForaPontaDoReferidoMes = Dashboard::maiorDemandaEnergiaForaPontaDoReferidoMes();
        $ultimaLeituraDemandaEnergia = Dashboard::ultimaLeituraDemandaEnergia();
        $consumoTotalEnergiaDoReferidoMes = Dashboard::consumoTotalEnergiaDoReferidoMes();
        $ultimofatorDePotencia = Dashboard::ultimofatorDePotencia();

        return $this->render('energia', [
            'consumoEnergiaPontaDoReferidoMes' => $consumoEnergiaPontaDoReferidoMes,
            'consumoEnergiaForaPontaDoReferidoMes' => $consumoEnergiaForaPontaDoReferidoMes,
            'ultimaLeituraConsumoEnergia' => $ultimaLeituraDemandaEnergia,
            'consumoTotalEnergiaDoReferidoMes' => $consumoTotalEnergiaDoReferidoMes,
            'ultimofatorDePotencia' => $ultimofatorDePotencia,
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionDiesel()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('diesel', [
            'consumoDoDia' => Dashboard::consumoDoDia(),
            'consumoDoMes' => Dashboard::consumoDoMes(),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(),
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionAguaExpress()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('agua-express', [
            'consumoDoDia' => Dashboard::consumoDoDia(),
            'consumoDoMes' => Dashboard::consumoDoMes(),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(),
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionGasExpress()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('gas-express', [
            'consumoDoDia' => Dashboard::consumoDoDia(3),
            'consumoDoMes' => Dashboard::consumoDoMes(null, null, 3),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(3),
            'media' => Dashboard::medias(),
        ]);
    }
    public function actionDieselExpress()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('diesel-express', [
            'consumoDoDia' => Dashboard::consumoDoDia(4),
            'consumoDoMes' => Dashboard::consumoDoMes(null, null, 4),
            'ultimaLeituraConsumo' => Dashboard::ultimaLeituraConsumo(4),
            'media' => Dashboard::medias(),
        ]);
    }

    public function actionEnergia2()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('energia2', [
            'consumoEnergiaDoDia' => Dashboard::consumoEnergiaDoDia(),
            'consumoEnergiaDoMes' => Dashboard::consumoEnergiaDoMes(),
            'ultimaLeituraConsumoEnergia' => Dashboard::ultimaLeituraConsumoEnergia(),
            'media' => Dashboard::medias(),
        ]);
    }



    public function actionAguaRedirect()
    {

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);

        return  \Yii::$app->response->redirect(['sites/agua']);
    }

    public function actionGasRedirect()
    {

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);

        return  \Yii::$app->response->redirect(['sites/gas']);
    }

    public function actionDieselRedirect()
    {

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);

        return  \Yii::$app->response->redirect(['sites/diesel']);
    }

    public function actionEnergia2Redirect()
    {

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);

        return  \Yii::$app->response->redirect(['sites/energia2']);
    }

    public function actionEnergiaRedirect()
    {

        \yii::$app->session->set('search', null);
        \yii::$app->session->set('search_tipo', null);

        return  \Yii::$app->response->redirect(['sites/energia']);
    }

    public function actionPowerBi()
    {
 // Renderizar a view 'powerBi' (se essa view existir)
return $this->render('powerbi');
    }
 



    public function actionExport($type = null)
    {


        if (!$type) {
            $type = 1;
        }

        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        if (\Yii::$app->request->isPost) {

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="wenergy_' . date("d/m/Y_hi") . '.csv"');

            // Data inicial e final recebidas por POST
            $dataInicial = \Yii::$app->request->post('data_inicial') ?: date("Y-m-d");
            $dataFinal = \Yii::$app->request->post('data_final') ?: date("Y-m-d");

            $tipoExportacao = \Yii::$app->request->post('tipo_exportacao');
            $numeric = 3;
            if ($tipoExportacao == 2) {
                $numeric = 3;
                $data = [
                    [
                        'Site',
                        'Unidade',
                        'Instante',
                        'Energia Ativa kWh',
                        'Energia Ativa Ponta kWh',
                        'Energia Ativa Fora Ponta kWh',
                        'Energia Reativa KVArh',
                        'Energia Reativa Ponta KVArh',
                        'Energia Reativa Fora Ponta KVArh',
                        'Demanda Ativa kW',
                        'Demanda Ativa Ponta kW',
                        'Demanda Ativa Fora Ponta kW',
                        'Demanda Reativa KVAr',
                        'Demanda Reativa Ponta KVAr',
                        'Demanda Reativa Fora Ponta KVAr',
                    ],
                ];
            } else {
                $data = [
                    ['Site', 'Unidade', 'Data', 'Volume consumido (m3)'],
                ];
            }

            // IDs dos sites selecionados
            $siteIds = \Yii::$app->request->post('export');

            // Certifique-se de que os IDs dos sites estão disponíveis
            if (!$siteIds) {
                \Yii::$app->session->setFlash('error', 'Você precisa selecionar pelo menos 1 site.');
                return $this->redirect(\yii::$app->request->referrer);
            }

            // Prepara a consulta principal
            $query = (new \yii\db\Query())
                ->from('telemetria.view_client_consumption')
                ->where(['>=', 'v_consumption_datetime_message', $dataInicial])
                ->andWhere(['<=', 'v_consumption_datetime_message', $dataFinal])
                ->andWhere(['in', 'v_site_id', $siteIds]);

            // Tipo de agregação (1: Hora, 2: Dia, 3: Mês)
            $tipoIntegralizacao = \Yii::$app->request->post('tipo_integralizacao');

            // Agrupar de 15 em 15 caso seja energia
            if ($tipoIntegralizacao == 0) {
                // Lógica para buscar a cada 15 minutos
                $query->select([
                    'v_site_name',
                    'v_branch_name',
                    'to_char(date_trunc(\'minute\', v_consumption_datetime) - MOD(EXTRACT(MINUTE FROM v_consumption_datetime), 15) * INTERVAL \'1 MINUTE\', \'DD/MM/YYYY HH24:MI\') AS period',
                    'ROUND(SUM(v_consumption_value)::numeric, ' . $numeric . ') AS total_value',
                    'max(v_consumption_energy_active_kwh) AS total_consumption_energy_active_kwh',
                    'max(v_consumption_energy_active_peak_kwh) AS total_consumption_energy_active_peak_kwh',
                    'max(v_consumption_energy_active_out_peak_kwh) AS total_consumption_energy_active_out_peak_kwh',
                    'max(v_consumption_energy_reactive_kvarh) AS total_consumption_energy_reactive_kvarh',
                    'max(v_consumption_energy_reactive_peak_kvarh) AS total_consumption_energy_reactive_peak_kvarh',
                    'max(v_consumption_energy_reactive_out_peak_kvarh) AS total_consumption_energy_reactive_out_peak_kvarh',
                    'max(v_consumption_demand_active_kw) AS total_consumption_demand_active_kw',
                    'max(v_consumption_demand_active_peak_kw) AS total_consumption_demand_active_peak_kw',
                    'max(v_consumption_demand_active_out_peak_kw) AS total_consumption_demand_active_out_peak_kw',
                    'max(v_consumption_demand_reactive_kvar) AS total_consumption_demand_reactive_kvar',
                    'max(v_consumption_demand_reactive_peak_kvar) AS total_consumption_demand_reactive_peak_kvar',
                    'max(v_consumption_demand_reactive_out_peak_kvar) AS total_consumption_demand_reactive_out_peak_kvar',
                ])
                    ->groupBy(['v_site_id', 'to_char(date_trunc(\'minute\', v_consumption_datetime) - MOD(EXTRACT(MINUTE FROM v_consumption_datetime), 15) * INTERVAL \'1 MINUTE\', \'DD/MM/YYYY HH24:MI\')', 'v_site_name', 'v_branch_name']);
            }


            // Agrupar por hora
            if ($tipoIntegralizacao == 1) {
                $query->select([
                    'v_site_name',
                    'v_branch_name',
                    // Usar date_trunc para truncar até a hora e to_char para formatar
                    'to_char(date_trunc(\'hour\', v_consumption_datetime), \'DD/MM/YYYY HH24:00\') AS period',
                    'ROUND(SUM(v_consumption_value)::numeric, ' . $numeric . ') AS total_value',
                    'max(v_consumption_energy_active_kwh) AS total_consumption_energy_active_kwh',
                    'max(v_consumption_energy_active_peak_kwh) AS total_consumption_energy_active_peak_kwh',
                    'max(v_consumption_energy_active_out_peak_kwh) AS total_consumption_energy_active_out_peak_kwh',
                    'max(v_consumption_energy_reactive_kvarh) AS total_consumption_energy_reactive_kvarh',
                    'max(v_consumption_energy_reactive_peak_kvarh) AS total_consumption_energy_reactive_peak_kvarh',
                    'max(v_consumption_energy_reactive_out_peak_kvarh) AS total_consumption_energy_reactive_out_peak_kvarh',
                    'max(v_consumption_demand_active_kw) AS total_consumption_demand_active_kw',
                    'max(v_consumption_demand_active_peak_kw) AS total_consumption_demand_active_peak_kw',
                    'max(v_consumption_demand_active_out_peak_kw) AS total_consumption_demand_active_out_peak_kw',
                    'max(v_consumption_demand_reactive_kvar) AS total_consumption_demand_reactive_kvar',
                    'max(v_consumption_demand_reactive_peak_kvar) AS total_consumption_demand_reactive_peak_kvar',
                    'max(v_consumption_demand_reactive_out_peak_kvar) AS total_consumption_demand_reactive_out_peak_kvar',
                ])
                    ->groupBy(['v_site_id', 'to_char(date_trunc(\'hour\', v_consumption_datetime), \'DD/MM/YYYY HH24:00\')', 'v_site_name', 'v_branch_name']);
            }


            // Agrupar por dia
            elseif ($tipoIntegralizacao == 2) {
                $query->select([
                    'v_site_name',
                    'v_branch_name',
                    // Usar to_char para formatar a data corretamente
                    'to_char(v_consumption_datetime_message, \'DD/MM/YYYY\') AS period',
                    'ROUND(SUM(v_consumption_value)::numeric, ' . $numeric . ') AS total_value',
                    'max(v_consumption_energy_active_kwh) AS total_consumption_energy_active_kwh',
                    'max(v_consumption_energy_active_peak_kwh) AS total_consumption_energy_active_peak_kwh',
                    'max(v_consumption_energy_active_out_peak_kwh) AS total_consumption_energy_active_out_peak_kwh',
                    'max(v_consumption_energy_reactive_kvarh) AS total_consumption_energy_reactive_kvarh',
                    'max(v_consumption_energy_reactive_peak_kvarh) AS total_consumption_energy_reactive_peak_kvarh',
                    'max(v_consumption_energy_reactive_out_peak_kvarh) AS total_consumption_energy_reactive_out_peak_kvarh',
                    'max(v_consumption_demand_active_kw) AS total_consumption_demand_active_kw',
                    'max(v_consumption_demand_active_peak_kw) AS total_consumption_demand_active_peak_kw',
                    'max(v_consumption_demand_active_out_peak_kw) AS total_consumption_demand_active_out_peak_kw',
                    'max(v_consumption_demand_reactive_kvar) AS total_consumption_demand_reactive_kvar',
                    'max(v_consumption_demand_reactive_peak_kvar) AS total_consumption_demand_reactive_peak_kvar',
                    'max(v_consumption_demand_reactive_out_peak_kvar) AS total_consumption_demand_reactive_out_peak_kvar',
                ])
                    ->groupBy(['v_site_id', 'period', 'v_site_name', 'v_branch_name']);
            }

            // Agrupar por mês
            elseif ($tipoIntegralizacao == 3) {
                $query->select([
                    'v_site_name',
                    'v_branch_name',
                    'to_char(v_consumption_datetime_message, \'MM/YYYY\') AS period',
                    'ROUND(SUM(v_consumption_value)::numeric, ' . $numeric . ') AS total_value',
                    'max(v_consumption_energy_active_kwh) AS total_consumption_energy_active_kwh',
                    'max(v_consumption_energy_active_peak_kwh) AS total_consumption_energy_active_peak_kwh',
                    'max(v_consumption_energy_active_out_peak_kwh) AS total_consumption_energy_active_out_peak_kwh',
                    'max(v_consumption_energy_reactive_kvarh) AS total_consumption_energy_reactive_kvarh',
                    'max(v_consumption_energy_reactive_peak_kvarh) AS total_consumption_energy_reactive_peak_kvarh',
                    'max(v_consumption_energy_reactive_out_peak_kvarh) AS total_consumption_energy_reactive_out_peak_kvarh',
                    'max(v_consumption_demand_active_kw) AS total_consumption_demand_active_kw',
                    'max(v_consumption_demand_active_peak_kw) AS total_consumption_demand_active_peak_kw',
                    'max(v_consumption_demand_active_out_peak_kw) AS total_consumption_demand_active_out_peak_kw',
                    'max(v_consumption_demand_reactive_kvar) AS total_consumption_demand_reactive_kvar',
                    'max(v_consumption_demand_reactive_peak_kvar) AS total_consumption_demand_reactive_peak_kvar',
                    'max(v_consumption_demand_reactive_out_peak_kvar) AS total_consumption_demand_reactive_out_peak_kvar',
                ])
                    ->groupBy(['v_site_id', 'period', 'v_site_name', 'v_branch_name']);
            }

            // Obter os resultados da consulta
            $resultados = $query->all();
            

            // Processar os resultados
            foreach ($resultados as $resultado) {
                $siteName = $resultado['v_site_name'];
                $branchName = $resultado['v_branch_name'];
                $period = $resultado['period'];
                $totalValue = $resultado['total_value'];

                // Adiciona os dados ao array
                if ($tipoExportacao == 2) {
                    $data[] = [
                        $siteName,
                        $branchName,
                        $period,
                        str_replace(".", ",", $resultado['total_consumption_energy_active_kwh']),
                        str_replace(".", ",", $resultado['total_consumption_energy_active_peak_kwh']),
                        str_replace(".", ",", $resultado['total_consumption_energy_active_out_peak_kwh']),
                        str_replace(".", ",", $resultado['total_consumption_energy_reactive_kvarh']),
                        str_replace(".", ",", $resultado['total_consumption_energy_reactive_peak_kvarh']),
                        str_replace(".", ",", $resultado['total_consumption_energy_reactive_out_peak_kvarh']),
                        str_replace(".", ",", $resultado['total_consumption_demand_active_kw']),
                        str_replace(".", ",", $resultado['total_consumption_demand_active_peak_kw']),
                        str_replace(".", ",", $resultado['total_consumption_demand_active_out_peak_kw']),
                        str_replace(".", ",", $resultado['total_consumption_demand_reactive_kvar']),
                        str_replace(".", ",", $resultado['total_consumption_demand_reactive_peak_kvar']),
                        str_replace(".", ",", $resultado['total_consumption_demand_reactive_out_peak_kvar']),
                    ];
                } else {
                    $data[] = [
                        $siteName, 
                        $branchName, 
                        $period, 
                        str_replace(".", ",", $totalValue),                        
                    ];
                }
            }

            $fp = fopen('php://output', 'wb');
            foreach ($data as $line) {
                // Especificar o delimitador como ponto e vírgula
                fputcsv($fp, $line, ';');
            }
            fclose($fp);

            die();
        }


        $userId = \Yii::$app->user->identity->user_id;


        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column();

        $clientSites = Sites::find()
            ->from('telemetria.view_site_resource')
            ->where(['site_id' => $siteIds, 'resource_id' => $type])
            ->all();



        $sites = [];
        foreach ($clientSites as $clientSite) {
            $sites[$clientSite->site_id] = $clientSite->site_name;
        }


        uasort($sites, function ($a, $b) {
            return strcmp($a, $b);
        });

        return $this->render('export', [
            'sites' => $sites,
            'type' => ($type) ? $type : 1,
        ]);
    }

    public function actionExportData($type = 1)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $userId = \Yii::$app->user->identity->user_id;


        $siteIds = UserSite::find()
            ->select('fk_site_id')
            ->where(['fk_user_id' => $userId])
            ->column();

        $clientSites = Sites::find()
            ->from('telemetria.view_site_resource')
            ->where(['site_id' => $siteIds, 'resource_id' => $type,'site_active' => true])
            ->all();



        $sites = [];
        foreach ($clientSites as $clientSite) {
            $sites[$clientSite->site_id] = $clientSite->site_name;
        }


        uasort($sites, function ($a, $b) {
            return strcmp($a, $b);
        });

        return $sites;
    }


    /**
     * Displays a single Sites model.
     * @param int $site_id Site ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($site_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        return $this->render('view', [
            'model' => $this->findModel($site_id),
        ]);
    }

    /**
     * Creates a new Sites model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $model = new Sites();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success', 'Site cadastrado com sucesso.');
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sites model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $site_id Site ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($site_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $model = $this->findModel($site_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Site atualizado com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sites model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $site_id Site ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($site_id)
    {
        if (\Yii::$app->user->isGuest) {
            return  \Yii::$app->response->redirect(['site/login']);
        }

        $this->findModel($site_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sites model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $site_id Site ID
     * @return Sites the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($site_id)
    {
        if (($model = Sites::findOne(['site_id' => $site_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGraphConsumoMensal($year)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $mesesDoAno = Dashboard::mesesDoAnoReduzido();
        $consumoMensal = Dashboard::consumoPorMes($year);

        return [
            'mesesDoAno' => $mesesDoAno,
            'consumoMensal' => $consumoMensal,
            'mediaMensal' => Dashboard::medias()['monthlyValues'],
        ];
    }

    public function actionGraphConsumoDiario($mes, $ano)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $diasDoMes = Dashboard::diasDoMesReduzido();
        $consumoDiario = Dashboard::consumoPorDia($ano, $mes);

        return [
            'diasDoMes' => $diasDoMes,
            'consumoDiario' => $consumoDiario,
            'mediaDiario' => Dashboard::medias()['dailyValues'],
        ];
    }



    public function actionGraphConsumoDiarioAcumulado($mes, $ano)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $diasDoMes = Dashboard::diasDoMesReduzido();
        $consumoDiarioAcumulado = Dashboard::consumoAcumuladoPorDia($ano, $mes);

        // Obtemos a média para o mês especificado
        $media = isset(Dashboard::medias($ano, $mes)['monthlyValues'][$mes - 1]) ? Dashboard::medias($ano, $mes)['monthlyValues'][$mes - 1] : 0;
        $mediaDiario = array_fill(0, count($diasDoMes), $media);

        return [
            'diasDoMes' => $diasDoMes,
            'consumoDiarioAcumulado' => $consumoDiarioAcumulado,
            'mediaDiario' => $mediaDiario,
        ];
    }


    public function actionGraphConsumoHorario($day)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $dayComponents = explode("-", $day);
        $dia = date("Y-m-d", strtotime($day));

        $horasDoDia = Dashboard::horasDoDiaReduzido();
        $consumoHorario = Dashboard::consumoPorHora($dayComponents[2], $dayComponents[1], $dia);

        return [
            'horasDoDia' => $horasDoDia,
            'consumoHorario' => $consumoHorario,
        ];
    }

    public function actionGraphEnergiaConsumoHorario($day)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $dia = $day;

        $consumoHorarioEnergia = Dashboard::consumoPorHoraEnergia($dia);

        // $resultArray = [];  

        // echo json_encode($consumoHorarioEnergia);
        // die();

        // foreach ($consumoHorarioEnergia as $item) {
        //     foreach ($item as $key => $value) {
        //         if (!isset($resultArray[$key])) {
        //             $resultArray[$key] = [];
        //         }

        //         if($value == "23:59"){
        //             $value = "00:00";
        //         }

        //         $resultArray[$key][] = $value;
        //     }
        // }


        return $consumoHorarioEnergia;
    }

    public function actionGraphEnergiaConsumoMensal($currentMonth)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $month = $currentMonth;

        $consumoMensal = Dashboard::consumoMensalEnergia($month);
        // echo json_encode($consumoMensal);
        // die();
        // $resultArray = [];  

        // foreach ($consumoMensal as $item) {
        //     foreach ($item as $key => $value) {
        //         if (!isset($resultArray[$key])) {
        //             $resultArray[$key] = [];
        //         }

        //         $resultArray[$key][] = $value;
        //     }
        // }


        return $consumoMensal;
    }

    public function actionGraphEnergiaConsumo($currentMonth)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $month = $currentMonth;

        $consumoMensal = Dashboard::consumoEnergia($month);

        // $resultArray = [];  

        // echo json_encode($consumoMensal);
        // die();

        // foreach ($consumoMensal as $item) {
        //     foreach ($item as $key => $value) {
        //         if (!isset($resultArray[$key])) {
        //             $resultArray[$key] = [];
        //         }

        //         $resultArray[$key][] = $value;
        //     }
        // }




        return $consumoMensal;
    }


    public function actionGraphConsumoPostoTarifado($currentMonth)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $month = $currentMonth;

        $consumoMensal = Dashboard::consumoEnergiaPostoTarifado($month);

        $resultArray = [];

        foreach ($consumoMensal as $item) {
            foreach ($item as $key => $value) {
                if (!isset($resultArray[$key])) {
                    $resultArray[$key] = [];
                }

                $resultArray[$key][] = $value;
            }
        }



        return $resultArray;
    }

    public function actionGraphConsumoHorarioAcumulado($day)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $data = explode("-", $day);
        $horasDoDia = Dashboard::horasDoDiaReduzido();
        $consumoHorarioAcumulado = Dashboard::consumoPorHoraAcumulado($data[2], $data[1], $day);

        return [
            'horasDoDia' => $horasDoDia,
            'consumoHorarioAcumulado' => $consumoHorarioAcumulado,
            'mediaHorarioAcumulado' => Dashboard::medias()['acuHours'],
        ];
    }
}
