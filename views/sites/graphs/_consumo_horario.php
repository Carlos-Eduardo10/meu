<?php

use app\models\Dashboard;

$diasDoMes = Dashboard::horasDoDiaReduzido();
$diasDoMesExibirGraph = json_encode(array_values($diasDoMes));

$dia = date("Y-m-d", strtotime($data));
$data = explode("-", $data);

$consumoDiario = Dashboard::consumoPorHora($data[2], $data[1], $dia);
$consumoDiarioExibirGraph = json_encode($consumoDiario['consume']);

$mediaDiarioExibirGraph = json_encode($media['hourValues']);

?>

<div id="chartHorario"></div>
<script>
    var consumo = <?= $consumoDiarioExibirGraph ?>;
    var meta = <?= $mediaDiarioExibirGraph ?>;
    var options = {
        series: [{
                name: 'Consumo',
                type: 'bar',
                data: consumo
            }
        ],
        chart: {
            height: 350,
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        colors: ['#56cc64'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent', '#000']
        },
        xaxis: {
            categories: <?= $diasDoMesExibirGraph ?>,
        },
        yaxis: {
            title: {
                text: 'm3'
            }
        },
        fill: {
            opacity: 1
        },
    };

    var chart = new ApexCharts(document.querySelector("#chartHorario"), options);
    chart.render();
</script>
