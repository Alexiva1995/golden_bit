$(document).ready(function () {
    // let url = 'admin/chart/ventas'
    // $.get(url, function (data) {
    //     barChart(data)
    //     donutsChart(data)
    // })

    // url = 'admin/chart/pagos'
    // $.get(url, function (data) {
    //     donutsChart(data)
    // })

    url = 'getcurrency'
    $.get(url, function (data) {
        data = JSON.parse(data)
        data.forEach(element => {
          $('#currencys').append(
            '<div class="col-4">'+
            '<div class="card mb-0">'+
                '<div class="card-body">'+
                    '<h5>'+ element.s+'<span class="float-right">'+element.cp+'</span>'+
                    '</h5>'+
                    '<h5 class="text-center">'+
                        '<span class="float-left">Open<br>'+element.o+'%</span>'+
                        '<span class="float-right">Close<br>'+element.c+'%</span>'+
                    '</h5>'+
                '</div>'+
            '</div>'+
        '</div>'
          )
        });
        carruselCurrency()
    })
})

/**
 * Permite hacer la grafica de los ingresos y las comisiones
 * @param {string} data 
 */
function barChart(data) {

    let ciclo = data

    // Column Chart
    // ----------------------------------
    var columnChartOptions = {
        chart: {
            height: 350,
            type: 'bar',
        },
        colors: ['#00646d'],
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded',
                columnWidth: '55%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
              width: 2,
              colors: ['transparent']
        },
        series: [
        //   {
        //     name: 'Ingresos',
        //     data: ingresos
        // },
         {
            name: 'Publicida Diaria',
            data: ciclo
        }
      ],
        legend: {
            offsetY: -10
        },
        xaxis: {
            categories: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
        },
        yaxis: {
            title: {
                text: 'Publicidad'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return  val
                }
            }
        }
    }
    var columnChart = new ApexCharts(
        document.querySelector("#g_publicidad"),
        columnChartOptions
    );

    columnChart.render();
}

function donutsChart(data) {
    data = JSON.parse(data)
    dataChart = [
        200,
        250,
    ]
  var donutChartOptions = {
    chart: {
      type: 'donut',
      height: 350
    },
    colors: ['#28C76F', '#7367F0'],
    series: dataChart,
    labels: ['Derecha', 'Izquierdad'],
    legend: {
      itemMargin: {
        horizontal: 2,
      },
      position: 'bottom'
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 350
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  }
  var donutChart = new ApexCharts(
    document.querySelector("#grafica_public"),
    donutChartOptions
  );

  donutChart.render();
}

function charLine(data) {
    data = JSON.parse(data)
    $('#nivel1').text(data.totalN1)
    $('#nivel2').text(data.totalN2)
    $('#nivel3').text(data.totalN3)
    $('#nivel4').text(data.totalN4)
    var lineChartOptions = {
        chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        colors: ['#7367F0', '#EA5455', '#28C76F','#00646d'],
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'straight'
        },
        series: [{
            name: "Nivel 1",
            data: data.totalMesN1,
        },{
            name: "Nivel 2",
            data: data.totalMesN2,
        },{
          name: "Nivel 3",
          data: data.totalMesN3,
        },{
          name: "Nivel 4",
          data: data.totalMesN4,
        }],
        labels: ['Nivel 1', 'Nivel 2', 'Nivel 3', 'Nivel 4'],
        // title: {
        //   text: 'Product Trends by Month',
        //   align: 'left'
        // },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        yaxis: {
          tickAmount: 5,
        }
      }
      var lineChart = new ApexCharts(
        document.querySelector("#usuarios"),
        lineChartOptions
      );
      lineChart.render();
}

function carruselCurrency() {
  $('#currencys').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
}