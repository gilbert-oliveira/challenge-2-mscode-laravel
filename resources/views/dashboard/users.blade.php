@extends('layout.template')

@section('title', 'Usuários')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item active">Usuarios</li>
@stop

@section('content')
    <div class="row mb-2 ">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-user">Cadastrar</button>
        </div>
    </div>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="usuarios" class="table table-sm table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    @if($user->id != auth()->user()->id)
                        <tr>
                            <td>
                                {{$user->name}}
                                @if($user->master)
                                    &nbsp;<span class="badge badge-info">Master</span>
                                @endif

                            </td>
                            <td class="table-cpf">{{$user->cpf}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="text-center">
                                <div class="col-6">
                                    @if($user->active)
                                        <form id="disble-user"
                                              action="{{route('dashboard.users.disable')}}"
                                              method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="" id="input-disble-user">
                                            <a class="btn btn-sm btn-danger disable-confirm"
                                               data-id="{{$user->id}}">
                                                <i class="fas fa-user-slash"></i>
                                            </a>
                                        </form>
                                    @else
                                        <form id="enable-user"
                                              action="{{route('dashboard.users.enable')}}"
                                              method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="" id="input-enable-user">
                                            <a class="btn btn-sm btn-success enable-confirm"
                                               data-id="{{$user->id}}">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach()

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section('modals')
    <!-- Modal Cadastro Usuário-->
    <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="create-user"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadsatro de Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form class="form-validate" id="formCadastroUsuario" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @if(isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="col">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="form-row d-flex align-items-center">
                                <div class="col">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{old('email')}}">
                                </div>
                                <div class="col">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control input-create-user" id="cpf" name="cpf" value="{{old('cpf')}}" maxlength="14">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
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
    <script src="{{asset('js/dashboard/usuarios/datatable.js')}}"></script>
    <script src="{{asset('js/dashboard/usuarios/form-validate.js')}}"></script>

    <script>
        $('.disable-confirm').on('click', function () {
            // recupera o data-id
            let id = $(this).data('id');

            // insere Id(id);
            $('input[id=input-disble-user]').val(id);

            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja desativar o usuário?',
                text: "Será enviado um e-mail para o usuário informando a desativação de acesso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#cb0000',
                cancelButtonColor: '#2B77C0',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, desativar!'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    //Recupera o formulário
                    let form = $('#disble-user');
                    //Envia o formulário
                    form.submit();
                }
            })
        });

        $('.enable-confirm').on('click', function () {
            // recupera o data-id
            let id = $(this).data('id');

            // insere Id(id);
            $('input[id=input-enable-user]').val(id);

            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja ativar o usuário?',
                text: "Será enviado um e-mail para o usuário informando a ativação de acesso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2B77C0',
                cancelButtonColor: '#cb0000',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, Ativar!'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    //Recupera o formulário
                    let form = $('#enable-user');
                    //Envia o formulário
                    form.submit();
                }
            })
        });
    </script>
    @if(isset($errors) && count($errors) > 0)
        <script>
            $(document).ready(function () {
                $('#create-user').modal('show');
            });
        </script>
    @endif

    <script>
        // mascara a coluna de cpf da tabela
        $('.input-create-user').mask('000.000.000-00');
        $('.table-cpf').mask('000.000.000-00');
    </script>
@stop
