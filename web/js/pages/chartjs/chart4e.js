
var label2 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
var projection2 = [10, 2, 12, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null];
var consumption2 = [25, 20, 30, 10, 8];
var projecao = [25, 20, 30, 10, 8];
var options = {
  series: [{
  name: 'Fora ponta',
  data: projection2
}, {
  name: 'Ponta',
  data: consumption2
}, {
  name: 'Projeção de consumo',
  data: projecao
}],
  chart: {
  type: 'bar',
  height: 350,
  stacked: true,
  stackType: '100%'
},
responsive: [{
  breakpoint: 480,
  options: {
    legend: {
      position: 'bottom',
      offsetX: -10,
      offsetY: 0
    }
  }
}],
labels: label2,
xaxis: {
    type: 'category'
},
yaxis: [{
  title: {
      text: 'kwh'
  },
}],
fill: {
  opacity: 1
},
legend: {
  position: 'right',
  offsetX: 0,
  offsetY: 50
},
dataLabels: {
  enabled: false // Esta configuração desativa as etiquetas de dados
},
colors: ['#6DC4FD', 
  '#6CFFCD', 
  '#E4ECF5']
};

var chart = new ApexCharts(document.querySelector("#chart4e"), options);
chart.render();