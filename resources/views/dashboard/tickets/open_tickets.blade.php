@extends('layout.template')

@section('title', 'Tickets Abertos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active">Abertos</li>
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

                @foreach($openTickets as $ticket)

                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->category()->name}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-info btn-sm w-100"
                                       href="{{route('dashboard.tickets.details', $ticket->id)}}">
                                        <i class="fas fa-info-circle"></i> Detalhes
                                    </a>
                                </div>
                                <div class="col">
                                    <form method="POST" id="assumed-tickets"
                                          action="{{route('dashboard.tickets.assume')}}">
                                        @csrf
                                        <input type="hidden" id="input-assumed-ticket" name="id"
                                               value="">

                                        <a class="btn btn-success btn-sm w-100 assumed-ticket"
                                           data-id="{{$ticket->id}}">
                                            <i class="fas fa-user-tag"></i> Assumir
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
    <script src="{{asset('js/dashboard/usuarios/datatable.js')}}"></script>

    <script>
        $('.assumed-ticket').on('click', function () {
            // recupera o data-id
            let id = $(this).data('id');

            // insere Id(id);
            $('input[id=input-assumed-ticket]').val(id);

            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja assumir o ticket?',
                text: "Após assumido o ticket ficará sobre sua responsabilidade!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4CA847',
                cancelButtonColor: '#424242',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, Assumir!'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    //Recupera o formulário
                    let form = $('#assumed-tickets');
                    //Envia o formulário
                    form.submit();
                }
            })
        });
    </script>
@stop
