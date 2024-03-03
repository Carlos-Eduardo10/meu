<?php

use app\models\Dashboard;


$dia = date("Y-m-d", strtotime($data));
$data = explode("-", $data);


$diasDoMes = Dashboard::horasDoDiaReduzido();
$diasDoMesExibirGraph = json_encode(array_values($diasDoMes));

$consumoDiario = Dashboard::consumoPorHoraAcumulado($data[2], $data[1], $dia);
$consumoDiarioExibirGraph = json_encode($consumoDiario['consume']);

$mediaDiarioExibirGraph = json_encode($media['acuHours']);

?>
<div id="chartHorarioAcumulado"></div>
<script>
    var consumo = <?= $consumoDiarioExibirGraph ?>;
    var meta = <?= $mediaDiarioExibirGraph ?>;
    var options = {
        series: [{
                name: 'Consumo',
                type: 'bar',
                data: consumo
            },
            {
                name: 'Meta',
                type: 'line',
                data: meta,
                color: "#000",
                stroke: {
                    colors: ['#000']
                },
            }
        ],
        chart: {
            type: 'line',
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
                        return '#ff2626';
                    } else {
                        return '#56cc64';
                    }
                } else {
                    return 'black';
                }
            }
        ],
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

    var chart = new ApexCharts(document.querySelector("#chartHorarioAcumulado"), options);
    chart.render();
</script>

