function graficoConsumoMensal(year) {
  $.ajax({
    url: "/sites/graph-consumo-mensal", // Use a URL correta aqui
    data: {
      year: year,
    },
    success: function (data) {
      createChart(data);
    },
  });
}
var chart = null;
function createChart(data) {
  var options = {
    xaxis: {
      categories: data.mesesDoAno,
    },
    series: [
      {
        name: "Consumo",
        type: "bar",
        data: data.consumoMensal.consume,
      },
      {
        name: "Meta",
        type: "line",
        data: data.mediaMensal,
        color: "#000",
        stroke: {
          colors: ["#000"],
        },
      },
    ],
    chart: {
      type: "line",
      height: 350,
      toolbar: {
        show: true,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
      },
    },
    colors: [
      function ({ value, seriesIndex, dataPointIndex, w }) {
        if (seriesIndex === 0) {
          var metaValue = w.globals.series[1][dataPointIndex];
          if (value > metaValue  && metaValue > 1) {
            return "#ff2626"; // Vermelho se o consumo for maior que a meta
          } else {
            return "#56cc64"; // Verde se o consumo for menor ou igual à meta
          }
        } else {
          return "black"; // A linha da meta é sempre preta
        }
      },
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent", "#000"], // Define a cor da borda da barra 'Consumo' e da linha 'Meta'
    },
    xaxis: {
      categories: data.mesesDoAno,
    },
    yaxis: {
      title: {
        text: "m3",
      },
    },
    fill: {
      opacity: 1,
    },
  };

  if (chart === null) {
    // Crie o gráfico somente se ele ainda não existir
    chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    totalMedia = data.mediaMensal.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaMensal || totalMedia <= 1) {
      chart.hideSeries('Meta')
    }

  } else {
    // Se o gráfico já existe, atualize seus dados
    chart.updateOptions(
      {
        series: [
          {
            name: "Consumo",
            type: "bar",
            data: data.consumoMensal.consume,
          },
          {
            name: "Meta",
            type: "line",
            data: data.mediaMensal,
            color: "#000",
            stroke: {
              colors: ["#000"],
            },
          },
        ],
        xaxis: {
          categories: data.mesesDoAno,
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }
}

function graficoConsumoDiario(mes, ano) {
  $.ajax({
    url: "/sites/graph-consumo-diario", // Use a URL correta aqui
    data: {
      mes: mes,
      ano: ano,
    },
    success: function (data) {
      createChartDiario(data);
    },
  });
}

var chartDiario = null; // Armazenar a referência ao gráfico aqui
function createChartDiario(data) {
  var options = {
    series: [
      {
        name: "Consumo",
        type: "bar",
        data: data.consumoDiario.consume,
      },
      {
        name: "Meta",
        type: "line",
        data: data.mediaDiario,
        color: "#000",
        stroke: {
          colors: ["#000"], // Define a cor da linha da 'Meta' como preta
        },
      },
    ],
    chart: {
      type: "line",
      height: 350,
      toolbar: {
        show: true,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
      },
    },
    colors: [
      function ({ value, seriesIndex, dataPointIndex, w }) {
        if (seriesIndex === 0) {
          var metaValue = w.globals.series[1][dataPointIndex];
          if (value > metaValue  && metaValue > 1) {
            return "#ff2626"; // Vermelho se o consumo for maior que a meta
          } else {
            return "#56cc64"; // Verde se o consumo for menor ou igual à meta
          }
        } else {
          return "black"; // A linha da meta é sempre preta
        }
      },
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent", "#000"], // Define a cor da borda da barra 'Consumo' e da linha 'Meta'
    },
    xaxis: {
      categories: data.diasDoMes,
    },
    yaxis: {
      title: {
        text: "m3",
      },
    },
    fill: {
      opacity: 1,
    },
  };

  if (chartDiario === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartDiario = new ApexCharts(
      document.querySelector("#chartDiario"),
      options
    );
    chartDiario.render();
    totalMedia = data.mediaDiario.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaDiario || totalMedia <= 1) {
      chartDiario.hideSeries('Meta')
    }
  } else {
    // Se o gráfico já existe, atualize seus dados
    chartDiario.updateOptions(
      {
        series: [
          {
            name: "Consumo",
            type: "bar",
            data: data.consumoDiario.consume,
          },
          {
            name: "Meta",
            type: "line",
            data: data.mediaDiario,
            color: "#000",
            stroke: {
              colors: ["#000"],
            },
          },
        ],
        xaxis: {
          categories: data.diasDoMes,
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }
}

function graficoConsumoHorario(day) {
  $.ajax({
    url: "/sites/graph-consumo-horario", // Use a URL correta aqui
    data: {
      day: day,
    },
    success: function (data) {
      createChartHorario(data);
    },
  });
}

var chartHorario = null; // Armazenar a referência ao gráfico aqui
function createChartHorario(data) {
  var options = {
    series: [
      {
        name: "Consumo",
        type: "bar",
        data: data.consumoHorario.consume,
      },
    ],
    chart: {
      height: 350,
      toolbar: {
        show: true,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
      },
    },
    colors: ["#56cc64"],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent", "#000"],
    },
    xaxis: {
      categories: data.horasDoDia,
    },
    yaxis: {
      title: {
        text: "m3",
      },
    },
    fill: {
      opacity: 1,
    },
  };

  if (chartHorario === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartHorario = new ApexCharts(
      document.querySelector("#chartHorario"),
      options
    );
    chartHorario.render();
  } else {
    // Se o gráfico já existe, atualize seus dados
    chartHorario.updateOptions(
      {
        series: [
          {
            name: "Consumo",
            type: "bar",
            data: data.consumoHorario.consume,
          },
        ],
        xaxis: {
          categories: data.horasDoDia,
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }
}

function graficoConsumoHorarioAcumulado(day) {
  $.ajax({
    url: "/sites/graph-consumo-horario-acumulado", // Use a URL correta aqui
    data: {
      day: day,
    },
    success: function (data) {
      createChartHorarioAcumulado(data);
    },
  });
}

var chartHorarioAcumulado = null;
function createChartHorarioAcumulado(data) {
  var options = {
    series: [
      {
        name: "Consumo",
        type: "bar",
        data: data.consumoHorarioAcumulado.consume,
      },
      {
        name: "Meta",
        type: "line",
        data: data.mediaHorarioAcumulado,
        color: "#000",
        stroke: {
          colors: ["#000"],
        },
      },
    ],
    chart: {
      type: "line",
      height: 350,
      toolbar: {
        show: true,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
      },
    },
    colors: [
      function ({ value, seriesIndex, dataPointIndex, w }) {
        if (seriesIndex === 0) {
          var metaValue = w.globals.series[1][dataPointIndex];
          if (value > metaValue  && metaValue > 1) {
            return "#ff2626";
          } else {
            return "#56cc64";
          }
        } else {
          return "black";
        }
      },
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent", "#000"],
    },
    xaxis: {
      categories: data.horasDoDia,
    },
    yaxis: {
      title: {
        text: "m3",
      },
    },
    fill: {
      opacity: 1,
    },
  };

  if (chartHorarioAcumulado === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartHorarioAcumulado = new ApexCharts(
      document.querySelector("#chartHorarioAcumulado"),
      options
    );
    chartHorarioAcumulado.render();
    totalMedia = data.mediaHorarioAcumulado.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.mediaHorarioAcumulado || totalMedia <= 1) {
      chartHorarioAcumulado.hideSeries('Meta')
    }
  } else {
    // Se o gráfico já existe, atualize seus dados
    chartHorarioAcumulado.updateOptions(
      {
        series: [
          {
            name: "Consumo",
            type: "bar",
            data: data.consumoHorarioAcumulado.consume,
          },
          {
            name: "Meta",
            type: "line",
            data: data.mediaHorarioAcumulado,
            color: "#000",
            stroke: {
              colors: ["#000"],
            },
          },
        ],
        xaxis: {
          categories: data.horasDoDia,
        },
      },
      true,
      true
    ); // o segundo argumento habilita a recriação do gráfico, o terceiro habilita a animação
  }
}

function graficoConsumoDiarioAcumulado(mes, ano) {
  $.ajax({
    url: "/sites/graph-consumo-diario-acumulado", // Use a URL correta aqui
    data: {
      mes: mes,
      ano: ano,
    },
    success: function (data) {
      createChartDiarioAcumulado(data);
    },
  });
}

var chartDiarioAcumulado = null;
function createChartDiarioAcumulado(data) {
  var options = {
    series: [
      {
        name: "Consumo Acumulado",
        type: "bar",
        data: data.consumoDiarioAcumulado,
      },
      {
        name: "Meta",
        type: "line",
        data: data.mediaDiario,
        color: "#000",
        stroke: {
          colors: ["#000"],
        },
      },
    ],
    chart: {
      type: "line",
      height: 350,
      toolbar: {
        show: true,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150,
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350,
        },
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
      },
    },
    colors: [
      function ({ value, seriesIndex, dataPointIndex, w }) {
        if (seriesIndex === 0) {
          var metaValue = w.globals.series[1][dataPointIndex];
          if (value > metaValue  && metaValue > 1) {
            return "#ff2626";
          } else {
            return "#56cc64";
          }
        } else {
          return "black";
        }
      },
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent", "#000"],
    },
    xaxis: {
      categories: data.diasDoMes,
    },
    yaxis: {
      title: {
        text: "m3",
      },
    },
    fill: {
      opacity: 1,
    },
  };

  if (chartDiarioAcumulado === null) {
    // Crie o gráfico somente se ele ainda não existir
    chartDiarioAcumulado = new ApexCharts(
      document.querySelector("#chartDiarioAcumulado"),
      options
    );
    chartDiarioAcumulado.render();
    totalMedia = data.consumoDiarioAcumulado.reduce((total, currentValue) => total + currentValue, 0);
    if(!data.consumoDiarioAcumulado || totalMedia <= 1) {
      chartDiarioAcumulado.hideSeries('Meta')
    }
  } else {
    // Se o gráfico já existe, atualize seus dados
    chartDiarioAcumulado.updateOptions(
      {
        series: [
          {
            name: "Consumo Acumulado",
            type: "bar",
            data: data.consumoDiarioAcumulado,
          },
          {
            name: "Meta",
            type: "line",
            data: data.mediaDiario,
            color: "#000",
            stroke: {
              colors: ["#000"],
            },
          },
        ],
        xaxis: {
          categories: data.diasDoMes,
        },
      },
      true,
      true
    );
  }
}

$(document).ready(function () {
  var currentYear = new Date().getFullYear();
  var currentMonth = new Date().getMonth() + 1; // Observe que getMonth() retorna um valor de 0 a 11
  var currentDate = new Date().toISOString().slice(0, 10); // Obtem a data atual no formato 'YYYY-MM-DD'

  graficoConsumoMensal(currentYear);

  $("#ymensal")
    .datepicker({
      format: "yyyy",
      startView: "years",
      minViewMode: "years",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var year = e.date.getFullYear();
      graficoConsumoMensal(year);
    });

  graficoConsumoDiario(currentMonth, currentYear);

  $("#ydiario")
    .datepicker({
      format: "mm-yyyy",
      startView: "months",
      minViewMode: "months",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var month = e.date.getMonth() + 1;
      var year = e.date.getFullYear();
      graficoConsumoDiario(month, year);
    });

  graficoConsumoHorario(currentDate);

  $("#chorario")
    .datepicker({
      format: "dd-mm-yyyy",
      startView: "days",
      minViewMode: "days",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var day = e.date.toISOString().slice(0, 10);
      graficoConsumoHorario(day);
    });

  graficoConsumoHorarioAcumulado(currentDate);

  $("#chorarioAcu")
    .datepicker({
      format: "dd-mm-yyyy",
      startView: "days",
      minViewMode: "days",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var day = e.date.toISOString().slice(0, 10);
      graficoConsumoHorarioAcumulado(day);
    });

  graficoConsumoDiarioAcumulado(currentMonth, currentYear);

  $("#ydiarioacumulado")
    .datepicker({
      format: "mm-yyyy",
      startView: "months",
      minViewMode: "months",
      autoclose: true,
    })
    .on("changeDate", function (e) {
      var month = e.date.getMonth() + 1;
      var year = e.date.getFullYear();
      graficoConsumoDiarioAcumulado(month, year);
    });
});
