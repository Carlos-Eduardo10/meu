var label3 = ['00:00', '00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '18:00', '18:15', '18:30', '18:45', '19:00', '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00', '23:15', '23:30', '23:45'];
var label5 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
var label2 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
var site_type = $('#site_type').val();
let contrato = [];
let limite_contrato = [];
let contrato_ponta = [];
let contrato_fora_ponta = [];

//Modificar validação pelo site_type que é INT
if(site_type == 1){
  contrato = [4900];
  limite_contrato = [5145];
  contrato_ponta =[4900];
  contrato_fora_ponta = [4900];
}


function graphPerfilCarga(day) {
  $.ajax({
    url: "/sites/graph-energia-consumo-horario", // Use a URL correta aqui
    data: {
      day: day,
    },
    success: function (data) {
      generateConsumptionListHorario();
      createPerfilCargaChart(data);
    },
  });
}

function addConsumptionDayListHorario(hour_number, v_consumption_demand_active_peak_kw, v_consumption_demand_active_out_peak_kw){        
  // Extrai horas e minutos de hour_number
  var [hour, minute] = hour_number.split(':').map(Number);

  // Calcula o índice correspondente ao intervalo de 15 minutos
  var intervalIndex = (hour * 60 + minute) / 15;

  // Atualiza os arrays foraPonta e ponta com os valores fornecidos
  v_consumption_demand_active_out_peak[intervalIndex] = parseFloat(v_consumption_demand_active_out_peak_kw).toFixed(2);
  v_consumption_demand_active_peak[intervalIndex] = parseFloat(v_consumption_demand_active_peak_kw).toFixed(2);
}

function generateConsumptionListHorario(){
  v_consumption_demand_active_out_peak = [];
  v_consumption_demand_active_peak = [];
  // Atualize o número de intervalos para representar 24 horas em intervalos de 15 minutos
  var number_intervals = 24 * 60 / 15;
  for (var i = 0; i < number_intervals; i++) {
    v_consumption_demand_active_out_peak[i] = null;
    v_consumption_demand_active_peak[i] = null;
  }
}

var chartPerfilCargaChart = null;
function createPerfilCargaChart(data) {

  $.each(data, function( key, value ) { 
    addConsumptionDayListHorario(value["hour_number"],value["v_consumption_demand_active_peak_kw"],value["v_consumption_demand_active_out_peak_kw"]);      
  });

  console.log('create', data);
  var options = {
    series: [
      {
          name: 'Fora Ponta',
          type: 'column',
          data: v_consumption_demand_active_out_peak
      }, 
      {
          name: 'Ponta',
          type: 'column',
          data: v_consumption_demand_active_peak
      },
      {
        name: 'Contrato',
        type: 'line',
        //data: Array(label3.length).fill([110])
        data: Array(label3.length).fill(contrato)
      }, 
      {
        name: 'Limite Contrato',
        type: 'line', // Change the type to 'line'
        //data: Array(label3.length).fill([100]) // Set a constant value for "Limite Contrato"
        data: Array(label3.length).fill(limite_contrato) // Set a constant value for "Limite Contrato"
      },
      {
          name: 'Ultrapassagem',
          type: 'column',
          data: []
      }, 
      {
          name: 'Ultrapassagem limite',
          type: 'column',
          data: []
      },
      
      ],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                export: {
                    csv: {
                        headerCategory: 'Hora',
                        columnDelimiter: ';'
                    }
                }
            },
            stacked: false,
        },
        stroke: {
          width: [0, 0, 2, 2, 0, 0],
          dashArray: [0, 8, 4]
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
            enabled: false,
            enabledOnSeries: [1]
        }, 
        colors: [
          '#0179bd', // Cor para 'Fora Ponta'
          '#39c449', // Cor para 'Ponta'
          '#3369FF', // Cor para 'Contrato'
          '#FF3369', // Cor para 'Limite Contrato'
          '#33FF69', // Cor para 'Ultrapassagem'
          '#009BCB',  // Cor para 'Ultrapassagem limite'
        ],  
        labels: label3,
        xaxis: {
            type: 'category'
        },
        yaxis: [{
            decimalsInFloat: 0,
            labels: {
                decimalsInFloat: 0,
                floating: false     
            },
            title: {
                text: 'kw',
            },
        }]
  };

  if (chartPerfilCargaChart === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartPerfilCargaChart = new ApexCharts(document.querySelector("#graphPerfilCarga"), options);
    chartPerfilCargaChart.render();
    /* totalMedia = data.mediaMensal.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaMensal || totalMedia <= 1) {
      chartPerfilCargaChart.hideSeries('Meta')
    } */

  } else {

    console.log('update', data);
    // Se o gráfico já existe, atualize seus dados
    chartPerfilCargaChart.updateOptions(
      {
        series: [
          {
            name: 'Fora Ponta',
            type: 'column',
            data: v_consumption_demand_active_out_peak
        }, 
        {
          name: 'Ponta',
          type: 'column',
          data: v_consumption_demand_active_peak
        },
        {
          name: 'Contrato',
          type: 'line',
          //data: Array(label3.length).fill([110])
          data: Array(label3.length).fill([])
        },
        {
          name: 'Limite Contrato',
          type: 'line', // Change the type to 'line'
          //data: Array(label3.length).fill([100]) // Set a constant value for "Limite Contrato"
          data: Array(label3.length).fill([]) // Set a constant value for "Limite Contrato"
        },
        {
            name: 'Ultrapassagem',
            type: 'column',
            data: []
        }, 
        {
            name: 'Ultrapassagem limite',
            type: 'column',
            data: []
        },
        ],
        labels: label3,
        xaxis: {
          type: 'category'
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }
}



function graphDemandaMaxima(currentMonth) {
  $.ajax({
    url: "/sites/graph-energia-consumo-mensal", // Use a URL correta aqui
    data: {
      currentMonth: currentMonth,
    },
    success: function (data) {
      generateConsumptionListMax(currentMonth);
      createDemandaMaximaChart(data);
    },
  });
}


function addConsumptionDayListMax(hour_number, max_total_energy_active_peak_kwh, maxx_total_energy_active_out_peak_kwh) {

  if (parseInt(hour_number) != 0) {
    max_consumption_value_out_peak[parseInt(hour_number) - 1] = parseFloat(maxx_total_energy_active_out_peak_kwh).toFixed(2);
    max_consumption_value_peak[parseInt(hour_number) - 1] = parseFloat(max_total_energy_active_peak_kwh).toFixed(2);
  } else {
    max_consumption_value_out_peak[31] = parseFloat(maxx_total_energy_active_out_peak_kwh).toFixed(2);
    max_consumption_value_peak[31] = parseFloat(max_total_energy_active_peak_kwh).toFixed(2);
  }
}

function getDaysMonthMax(input_month_year) {

  const month = input_month_year.split("-");
  var m = parseInt(month[0]);
  var y = parseInt(month[1]);

  if (m == 2) {
    return ((y % 4 == 0) && ((y % 100 != 0) || (y % 400 == 0))) ? 29 : 28;
  } else {
    if (m == 12) {
      return 31;
    } else {
      return (m % 2) == 0 ? 30 : 31;
    }

  }

}



function generateConsumptionListMax(input_month_year) {
  max_consumption_value_out_peak = [];
  max_consumption_value_peak = [];
  //consumption2.length = 0;
  var number_days = getDaysMonthMax(input_month_year);
  for (var i = 0; i < number_days; i++) {
    max_consumption_value_out_peak[i] = null;
    max_consumption_value_peak[i] = null;
  }
}


var chartDemandaMaxima = null;
function createDemandaMaximaChart(data) {
  console.log('createmax', data);

  $.each(data, function (key, value) {
    addConsumptionDayListMax(value["day_number"], value["max_consumption_value_peak"], value["max_consumption_value_out_peak"]);
  });

  var options_chart2 = {
    series: [
      {
        name: 'Fora Ponta',
        type: 'column',
        data: max_consumption_value_out_peak
      },
      {
        name: 'Ponta',
        type: 'column',
        data: max_consumption_value_peak
      },
      {
        name: 'Contrato fora ponta',  
        type: 'line',
        //data: Array(label5.length).fill([100])
        data: Array(label5.length).fill(contrato_fora_ponta)
      },
      {
        name: 'Contrato ponta',
        type: 'line', // Change the type to 'line'
        //data: Array(label5.length).fill([105]) // Set a constant value for "Limite Contrato"
        data: Array(label5.length).fill(contrato_ponta)
      },
      {
        name: 'Ultrapassagem',
        type: 'column',
        data: []
      },
      {
        name: 'Ultrapassagem limite',
        type: 'column',
        data: []
      },
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
      width: [0, 0, 2, 2, 0, 0],
      dashArray: [0, 8, 4]
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
      enabled: false,
      enabledOnSeries: [1]
    },
    colors: [
      '#0179bd', // Cor para 'Fora Ponta'
      '#39c449', // Cor para 'Ponta'
      '#3369FF', // Cor para 'Contrato'
      '#FF3369', // Cor para 'Limite Contrato'
      '#33FF69', // Cor para 'Ultrapassagem'
      '#009BCB',  // Cor para 'Ultrapassagem limite'
    ],
    labels: label5,
    xaxis: {
      type: 'category'
    },
    yaxis: [{
      decimalsInFloat: 0,
      labels: {
        floating: false,
        decimalsInFloat: 0,
      },
      title: {
        text: 'kw',
      },
    }],

  };


  if (chartDemandaMaxima === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartDemandaMaxima = new ApexCharts(document.querySelector("#graphDemandaMaxima"), options_chart2);
    chartDemandaMaxima.render();
    /* totalMedia = data.mediaMensal.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaMensal || totalMedia <= 1) {
      chartDemandaMaxima.hideSeries('Meta')
    } */

  } else {

    console.log('updatemax', data);
    // Se o gráfico já existe, atualize seus dados
    chartDemandaMaxima.updateOptions(
      {
        series: [
          {
            name: 'Fora Ponta',
            type: 'column',
            data: max_consumption_value_out_peak
          },
          {
            name: 'Ponta',
            type: 'column',
            data: max_consumption_value_peak
          },
          {
            name: 'Contrato',
            type: 'line',
            //data: Array(label5.length).fill([100])
            data: Array(label5.length).fill([])
          },
          {
            name: 'Limite Contrato',
            type: 'line', // Change the type to 'line'
            //data: Array(label5.length).fill([105]) // Set a constant value for "Limite Contrato"
            data: Array(label5.length).fill([]) // Set a constant value for "Limite Contrato"
          },
          {
            name: 'Ultrapassagem',
            type: 'column',
            data: []
          },
          {
            name: 'Ultrapassagem limite',
            type: 'column',
            data: []
          },
        ],
        labels: label5,
        xaxis: {
          type: 'category'
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }


}



 function graphEnergiaConsumo(currentMonth) {
  $.ajax({
    url: "/sites/graph-energia-consumo", // Use a URL correta aqui
    data: {
      currentMonth: currentMonth,
    },
    success: function (data) {
      generateConsumptionList(currentMonth);
      createEnergiaConsumoChart(data);
    },
  });
}

function addConsumptionDayList(hour_number, total_energy_active_peak_kwh, total_energy_active_out_peak_kwh){        
        
  if(parseInt(hour_number) != 0){
    total_energy_active_out_peak[parseInt(hour_number)-1] = parseFloat(total_energy_active_out_peak_kwh).toFixed(2);
    total_energy_active_peak[parseInt(hour_number)-1] = parseFloat(total_energy_active_peak_kwh ).toFixed(2);
  }else{
    total_energy_active_out_peak[31] = parseFloat(total_energy_active_out_peak_kwh).toFixed(2);
    total_energy_active_peak[31] = parseFloat(total_energy_active_peak_kwh).toFixed(2);
  }
}

function getDaysMonth(input_month_year){

  const month = input_month_year.split("-");    
  var m = parseInt(month[0]);
  var y = parseInt(month[1]);
    
  if (m == 2) {         
      return ( (y % 4 == 0) && ( (y % 100 != 0 ) || (y % 400 == 0) ) ) ? 29 : 28;
  } else {
      if(m==12){
        return 31;
      }else{
        return (m % 2) == 0 ? 30 : 31;
      }            
      
  }

}



function generateConsumptionList(input_month_year){
  total_energy_active_out_peak = [];
  total_energy_active_peak = [];
  //consumption2.length = 0;
  var number_days = getDaysMonth(input_month_year);     
  for (var i = 0; i < number_days; i++) {
    total_energy_active_out_peak[i] = null;  
    total_energy_active_peak[i] = null;     
  }       
}

var chartEnergiaConsumo = null;
function createEnergiaConsumoChart(data) { 
  console.log(data);
  
  $.each(data, function( key, value ) {      
    addConsumptionDayList(value["day_number"],value["total_energy_active_peak_kwh"],value["total_energy_active_out_peak_kwh"]); 
  });


  var options_chart3 = {
    series: [{
      name: 'Fora ponta',
      data: total_energy_active_out_peak
    }, {
      name: 'Ponta',
      data: total_energy_active_peak
    }, {
      name: 'Projeção de consumo',
      data: [  ]
    }],
    chart: {
      type: 'bar',
      height: 350,
      stacked: true,
      stackType: 'normal',
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
      decimalsInFloat: 0,
      labels: {
        decimalsInFloat: 0,
        floating: false
      }
    }],
    fill: {
      opacity: 1
    },
    legend: {
      position: 'bottom',
      offsetX: 0,
      offsetY: 0
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#0179bd', // Cor para 'Fora Ponta'
    '#39c449', // Cor para 'Ponta'
    '#E4ECF5'],
    tooltip: {
      intersect: false, // Defina intersect como false
      x: {
        formatter: function (val, opts) {
          if (opts && opts.dataPointIndex !== undefined) {
            let dayValues = options_chart3.series.map(series => series.data[opts.dataPointIndex]);
            let foraPonta = options_chart3.series[0].data[opts.dataPointIndex];
            let ponta = options_chart3.series[1].data[opts.dataPointIndex];

           // Verificar se os valores são nulos ou indefinidos e atribuir 0 se necessário
           foraPonta = foraPonta != null ? parseFloat(foraPonta) : 0;
           ponta = ponta != null ? parseFloat(ponta) : 0;
            // Calcular a soma
            let total = foraPonta + ponta;
            return `Dia: ${label2[opts.dataPointIndex]} - Soma: ${total} kWh`;
          }
          return '';
        }
      },
      shared: true,
      y: {
        formatter: function (val, opts) {
          // Verificar se o valor é nulo ou indefinido e atribuir 0 se necessário
          val = val != null ? val : 0;
    
          return val + ' kWh';
        }
      }
    }
  };

  if (chartEnergiaConsumo === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartEnergiaConsumo = new ApexCharts(document.querySelector("#graphEnergiaConsumo"), options_chart3);
    chartEnergiaConsumo.render();
    /* totalMedia = data.mediaMensal.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaMensal || totalMedia <= 1) {
      chartEnergiaConsumo.hideSeries('Meta')
    } */

  } else {

    console.log('updatemax', data);
    // Se o gráfico já existe, atualize seus dados
    chartEnergiaConsumo.updateOptions(
      {
        series: [
          {
            name: 'Fora ponta',
            data: total_energy_active_out_peak
          }, 
          {
            name: 'Ponta',
            data: total_energy_active_peak
          }, 
          {
            name: 'Projeção de consumo',
            data: [ 0 ]
          }
        ],
        labels: label2,
        xaxis: {
            type: 'category'
        },
        yaxis: [{
          decimalsInFloat: 0,
          labels: {
            decimalsInFloat: 0,
            floating: false
          }
        }],
        tooltip: {
          intersect: false, // Defina intersect como false
          x: {
            formatter: function (val, opts) {
              if (opts && opts.dataPointIndex !== undefined) {
                let dayValues = options_chart3.series.map(series => series.data[opts.dataPointIndex]);
                let foraPonta = options_chart3.series[0].data[opts.dataPointIndex];
                let ponta = options_chart3.series[1].data[opts.dataPointIndex];
                foraPonta = parseFloat(foraPonta);
                ponta = parseFloat(ponta);
                // Calcular a soma
                let total = foraPonta + ponta;
                return `Dia: ${label2[opts.dataPointIndex]} - Soma: ${total} kWh`;
              }
              return '';
            }
          },
          shared: true,
          y: {
            formatter: function (val, opts) {
              
             
              return val + 'kWh';
            }
          }
        }
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }


}


function graphConsumoPostoTarifado(currentMonth) {
  $.ajax({
    url: "/sites/graph-consumo-posto-tarifado", // Use a URL correta aqui
    data: {
      currentMonth: currentMonth,
    },
    success: function (data) {
      createEnergiaConsumoPostoTarifadoChart(data);
    },
  });
}

function updateTable() {

}

var chartEnergiaConsumoPostoTarifado = null;
var array = null;
function createEnergiaConsumoPostoTarifadoChart(data) { 
  var array = [];
  array.push(parseFloat(data.soma_total_energy_active_peak_kwh));
  array.push(parseFloat(data.soma_total_energy_active_out_peak_kwh));

  // Selecione a tabela e as células específicas onde deseja exibir os valores do gráfico
  var table = document.getElementById('pie');
  var pontaCell = table.rows[1].cells[1];
  var foraPontaCell = table.rows[2].cells[1];
  var totalCell = table.rows[3].cells[1];

  // Verifique se os valores em array são indefinidos ou nulos e, se sim, defina-os como 0
  var pontaValue = array[0] || 0;
  var foraPontaValue = array[1] || 0;
  console.log(array)

  // Calcule as porcentagens
  var total = pontaValue + foraPontaValue;
  var pontaPercentage = isNaN((pontaValue / total) * 100) ? 0 : (pontaValue / total) * 100;
  var foraPontaPercentage = isNaN((foraPontaValue / total) * 100) ? 0 : (foraPontaValue / total) * 100;

  // Atualize as células com os valores calculados
  pontaCell.textContent = `${Number(pontaValue.toFixed(0)).toLocaleString()} `;
  foraPontaCell.textContent = `${Number(foraPontaValue.toFixed(0)).toLocaleString('pt-BR', { maximumFractionDigits: 1 })} `;
  totalCell.textContent = `${Number(total.toFixed(0)).toLocaleString()} `;

  // Adicione as células de porcentagem
  pontaCell.nextElementSibling.textContent = `${pontaPercentage.toFixed(1).replace('.', ',')}`;
  foraPontaCell.nextElementSibling.textContent = `${foraPontaPercentage.toFixed(1).replace('.', ',')}`;
  totalCell.nextElementSibling.textContent = `${(100).toFixed(1).replace('.', ',')}`;

  //Tratando novamente as posições do array para exiberem apenas 2 casas decimais no gráfico
  array[0] = parseFloat(array[0].toFixed(2));  
  array[1] = parseFloat(array[1].toFixed(2));

  console.log(array);


  var options_simple = {
    series: array,
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      width: 380,
      margin: {
        left: 72, // Alinhar à esquerda
      },
      type: "pie",
    },
    labels: ["Ponta", "Fora Ponta"],
    colors: [
      '#39c449', // Cor para 'Fora Ponta'
      '#0179bd', // Cor para 'Ponta'      
      "#ee9d01", 
      "#f64e60", 
      "#adb5bd"],
    responsive: [
      {
        breakpoint: 1460,
        options: {
          chart: {
            width: 300,
          },
          legend: {
            position: "bottom",
          },
        },
      },
      {
        breakpoint: 1340,
        options: {
          chart: {
            width: 250,
          },
          legend: {
            position: "bottom",
          },
        },
      },
    ],
    legend: {
      position: "bottom",
      labels: {
        colors: ["#a1aab2"],
      },
    },
    plotOptions: {
      pie: {
        dataLabels: {
          position: "bottom",
        },
      },
    },
  };


  if (chartEnergiaConsumoPostoTarifado === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartEnergiaConsumoPostoTarifado = new ApexCharts(document.querySelector("#graphEnergiaConsumoPostoTarifado"), options_simple);
    chartEnergiaConsumoPostoTarifado.render();
    /* totalMedia = data.mediaMensal.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaMensal || totalMedia <= 1) {
      chartEnergiaConsumoPostoTarifado.hideSeries('Meta')
    } */

  } else {

    console.log('updatemax', data);
    // Se o gráfico já existe, atualize seus dados
    chartEnergiaConsumoPostoTarifado.updateOptions(
      {
        series: array,
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }

}


$(document).ready(function () {
  var currentYear = new Date().getFullYear();
  var currentMonth = new Date().getMonth() + 1; // Observe que getMonth() retorna um valor de 0 a 11
  var day = new Date().toISOString().slice(0, 10); // Obtem a data atual no formato 'YYYY-MM-DD'
  var formattedDate = currentMonth + '-' + currentYear;

  if (formattedDate.length == 6) {
    formattedDate = '0' + formattedDate;
  }

  graphPerfilCarga(day);

  graphDemandaMaxima(formattedDate);

  graphEnergiaConsumo(formattedDate);

  graphConsumoPostoTarifado(formattedDate);



  $("#ygraphPerfilCarga")
    .datepicker({
      format: "dd-mm-yyyy",
      startView: "days",
      minViewMode: "days",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var day = e.date.toISOString().slice(0, 10);
      graphPerfilCarga(day);
    });

    $("#ygraphDemandaMaxima")
    .datepicker({
      format: "mm-yyyy",
      startView: "months",
      minViewMode: "months",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var monthYear = (e.date.getMonth() + 1).toString().padStart(2, '0') + '-' + e.date.getFullYear();
      graphDemandaMaxima(monthYear);
    });

    $("#ygraphEnergiaConsumo")
    .datepicker({
      format: "mm-yyyy",
      startView: "months",
      minViewMode: "months",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var monthYear = (e.date.getMonth() + 1).toString().padStart(2, '0') + '-' + e.date.getFullYear();
      graphEnergiaConsumo(monthYear);
    });

    $("#ygraphConsumoPostoTarifado")
    .datepicker({
      format: "mm-yyyy",
      startView: "months",
      minViewMode: "months",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var monthYear = (e.date.getMonth() + 1).toString().padStart(2, '0') + '-' + e.date.getFullYear();
      graphConsumoPostoTarifado(monthYear);
    });

});