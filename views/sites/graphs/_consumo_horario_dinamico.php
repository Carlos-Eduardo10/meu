<?php

use app\models\Dashboard;


$diasDoMes = Dashboard::horasDoDiaReduzido();
$diasDoMesExibirGraph = json_encode(array_values($diasDoMes));

$consumoDiario = Dashboard::consumoPorHoraDinamico();
$consumoDiarioExibirGraph = json_encode($consumoDiario['consume']);


?>

<div id="chartHorarioDinamico"></div>
<script>
    var options = {
        series: [{
            name: 'Consumo',
            data: <?= $consumoDiarioExibirGraph ?>
        }, ],
        chart: {
            type: 'area',
            height: 355
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
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

    var chart = new ApexCharts(document.querySelector("#chartHorarioDinamico"), options);
    chart.render();
</script>