var label5 = ['00:30','01:30','02:30','03:30','04:30','05:30','06:30','07:30','08:30','09:30','10:30','11:30','12:30','13:30','14:30','15:30','16:30','17:30','18:30','19:30','20:30','21:30','22:30','23:30'];
var projecao = [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07, 5.8, 2, 7.37, 8.1, 13.57, null, null, null, null,null, null,null, null,null];
var options = {
  series: [{
    name: 'Cash Flow',
    data: projecao
  }],
  chart: {
    type: 'bar',
    height: 350
  },
  plotOptions: {
    bar: {
      colors: {
        ranges: [{
          from: -100,
          to: -46,
          color: '#F15B46'
        }, {
          from: -45,
          to: 0,
          color: '#FEB019'
        }]
      },
      columnWidth: '80%',
    }
  },
  dataLabels: {
    style: {
      colors: ['#F44336']
  },
  enabled: true,
  enabledOnSeries: [1]
  },
  yaxis: [{
    decimalsInFloat: 2,
    labels: {
        decimalsInFloat: 0,
        floating: false     
    },
    title: {
        text: 'kw',
    },
}],
  labels: label5,
xaxis: {
    type: 'category'
},

};

var chart = new ApexCharts(document.querySelector("#chart5e"), options);
chart.render();
