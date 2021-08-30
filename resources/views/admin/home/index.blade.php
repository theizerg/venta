@extends('layouts.admin')
@section('title', 'Inicio')
@section('page_title', 'Datos generales del sistema')
@section('content')
 @if (Auth::user()->hasRole('Super Administrador'))

<div class="container">
    <div class="row">
       <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box blue darken-4 text-white">
              <div class="inner">
                <h3>{{ App\Models\User::count() }}</h3>

                <p>Usuarios registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user fa-2x"></i>
              </div>
             
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box indigo accent-2  text-white">
              <div class="inner">
                <h3>{{Spatie\Permission\Models\Role::count()}}</h3>

                <p>Roles registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie fa-2x"></i>
              </div>
             
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box blue darken-4  text-white">
              <div class="inner">
                <h3>{{Spatie\Permission\Models\Permission::count()}}</h3>

                <p>Permisos registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-lock fa-2x"></i>
              </div>
             
            </div>
        </div>
            <div class="col-sm-12">
             <div class="card card-line-primary">
               <div class="card-header">
                <h5 class="h3 mb-0">Total de usuarios registrados durante los últimos 4 meses.</h5>
             </div>
            <div class="card-body">
              <div class="recent-report__chart">
                  <div id="chart2"></div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    @elseif(Auth::user()->hasRole('Gerente'))
    <div class="container">
       <div class="container-fluid">
           <div class="row">
               <div class="col-lg-4 col-12">
                <!-- small box -->
                 <div class="small-box blue darken-4  text-white">
                  <div class="inner">
                    <h3> {{ App\Models\Empleado::count() }}</h3>

                    <p>Empleados registrados</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users "></i>
                  </div>
                </div>
               </div>
                <div class="col-lg-4 col-12">
                <!-- small box -->
                 <div class="small-box blue accent-2  text-white">
                  <div class="inner">
                    <h3> {{ App\Models\Sucursales::count() }}</h3>

                    <p>Sucursales registrados</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-store-alt "></i>
                  </div>
                </div>
               </div>
               <div class="col-lg-4 col-12">
                <!-- small box -->
                 <div class="small-box blue darken-4  text-white">
                  <div class="inner">
                    <h3>{{ App\Models\Producto::count() }}</h3>

                    <p>Productos registrados</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-hands-helping "></i>
                  </div>
                </div>
               </div>
                <div class="col-lg-3 col-12">
                <!-- small box -->
                 <div class="small-box blue accent-2  text-white">
                  <div class="inner">
                    <h3>{{  App\Models\Comprobante::count() }}</h3>

                    <p>Ventas registradas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-cash-register "></i>
                  </div>
                </div>
               </div>
               <div class="col-lg-3 col-12">
                <!-- small box -->
                 <div class="small-box blue darken-4  text-white">
                  <div class="inner">
                    <h3>{{  App\Models\Compras::count() }}</h3>
                    <p>Compras registradas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-cash-register "></i>
                  </div>
                </div>
               </div>
               <div class="col-lg-3 col-12">
                <!-- small box -->
                 <div class="small-box blue accent-2  text-white">
                  <div class="inner">
                    <h3>{{  App\Models\Comprobante::where('tipo_comprobante_id', 3)->count() }}</h3>
                    <p>Cuentas por cobrar</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-cash-register "></i>
                  </div>
                </div>
               </div>
              <div class="col-lg-3 col-12">
                <!-- small box -->
                 <div class="small-box blue darken-4  text-white">
                  <div class="inner">
                    <h3>{{  App\Models\FacturasCompras::count() }}</h3>
                    <p>Cuentas por pagar</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-cash-register "></i>
                  </div>
                </div>
               </div>
               <div class="col-sm-12 float-right">
                  <div class="card bg-primary text-white elevation-2 mt-2">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendario actual
                </h3>
                <!-- tools card -->
                <br>
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
               </div>
               <div class="col-sm-12">
                   <div class="card card-line-primary">
                       <div class="card-header">
                           <p class="text-center">
                               Buscar ventas por rango de fechas
                           </p>
                           <div class="card-body">
                                <form method="post" action="{{url('ventas/desgloce')}}" autocomplete="off" id="empleados_form">
                            {{ csrf_field() }}
                              <div class="datepicker-form">
                                <div class="card-heading">
                                 <h4 class="card-title">Buscar por rango de fechas</h4><br><br>
                                 </div>
                                 <div class="input-group" data-date="23/11/2018" data-date-format="dd/mm/yyyy">
                                 <input id="txtFecha" type="date" name="desde" class=" datepicker form-control input-sm" title="Fecha del recibo">
                                 <input id="txtFecha" type="date" name="hasta" class=" datepicker form-control input-sm" title="Fecha del recibo">
                               </div>
                                 </div><br>
                                 <button type="submit" class="btn blue darken-4  form-control text-white"> Buscar</button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>

        <div class="col-sm-12">
            <div class="card card-statistics card-line-primary">
                <div class="row no-gutters">
                    <div class="col-xxl-3 col-lg-6">
                        <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                            <div class="d-flex m-b-10">
                                <p class="mb-0 font-regular text-muted font-weight-bold ml-5"></p>
                                
                            </div>
                           <div class="d-block d-sm-flex h-100 align-items-center">
                               
                                <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                   <div class="c3chart-wrapper">
                                    <div id="c3demo59"></div>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-xxl-3 col-lg-6">
                          <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                              <div class="d-flex m-b-10">
                                  <p class="mb-0 font-regular text-muted font-weight-bold ml-5"></p>
                                  
                              </div>
                              <div class="d-block d-sm-flex h-100 align-items-center">
          
                                  <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                     <div class="c3chart-wrapper">
                                          <div id="GananciasGastos"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>                   
                    </div>
                </div>
             </div>
            </div>
        </div>
    </div>
