// -------------------------------------------------------------------------------------------------------------------------------------------
// Dashboard (Home) : Chart Init Js
// -------------------------------------------------------------------------------------------------------------------------------------------
$(function () {
  "use strict";

  var consumption1 = [null, null, null, null, null, null, null, null, null, null, null, null, ];
  var projection1 = [];
  var goal1 = [];

  function OptionChart1() {
      var options_chart1 = {
          series: [
              {
                  name: 'Consumo',
                  type: 'column',
                  data: consumption1
              },
              {
                  name: 'Projeção',
                  type: 'column',
                  data: projection1
              },
              {
                  name: 'Meta',
                  type: 'line',
                  data: goal1
              }
          ],
          chart: {
              height: 350,
              type: 'line',
              stacked: false,
              toolbar: {
                  export: {
                      csv: {
                          headerCategory: 'Mês',
                          columnDelimiter: ';'
                      }
                  }
              }
          },
          stroke: {
              width: [0, 0]
          },
          title: {
              text: ''
          },
          plotOptions: {
              bar: {
                  columnWidth: '100%'
              }
          },
          dataLabels: {
              style: {
                  colors: ['#F44336']
              },
              enabled: true,
              enabledOnSeries: [1]
          },
          colors: [
              function ({ value, seriesIndex, dataPointIndex, w }) {

                  if (value > goal1[dataPointIndex]) {
                      return '#FF0000'
                  } else {
                      return '#39c449'
                  }
              },
              function ({ value, seriesIndex, w }) {
                  return '#EBEBEB'
              },
              function ({ value, seriesIndex, w }) {
                  return '#000000'
              }
          ],
          labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          xaxis: {
              type: 'category'
          },
          yaxis: [{
              decimalsInFloat: 2,
              labels: {
                  floating: false,
                  formatter: function (val, index) {
                      return val;
                  }
              },
              title: {
                  text: 'R$'
              },
          }]
      };

      return options_chart1;
  }

  // Instância do Chart1
  var chart1 = new ApexCharts(document.querySelector("#chart1e"), OptionChart1());
  chart1.render();
});
// FIM
