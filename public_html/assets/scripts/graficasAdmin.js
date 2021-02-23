var $primary = '#7367F0';
var $success = '#28C76F';
var $danger = '#EA5455';
var $warning = '#FF9F43';
var $info = '#00cfe8';
var $primary_light = '#A9A2F6';
var $danger_light = '#f29292';
var $success_light = '#55DD92';
var $warning_light = '#ffc085';
var $info_light = '#1fcadb';
var $strok_color = '#b9c3cd';
var $label_color = '#e7e7e7';
var $white = '#fff';

function totalInversiones($inversiones) {
    $inversiones = JSON.parse($inversiones)
    var gainedlineChartoptions = {
        chart: {
            height: 100,
            type: 'area',
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: true
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0
                }
            },
        },
        colors: [$primary],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2.5
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.9,
                opacityFrom: 0.7,
                opacityTo: 0.5,
                stops: [0, 80, 100]
            }
        },
        series: [{
            name: 'Inversiones Activas',
            data: $inversiones
        }],
    
        xaxis: {
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            }
        },
        yaxis: [{
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: {
                left: 0,
                right: 0
            },
        }],
        tooltip: {
            x: {
                show: false
            }
        },
    }
    
    var gainedlineChart = new ApexCharts(
        document.querySelector("#line-area-chart-1"),
        gainedlineChartoptions
    );
    
    gainedlineChart.render();
    
}

function totalInvertido(invertido) {
    invertido = JSON.parse(invertido)
    var revenuelineChartoptions = {
        chart: {
            height: 100,
            type: 'area',
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: true
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0
                }
            },
        },
        colors: [$success],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2.5
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.9,
                opacityFrom: 0.7,
                opacityTo: 0.5,
                stops: [0, 80, 100]
            }
        },
        series: [{
            name: 'Invertido',
            data: invertido
        }],
    
        xaxis: {
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            }
        },
        yaxis: [{
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: {
                left: 0,
                right: 0
            },
        }],
        tooltip: {
            x: {
                show: false
            }
        },
    }
    
    var revenuelineChart = new ApexCharts(
        document.querySelector("#line-area-chart-2"),
        revenuelineChartoptions
    );
    
    revenuelineChart.render();
}

function totalUsers(users) {
  users = JSON.parse(users)
  var saleslineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$danger],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Usuarios',
      data: users
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var saleslineChart = new ApexCharts(
    document.querySelector("#line-area-chart-3"),
    saleslineChartoptions
  );

  saleslineChart.render();
}

function entradaMensual(anterior, actual) {
    dias = []
    mesAnterior = JSON.parse(anterior)
    mesActual = JSON.parse(actual)
    for (let i = 0; i < 32; i++) {
        dias.push(i)
    }
    var revenueChartoptions = {
        chart: {
          height: 270,
          toolbar: { show: false },
          type: 'line',
        },
        stroke: {
          curve: 'smooth',
          dashArray: [0, 8],
          width: [4, 2],
        },
        grid: {
          borderColor: $label_color,
        },
        legend: {
          show: false,
        },
        colors: [$danger_light, $strok_color],
    
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            inverseColors: false,
            gradientToColors: [$primary, $strok_color],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
          },
        },
        markers: {
          size: 0,
          hover: {
            size: 5
          }
        },
        xaxis: {
          labels: {
            style: {
              colors: $strok_color,
            }
          },
          axisTicks: {
            show: false,
          },
          categories: dias,
          axisBorder: {
            show: false,
          },
          tickPlacement: 'on',
        },
        yaxis: {
          tickAmount: 5,
          labels: {
            style: {
              color: $strok_color,
            },
            formatter: function (val) {
              return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
            }
          }
        },
        tooltip: {
          x: { show: false }
        },
        series: [{
          name: "Mes Actual",
          data: mesActual
        },
        {
          name: "Mes Anterior",
          data: mesAnterior
        }
        ],
      }
    
      var revenueChart = new ApexCharts(
        document.querySelector("#revenue-chart"),
        revenueChartoptions
      );
    
      revenueChart.render();
}

function divisiones(divisiones) {
  divisiones = JSON.parse(divisiones)
  var customerChartoptions = {
    chart: {
      type: 'pie',
      height: 330,
      dropShadow: {
        enabled: false,
        blur: 5,
        left: 1,
        top: 1,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    labels: ['ORO', 'PLATA', 'BRONCE'],
    series: divisiones,
    dataLabels: {
      enabled: false
    },
    legend: { show: false },
    stroke: {
      width: 5
    },
    colors: [$warning, $primary, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$warning_light, $primary_light, $danger_light]
      }
    }
  }

  var customerChart = new ApexCharts(
    document.querySelector("#customer-chart"),
    customerChartoptions
  );

  customerChart.render();

}