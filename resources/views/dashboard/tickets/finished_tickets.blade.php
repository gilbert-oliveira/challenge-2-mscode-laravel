@extends('layout.template')

@section('title', 'Tickets Finalizados')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active">Finalizados</li>
@stop

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="usuarios" class="table table-sm table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Nº</th>
                    <th>Titúlo</th>
                    <th>Categoria</th>
                    <th>Criado em</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($finishedTickets as $ticket)

                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->category()->name}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <a class="btn btn-info btn-sm mx-1"
                                       href="{{route('dashboard.tickets.details', $ticket->id)}}">
                                        <i class="fas fa-info-circle"></i> Detalhes
                                    </a>

                                    <form action="{{route('dashboard.tickets.reopen')}}" id="reopen-ticket"
                                          method="POST" class="mx-1">
                                        <input type="hidden" id="input-reopen-ticket" name="id"
                                               value="">
                                        @csrf
                                        <a class="btn btn-secondary btn-sm reopen-ticket"
                                           data-id="{{$ticket->id}}">
                                            <i class="fas fa-user-tag"></i> Reabrir
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach()
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section('scripts')
    {{-- jquery DataTables --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    {{-- Locais --}}
    <script src="{{asset('js/dashboard/users/datatable.js')}}"></script>
    <script src="{{asset('js/dashboard/tickets/confirm-reopen.js')}}"></script>
@stop
