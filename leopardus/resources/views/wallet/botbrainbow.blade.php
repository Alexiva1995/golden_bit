@extends('layouts.dashboard')

@section('content')

{{-- alertas --}}
@include('dashboard.componentView.alert')


<div class="card">
    <div class="card-content">
        <div class="card-body">
            <!-- Candlestick Chart -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bot Brainbow</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="column-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


@push('page_vendor_js')
<script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
@endpush

@push('custom_js')
<script>


  function graficaBot(data) {
    var $primary = '#7367F0',
    $success = '#28C76F',
    $danger = '#EA5455',
    $warning = '#FF9F43',
    $info = '#00cfe8',
    $label_color_light = '#dae1e7';

  var themeColors = [$primary, $success, $danger, $warning, $info];
  var columnChartOptions = {
    chart: {
      height: 350,
      type: 'bar',
    },
    colors: themeColors,
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
    series: [{
      name: 'Fondos Inversiones',
      data: data.fondos
    }, {
      name: 'Redes Neuronales',
      data: data.redes
    }, {
      name: 'Acciones',
      data: data.acciones
    }],
    legend: {
      offsetY: -10
    },
    xaxis: {
      categories: data.meses,
    },
    yaxis: {
      title: {
        text: 'Año '+data.year,
      }
    },
    fill: {
      opacity: 1

    },
    tooltip: {
      y: {
        formatter: function (val) {
          return  val + "%"
        }
      }
    }
  }

  var columnChart = new ApexCharts(
    document.querySelector("#column-chart"),
    columnChartOptions
  );

  columnChart.render();

  }
</script>
@php
@endphp
<script>
  $(document).ready(function (){
    $.ajax({
        url: "{{route('botbrainbow.get-data')}}",
        method: 'get',
        dataType: 'json',
        success: function(response) {
          graficaBot(response)
        }
    })
  })
  // $.get('../botbrainbow/get_brainbow', function (data) {
  //   graficaBot(data)
  // })
</script>
@endpush
@endsection