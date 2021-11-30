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
                        <td class="table-cpf-cnpj">{{$customer->document}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->created_at}}</td>
                        <td>{{$customer->updated_at}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary w-100 edit-customer"
                               data-edit-id="{{$customer->id}}"
                               data-edit-name="{{$customer->name}}"
                               data-edit-document="{{$customer->document}}"
                               data-edit-email="{{$customer->email}}">
                                <i class="far fa-edit"></i>
                            </a>
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
    <!-- Modal Cadastro Clientes-->
    <div class="modal fade" id="cadastroUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCadastroUsuario"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadasatro de Clientes</h5>
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
                                    <label for="name">Nome Completo</label>
                                    <input type="text" class="form-control" id="nome" name="name"
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
                                    <label for="document" class="form-label">CPF / CNPJ</label>
                                    <input type="text" class="form-control input-document" id="document"
                                           name="document">
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

    <!-- Modal Editar Clientes-->
    <div class="modal fade" id="editar-cliente" tabindex="-1" role="dialog" aria-labelledby="editar-cliente"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-editar-cliente">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form class="form-validate-edit" id="form-edit-customer" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <label for="name">Nome Completo</label>
                                    <input type="text" class="form-control edit-customer-name" id="nome" name="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="form-row d-flex align-items-center">
                                <div class="col">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control edit-customer-email" id="email" name="email"
                                           value="{{old('email')}}">
                                </div>
                                <div class="col">
                                    <label for="document" class="form-label">CPF / CNPJ</label>
                                    <input type="text" class="form-control edit-customer-document" id="document"
                                           name="document">
                                </div>
                                <input type="hidden" name="id" id="id" class="edit-customer-id">
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
    <script src="{{asset('js/dashboard/customers/form-validate.js')}}"></script>

    <script>
        $('.edit-customer').on('click', function () {
            let id = $(this).data('edit-id');
            let name = $(this).data('edit-name');
            let email = $(this).data('edit-email');
            let document = $(this).data('edit-document');

            $('.edit-customer-id').val(id);
            $('.edit-customer-name').val(name);
            $('.edit-customer-email').val(email);
            $('.edit-customer-document').val(document);

            $('#editar-cliente').modal('show');
        });
    </script>

    <script>
        var masks = ['000.000.000-000', '00.000.000/0000-00'];

        let tableDocument = $('.table-cpf-cnpj')
        tableDocument.mask((document.length = 11) ? masks[1] : masks[0]);

        $("input[id*='document']").inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true
        });
    </script>
@stop
