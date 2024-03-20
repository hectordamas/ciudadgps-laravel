@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Escritorio</h1>
</div>
<!-- Content Row -->
<div class="row">
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Comercios Registrados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Commerce::all()->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                          Registrados Hoy</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Commerce::whereDate('created_at', Carbon\Carbon::today())->count() }}</div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-store fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Notificaciones Enviadas
                    </div>
                    @php
                        $notifications = App\Models\PushNotification::all()->count();
                    @endphp
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$notifications}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-bell fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Usuarios Registrados
                      </div>
                      @php
                          $users = App\Models\User::all()->count();
                      @endphp
                      <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$users}}</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
              </div>
          </div>
      </div>
  </div>

</div>
<!-- Content Row -->
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            @php
                $meses = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $mesesEscritos = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                $montosPorMes = [];

                for($i = 0; $i < count($meses); $i++){
                    $monto = App\Models\Commerce::whereNotNull('paid')->whereMonth('created_at', '=', $meses[$i])->whereYear('created_at', '=', date('Y'))->count() * 45;
                    array_push($montosPorMes, $monto);
                }

            @endphp
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Ingresos del Año</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart" class="d-none"></canvas>
                    <canvas id="gananciasMensuales"></canvas>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            @php
                $comerciosPorCategorias = collect([]);
                $categories = App\Models\Category::all();
                $diezCategorias = [];
                $numeroPorCategoria = [];

                foreach($categories as $cat){
                    $comerciosPorCategorias->push(['nombre' => $cat->name, 'cantidad' => $cat->commerces->count()]);
                }

                foreach ($comerciosPorCategorias->sortByDesc('cantidad')->take(10) as $cxc) {
                    array_push($diezCategorias, $cxc['nombre']);
                    array_push($numeroPorCategoria, $cxc['cantidad']);
                }
            @endphp
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Comercios por Categorìas</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="comerciosPorCategorias"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Comercios Registrados</h6>
            </div>
            <!-- Card Body -->
            @php
                $status = ['Inactivos', 'Activos'];
                $comerciosActivos = App\Models\Commerce::whereNotNull('paid')->count();
                $comerciosInactivos = App\Models\Commerce::whereNull('paid')->count();
                $comerciosRegistrados = [$comerciosInactivos, $comerciosActivos];
            @endphp
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart" class="d-none"></canvas>
                    <canvas id="comerciosRegistrados"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Inactivos
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Activos
                    </span>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Comercios por Expirar</h6>
            </div>
            <!-- Card Body -->
            @php
                $statusE = ['Expirados', 'Por Expirar'];
                $comerciosPorExpirar = App\Models\Commerce::where('expiration_date', '>=', date('Y-m-d'))->count();
                $comerciosExpirados = App\Models\Commerce::where('expiration_date', '<=', date('Y-m-d'))->count();
                $comerciosPorExpiracion = [$comerciosExpirados, $comerciosPorExpirar];
            @endphp
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="comerciosPorExpiracion"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Expirados
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Por Expirar
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('chart')
<script>
    // Area Chart Example
var ctx = document.getElementById("gananciasMensuales");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: {!! json_encode($mesesEscritos) !!},
    datasets: [{
      label: "Ingresos",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: {!! json_encode($montosPorMes) !!},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});


var ctx = document.getElementById("comerciosPorCategorias");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: {!! json_encode($diezCategorias) !!},
    datasets: [{
      label: "Comercios",
      lineTension: 0.3,
      backgroundColor: "rgba(28, 200, 138, 1)",
      borderColor: "rgba(28, 200, 138, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(28, 200, 138, 1)",
      pointBorderColor: "rgba(28, 200, 138, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
      pointHoverBorderColor: "rgba(28, 200, 138, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: {!! json_encode($numeroPorCategoria) !!},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
    }
  }
});



var ctx = document.getElementById("comerciosRegistrados");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: {!! json_encode($status) !!},
    datasets: [{
      data: {!! json_encode($comerciosRegistrados) !!},
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});



var ctx = document.getElementById("comerciosPorExpiracion");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: {!! json_encode($statusE) !!},
    datasets: [{
      data: {!! json_encode($comerciosPorExpiracion) !!},
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


</script>
@endsection
