@extends('layout.template')

@section('title', 'Clientes')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop

@section('breadcrumb')
    <li class="breadcrumb-item active">Clientes</li>
@stop

@section('content')
    <div class="row mb-2 ">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#cadastroUsuario">Cadastrar</button>
        </div>
    </div>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="usuarios" class="table table-sm table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>E-mail</th>
                    <th>Criado em</th>
                    <th>Editado em</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>


                @foreach($customers as $customer)
                    <tr>
                        <td>
                            {{$customer->name}}
                        </td>
                        <td>{{$customer->document}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->created_at}}</td>
                        <td>{{$customer->updated_at}}</td>
                        <td></td>
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
    <!-- Modal Cadastro Clientes-->
    <div class="modal fade" id="cadastroUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCadastroUsuario"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadsatro de Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="formCadastroUsuario" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <label for="name">Nome Completo</label>
                                    <input type="text" class="form-control" id="aome" name="name">
                                </div>
                            </div>

                            <div class="form-row d-flex align-items-center">
                                <div class="col">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col">
                                    <label for="cpf" class="form-label">CPF / CNPJ</label>
                                    <input type="text" class="form-control" id="document" name="document">
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

    {{-- Jquery Validate --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>

    {{-- Locais --}}
    <script src="{{asset('js/dashboard/usuarios/datatable.js')}}"></script>
    <script src="{{asset('js/dashboard/usuarios/validacaoCadastro.js')}}"></script>
@stop
