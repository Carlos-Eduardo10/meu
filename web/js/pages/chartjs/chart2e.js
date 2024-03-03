$(function () {
  "use strict";

  var consumption2 = [25, 20, 30, 10, 8];
  var projection2 = [10, 2, 12, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null];
  var goal2 = [/* suas metas estáticas aqui */];
  var label2 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];

  function Optionchart2() {
      var options_chart2 = {
          series: [{
                  name: 'Consumo',
                  type: 'column',
                  data: consumption2
              },
              {
                  name: 'Fora Ponta',
                  type: 'column',
                  data: projection2
              },
              {
                  name: 'Ponta',
                  type: 'column',
                  data: goal2
              },
              {
                  name: 'Contrato Fora Ponta',
                  type: 'column',
                  data: [/* dados da série 'Contrato Fora Ponta' aqui */]
              },
              {
                  name: 'Ultrapassagem',
                  type: 'column',
                  data: [/* dados da série 'Ultrapassagem' aqui */]
              },
              {
                  name: 'Ultrapassagem Limite',
                  type: 'column',
                  data: [/* dados da série 'Ultrapassagem Limite' aqui */]
              }
          ],
          chart: {
              height: 350,
              type: 'line',
              toolbar: {
                  export: {
                      csv: {
                          headerCategory: 'Dia',
                          columnDelimiter: ';'
                      }
                  }
              },
              stacked: false,
          },
          stroke: {
              width: [0, 0, 0, 0, 0, 0, 0, 0]
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
              '#39c449', // Cor para 'Consumo'
              '#EBEBEB', // Cor para 'Projeção'
              '#000000', // Cor para 'Meta'
              '#FF0000', // Cor para 'Fora Ponta'
              '#FF3369', // Cor para 'Ponta'
              '#3369FF', // Cor para 'Contrato Fora Ponta'
              '#33FF69', // Cor para 'Ultrapassagem'
              '#009BCB' // Cor para 'Ultrapassagem Limite'
          ],
          labels: label2,
          xaxis: {
              type: 'category'
          },
          yaxis: [{
              decimalsInFloat: 2,
              labels: {
                  floating: false,
                  decimalsInFloat: 0,
              },
              title: {
                  text: 'kw',
              },
          }],

      };

      return options_chart2;
  }

  // Instância do chart2
  var chart2 = new ApexCharts(document.querySelector("#chart2e"), Optionchart2());
  chart2.render();
});
