@extends('layout.template')

@section('title', 'Categorias')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
@stop


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#"> Ticktes</a></li>
    <li class="breadcrumb-item active">Categorias</li>
@stop

@section('content')
    <div class="row mb-2 ">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createCategory">Cadastrar</button>
        </div>
    </div>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="usuarios" class="table table-sm table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Criado em</th>
                    <th>Editado em</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{($category->created_at)->format('d/m/Y H:i:s')}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col d-flex justify-content-center">

                                    <form id="deleteCategory" method="POST" class="mx-1">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a class="btn btn-sm btn-danger delete-confirm"
                                           data-id="{{$category->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </form>

                                    <a class="btn btn-sm btn-primary mx-1 edit-confirm"
                                       data-edit-id="{{$category->id}}" data-edit-name="{{$category->name}}">
                                        <i class="far fa-edit"></i>
                                    </a>
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
    <!-- Modal Cadastro Categorias-->
    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="modalCreateCategory"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadsatro de Categorias de Tickets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form class="form-validate" id="formCreateCategory" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            @if(isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="col">
                                    <label for="name">Nome da categoria</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}">
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

    <!-- Modal Editar Categorias-->
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalCreateCategory"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form class="form-validate-edit" id="formEditCategory" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="card-body">
                            @if(isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="col">
                                    <label for="name">Nome da categoria</label>
                                    <input type="text" class="form-control input-edit" id="name" name="name"
                                           value="{{old('name')}}">
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
    <script src="{{asset('js/dashboard/categories/form-validate.js')}}"></script>

    @if(isset($errors) && count($errors) > 0)

        <script>
            $(document).ready(function () {
                $('#createCategory').modal('show');
            });
        </script>
    @endif

    <script>
        $('.delete-confirm').on('click', function () {
            // recupera o data-id
            let id = $(this).data('id');

            // recupera o formulário
            let form = $('#deleteCategory');

            // Adiciona a action do formulário
            form.attr('action', '{{route('dashboard.tickets.categories.delete', 'id')}}'.replace('id', id));

            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja excluir a categoria?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#cb0000',
                cancelButtonColor: '#2B77C0',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    // Envia o formulário
                    form.submit();
                }
            })
        });
    </script>

    <script>
        $('.edit-confirm').on('click', function () {
                // recupera o data-id
                let id = $(this).data('edit-id');

                // recupera o formulário
                let form = $('#formEditCategory');

                // Adiciona a action do formulário
                form.attr('action', '{{route('dashboard.tickets.categories.edit', 'id')}}'.replace('id', id));

                $('#name-error').remove()

                let input = $('.input-edit');
                input.removeClass('is-invalid');

                input.val($(this).data('edit-name'));
                $('#editCategory').modal('show');
            }
        )

        $('.submit-edit').on('click', function () {
            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja editar a categoria?',
                text: "Você não poderá revertera alterção e isso afetará os tickets já cadastrados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ccb93',
                cancelButtonColor: '#2B77C0',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, editar!'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    let form = $('.editCategory');
                    form.submit();
                }
            })
        });
    </script>
@stop
