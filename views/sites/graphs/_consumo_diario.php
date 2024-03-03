<?php

use app\models\Dashboard;

$diasDoMes = Dashboard::diasDoMesReduzido();
$filter = explode("-", $mes);
$diasDoMesExibirGraph = json_encode(array_values($diasDoMes));
$consumoDiario = Dashboard::consumoPorDia($filter[1], $filter[0]);
$consumoDiarioExibirGraph = json_encode($consumoDiario['consume']);
$mediaDiarioExibirGraph = json_encode($media['dailyValues']);

?>

<div id="chartDiario"></div>
<script>
    var consumo = <?= $consumoDiarioExibirGraph ?>;
    var meta = <?= $mediaDiarioExibirGraph ?>;

    var options = {
        series: [{
                name: 'Consumo',
                type: 'bar',
                data: consumo,
            },
            {
                name: 'Meta',
                type: 'line',
                data: meta,
                color: "#000",
                stroke: {
                    colors: ['#000'] // Define a cor da linha da 'Meta' como preta
                },
            }
        ],
        chart: {
            type: 'line',
            height: 350,
            toolbar: {
                show: true
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        colors: [
            function({
                value,
                seriesIndex,
                dataPointIndex,
                w
            }) {
                if (seriesIndex === 0) {
                    var metaValue = w.globals.series[1][dataPointIndex]
                    if (value > metaValue) {
                        return '#ff2626'; // Vermelho se o consumo for maior que a meta
                    } else {
                        return '#56cc64'; // Verde se o consumo for menor ou igual à meta
                    }
                } else {
                    return 'black'; // A linha da meta é sempre preta
                }
            }
        ],
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent', '#000'] // Define a cor da borda da barra 'Consumo' e da linha 'Meta'
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

    var chart = new ApexCharts(document.querySelector("#chartDiario"), options);
    chart.render();
</script>