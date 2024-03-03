

  var currentDate = new Date().toISOString().slice(0, 10);
  var chart3 = null;
  var foraPonta = [0];
  var ponta = [0];
  var contrato = [110];
  var limitContract = [100];
  var ultrapassagem = [];
  var ultrapassagemlimit = [];
  var goal3 = [8, 18, 13, 28, 22, 15, 20, 25, 32, 35, 30, 25, 18, 15, 25, 30];
  var label3 = ['00:00', '00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45', '04:00', '04:15', '04:30', '04:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45', '09:00', '09:15', '09:30', '09:45', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45', '17:00', '17:15', '17:30', '17:45', '18:00', '18:15', '18:30', '18:45', '19:00', '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00', '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00', '23:15', '23:30', '23:45'];

  function addConsumptionDayList(hour_number, v_consumption_demand_active_peak_kw, v_consumption_demand_active_out_peak_kw){        
    // Extrai horas e minutos de hour_number
    var [hour, minute] = hour_number.split(':').map(Number);
  
    // Calcula o índice correspondente ao intervalo de 15 minutos
    var intervalIndex = (hour * 60 + minute) / 15;
  
    // Atualiza os arrays foraPonta e ponta com os valores fornecidos
    foraPonta[intervalIndex] = parseFloat(v_consumption_demand_active_out_peak_kw).toFixed(2);
    ponta[intervalIndex] = parseFloat(v_consumption_demand_active_peak_kw).toFixed(2);
    
  }

    window.getConsumptionDay = function(){    
    
    input_id = $('#value').val();
    input_type = $('#type').val();
    input_day_month_year = $('#dt_day_month_year').val(); 
    //alert(input_day_month_year);
  
    if($('#dt_day_month_year_validate').val() == ""){
      $('#dt_day_month_year_validate').val(input_day_month_year);
      updateChart(input_id, input_type, input_day_month_year);
    }else{
      if($('#dt_day_month_year_validate').val() != input_day_month_year){
        $('#dt_day_month_year_validate').val(input_day_month_year);
        updateChart(input_id, input_type, input_day_month_year);
      }
    }

  }


  function Optionchart3() {
      var options_chart3 = {
          series: [
        {
            name: 'Fora Ponta',
            type: 'column',
            data: foraPonta
        }, 
        {
            name: 'Ponta',
            type: 'column',
            data: ponta
        },
        {
            name: 'Contrato',
            type: 'line',
            data: Array(label3.length).fill(contrato)
        }, 
        {
            name: 'Limite Contrato',
            type: 'line', // Change the type to 'line'
            data: Array(label3.length).fill(limitContract) // Set a constant value for "Limite Contrato"
        },
        {
            name: 'Ultrapassagem',
            type: 'column',
            data: ultrapassagem
        }, 
        {
            name: 'Ultrapassagem limite',
            type: 'column',
            data: ultrapassagemlimit
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
            '#39c449', // Cor para 'Fora Ponta'
            '#EBEBEB', // Cor para 'Ponta'
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
              decimalsInFloat: 2,
              labels: {
                  decimalsInFloat: 0,
                  floating: false     
              },
              title: {
                  text: 'kw',
              },
          }]
      };

      return options_chart3;
  }

  function graficoChart3e(day) {
    console.log(day);
    $.ajax({
        url: "/sites/graph-energia-consumo-horario", // Use a URL correta aqui
        data: {
          day: day,
        },
        success: function (data) {
            $.each(data, function( key, value ) { 
            addConsumptionDayList(value["hour_number"],value["v_consumption_demand_active_peak_kw"],value["v_consumption_demand_active_out_peak_kw"]);
            });
        },
      }).done(function() {
        chart3.render();
      });
  }

  
  if (chart3 === null) {
  var chart3 = new ApexCharts(document.querySelector("#chart3e"), Optionchart3());
  graficoChart3e();
  } else { 
    chart3.updateOptions(
        {
        series: [
            {
                name: 'Fora Ponta',
                type: 'column',
                data: foraPonta
            }, 
            {
                name: 'Ponta',
                type: 'column',
                data: ponta
            },
            {
                name: 'Contrato',
                type: 'line',
                data: Array(label3.length).fill(contrato)
            }, 
            {
                name: 'Limite Contrato',
                type: 'line', // Change the type to 'line'
                data: Array(label3.length).fill(limitContract) // Set a constant value for "Limite Contrato"
            },
            {
                name: 'Ultrapassagem',
                type: 'column',
                data: ultrapassagem
            }, 
            {
                name: 'Ultrapassagem limite',
                type: 'column',
                data: ultrapassagemlimit
            },
            ],      
        },
        true,
        true
    );
  }

  graficoChart3e(currentDate);

  
  $("#chorario")
  .datepicker({
    format: "dd-mm-yyyy",
    startView: "days",
    minViewMode: "days",
    autoclose: true,
  })
  .on("changeDate", function (e) {
    var day = e.date.toISOString().slice(0, 10);
    graficoChart3e(day);
  });