@else
 <div class="row">
        <div class="col-sm-12">
            <div class="card card-statistics card-line-primary">
                <div class="row no-gutters">
                    <div class="col-xxl-3 col-lg-6">
                        <div class="p-20 border-lg-right border-bottom border-xxl-bottom-0">
                            <div class="d-flex m-b-10">
                                <p class="mb-0 font-regular text-muted font-weight-bold ml-5">Clientes</p>
                                
                            </div>
                           <div class="d-block d-sm-flex h-100 align-items-center">
                                <div class="apexchart-wrapper">
                                    <i class="fas fa-user-tie fa-4x blue-text ml-5"></i>
                                </div>
                                <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                    <h3 class="mb-0 mr-3"><i class="icon-arrow-up-circle"></i> {{ App\Models\Cliente::count() }}</h3>
                                    <p class=" mr-3">Clientes registrados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-6">
                        <div class="p-20 border-xxl-right border-bottom border-xxl-bottom-0">
                            <div class="d-flex m-b-10">
                                <p class="mb-0 font-regular text-muted font-weight-bold ml-5">Proveedores</p>
                                
                            </div>
                            <div class="d-block d-sm-flex h-100 align-items-center">
                                <div class="apexchart-wrapper">
                                    <i class="fas fa-truck fa-4x green-text ml-5"></i>
                                </div>
                                <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                    <h3 class="mb-0 mr-3"><i class="icon-arrow-up-circle"></i> {{ App\Models\Proveedor::count() }}</h3>
                                    <p class=" mr-3">Proveedores registradas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-6">
                        <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                            <div class="d-flex m-b-10">
                                <p class="mb-0 font-regular text-muted font-weight-bold ml-5">Productos</p>
                                
                            </div>
                            <div class="d-block d-sm-flex h-100 align-items-center">
                                <div class="apexchart-wrapper">
                                    <i class="fas fa-store fa-4x blue-text ml-5"></i>
                                </div>
                                <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                    <h3 class="mb-0"><i class="icon-arrow-up-circle"></i>{{ App\Models\Producto::count() }}</h3>
                                    <p>Productos registrados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-6">
                        <div class="p-20 border-lg-right border-bottom border-lg-bottom-0">
                            <div class="d-flex m-b-10">
                                <p class="mb-0 font-regular text-muted font-weight-bold ml-5">Ventas</p>
                                
                            </div>
                            <div class="d-block d-sm-flex h-100 align-items-center">
                                <div class="apexchart-wrapper">
                                    <i class="fas fa-dollar-sign fa-4x yellow-text ml-5"></i>
                                </div>
                                <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                    <h3 class="mb-0  mr-3"><i class="icon-arrow-up-circle"></i>{{  App\Models\Comprobante::count() }}</h3>
                                    <p class="  mr-3"> Ventas realizadas en el sistema</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endif
 
    </div>
</div>
@endsection

