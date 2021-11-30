@extends('layout.template')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@stop

@section('title', 'Estatísticas')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row mt-3">
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$open_tickets ?? 0}}</h3>

                            <p>Total de Tickets Abertos</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$completed_tickets ?? 0}}</h3>

                            <p>Total de Tickets Finalizados</p>
                        </div>
                        <!-- <div class="icon">
                          <i class="fas fa-minus"></i>
                        </div> -->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$reopened_tickets ?? 0}}</h3>

                            <p>Total de Tickets Reabertos</p>
                        </div>
                        <!-- <div class="icon">
                          <i class="fas fa-plus-circle"></i>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Graphics-->
            <div class="row mb-3">
                <!-- Monthly Graph Open Tickets Per Day-->
                <div class="col-8">
                    <div class="card card-success h-100">
                        <div class="card-header">
                            <h6><strong>Tickets abertos por dia no mês</strong></h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="ticketsForDays"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- Percent Graph Completed And Open Tickets-->
                <div class="col-4">
                    <div class="card card-success h-100">
                        <div class="card-header">
                            <h6><strong>Tickets Finalizados</strong> X <strong>Tickets Abertos</strong></h6>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="percentageOfTickets"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- End Graphics-->
        </div>
    </div>
@stop

@section('scripts')
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <!-- Constants grafico -->
    <script>
        const labelsBar = @json(array_keys($tickets_for_days));
        const datasBar = @json(array_values($tickets_for_days));

        const percentOpen = {{$open_tickets}};
        const percentCompleted = {{$completed_tickets}};
        const datasDonuts = [Math.round(percentCompleted), Math.round(percentOpen)];
    </script>

    <!-- Grafico de barras -->
    <script src="{{asset('js/dashboard/home/chart_bar.js')}}"></script>
    <!-- Grafico de donuts -->
    <script src="{{asset('js/dashboard/home/chart_donuts.js')}}"></script>
@stop
