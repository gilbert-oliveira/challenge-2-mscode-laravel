@extends('layout.template')

@section('title', 'Tickets Assumidos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active">Assumidos</li>
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

                @foreach($assumedTickets as $ticket)

                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->category()->name}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col d-flex justify-content-between">
                                    <a class="btn btn-info btn-sm assumed-ticket"
                                       href="{{route('dashboard.tickets.details', $ticket->id)}}">
                                        <i class="fas fa-info-circle"></i> Detalhes
                                    </a>

                                    <form method="POST" id="finish-ticket"
                                          action="{{route('dashboard.tickets.finish')}}">

                                        @csrf

                                        <input type="hidden" id="input-finish-ticket" name="id"
                                               value="">

                                        <a class="btn btn-secondary btn-sm finish-ticket"
                                           data-id="{{$ticket->id}}">
                                            <i class="fas fa-user-tag"></i> Finalizar
                                        </a>
                                    </form>

                                    <button type="button" data-toggle="modal" data-id="{{$ticket->id}}"
                                            data-target="#transfer-ticket"
                                            class="btn btn-success btn-sm transfer-ticket">
                                        <i class="fas fa-exchange-alt"></i> Transferir
                                    </button>
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

@section('modals')
    <!-- Modal transferir ticket -->
    <div class="modal fade" id="transfer-ticket" tabindex="-1" aria-labelledby="tranfer-ticket"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.tickets.transfer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="transfer-ticket">Transferir Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="public">Usuário</label>
                            <select class="custom-select" id="users_id" name="users_id">
                                @foreach(\App\Models\User::all() as $user)
                                    @if($user->id != auth()->user()->id)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="ticket_id" name="ticket_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Transferir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    <!-- modal finalizar ticket -->
    <script src="{{asset('js/dashboard/tickets/modal-finish-ticket.js')}}"></script>

    <!-- transferir ticket -->
    <script src="{{asset('js/dashboard/tickets/transfer-ticket.js')}}"></script>
@stop