@push('scripts')
@if (\Auth::user()->hasRole('Gerente'))
  <script>
      var c3demo59 = jQuery("#c3demo59");
        if (c3demo59.length > 0) {
            var chart = c3.generate({
                bindto: '#c3demo59',
                data: {
                    columns: [
                        ["Gastos", {{ $gastos }}],
                        ["Ganancias",{{ $ganancias }}],
                       
                    ],
                    colors: {
                        Gastos: '#E95454',
                        Ganancias: '#4776E6',
                    },
                    type: 'pie'
                }
            });
        }

    var GananciasGastos = jQuery("#GananciasGastos");
    if (GananciasGastos.length > 0) {
        var chart = c3.generate({
            bindto: '#GananciasGastos',
            data: {
                columns: [
                    ['Ganancias', {{ $ganancias }}],
                    ['Gastos', {{ $gastos }}]
                ],
                colors: {
                    Ganancias: '#4776E6',
                    Gastos: '#E95454'
                },
                types: {
                    Ganancias: 'bar',
                    Gastos: 'bar'
                }
            }
        });
    }

    var ventas = jQuery('#detalleventas')
                if (ventas.length > 0) {
                  var options = {
                    chart: {
                        height: 300,
                        type: 'bar',
                        shadow: {
                            enabled: true,
                            color: '#bbb',
                            top: 3,
                            left: 2,
                            blur: 3,
                            opacity: 1
                        },
                    },
                    stroke: {
                        width: 7,   
                        curve: 'smooth'
                    },
                    series: [{
                        name: 'Cantidad de ventas',
                        data: [{{ $venta_count_1 }}, {{ $venta_count_2 }},{{ $venta_count_3 }},{{ $venta_count_4 }}]
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: [
                    '{{Carbon\Carbon::now()->subMonths(0)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subMonths(1)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subMonths(2)->toFormattedDateString()}}',
                    '{{Carbon\Carbon::now()->subMonths(3)->toFormattedDateString()}}'],
                    },
                    title: {
                        text: 'Ventas realizadas ',
                        align: 'left',
                        style: {
                            fontSize: "0px",
                            color: '#666'
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            gradientToColors: [ '#8E54E9'],
                            shadeIntensity: 1,
                            type: 'horizontal',
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100, 100, 100]
                        },
                    },
                    markers: {
                        size: 10,
                        opacity: 0.9,
                        colors: ["#2bcbba"],
                        strokeColor: "#fff",
                        strokeWidth: 2,
                         
                        hover: {
                            size: 10,
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 900,
                        title: {
                            text: 'Cantidad de ventas realizadas',
                        },                
                    }
                }
        
               var chart = new ApexCharts(
                    document.querySelector("#detalleventas"),
                    options
                );
                
                chart.render();
                }
        // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

        </script>
@elseif(\Auth::user()->hasRole('Super Administrador'))

{{-- Create the chart with javascript using canvas --}}
    <script>
       'use strict';
$(function () {
    chart2();
});


function chart2() {

    var options = {
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#9aa0ac"]
            }
        },
        series: [{
            name: 'Usuarios',
            data: [

                        '{{$emp_count_4}}',
                        '{{$emp_count_3}}',
                        '{{$emp_count_2}}',
                        '{{$emp_count_1}}'
            ]
        }],
        xaxis: {
            categories: ["{{Carbon\Carbon::now()->subMonths(3)->toFormattedDateString()}}",
                        "{{Carbon\Carbon::now()->subMonths(2)->toFormattedDateString()}}",
                        "{{Carbon\Carbon::now()->subMonths(1)->toFormattedDateString()}}",
                        "{{Carbon\Carbon::now()->subMonths(0)->toFormattedDateString()}}"],
            position: 'top',
            labels: {
                offsetY: -18,
                style: {
                    colors: '#9aa0ac',
                }
            },
            axisBorder: {
                show: true
            },
            axisTicks: {
                show: true
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
                offsetY: -35,

            }
        },
        fill: {
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [50, 0, 100, 100]
            },
        },
        yaxis: {
            axisBorder: {
                show: true
            },
            axisTicks: {
                show: true,
            },
            labels: {
                show: true,
                formatter: function (val) {
                    return val;
                }
            }

        },
        title: {
            text: 'Conteo total de usuarios.',
            floating: true,
            offsetY: 320,
            align: 'center',
            style: {
                color: '#9aa0ac'
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#chart2"),
        options
    );

    chart.render();

}


    </script>



@endif
@endpush


