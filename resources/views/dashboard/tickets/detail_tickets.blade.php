@extends('layout.template')

@section('title', 'Detalhes do ticket')

@section('css')
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tickets</a></li>
    <li class="breadcrumb-item active">Detalhes</li>
@stop

@section('content')
    <div class="row">

        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-header">
                    <h4 class="card-title">Informações</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label>Título</label>
                            <li class="list-group-item">{{ $ticket->title }}</li>
                        </div>

                        <div class="col">
                            <label>Categoria</label>
                            <li class="list-group-item">{{ $ticket->category()->name }}</li>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Cliente</label>
                            <li class="list-group-item">{{ $ticket->customer()->name }}</li>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Descrição</label>
                            <li class="list-group-item">
                                {!! $ticket->description !!}
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Observações</h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-secondary" data-toggle="modal"
                                    data-target="#create-observation">Cadastrar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                @if(count($ticket->observations()))
                                    <div class="row mt-3">
                                        @foreach($ticket->observations() as $observation)
                                            <div class="col-4 mb-4">
                                                <div class="card h-100">
                                                    <div class="card-header">
                                                        {{$observation->user()->name }}
                                                    </div>
                                                    <div class="card-body">
                                                        {{$observation->text}} pois já está supoer atrasado!
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @else
                                            <div class="col-12 d-flex justify-content-between">
                                                <i class="fas fa-info-circle"><strong> Nenhuma observação
                                                        cadastrada.</strong></i>
                                            </div>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Anexos</h4>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    @if(count($ticket->attachments()))
                                        @foreach($ticket->attachments() as $attachment)

                                            @if(strstr($attachment->path, '.pdf'))
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6 mb-3">
                                                    <div class="card p-2">
                                                        <img class="card-img-top" src="{{asset('img/pdf.png')}}"
                                                             style="object-position: center; object-fit: cover; height: 140px"
                                                             alt="Imagem de capa do card">
                                                        <div class="card-body p-1 pt-4">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <a href="{{asset("storage/$attachment->path")}}"
                                                                       class="btn btn-sm btn-info w-100"
                                                                       target="_blank"><i
                                                                            class="fab fa-readme"></i></a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <form id="deleteAttachment" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="_method"
                                                                               value="DELETE">
                                                                        <a class="btn btn-sm btn-danger w-100 delete-confirm"
                                                                           data-id="{{$attachment->id}}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6 mb-3">
                                                    <div class="card p-2">
                                                        <img class="card-img-top"
                                                             src="{{asset("storage/$attachment->path")}}"
                                                             style="object-position: center; object-fit: cover; height: 140px"
                                                             alt="Imagem de capa do card">
                                                        <div class="card-body p-1 pt-4">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <a href="{{asset("storage/$attachment->path")}}"
                                                                       class="btn btn-sm btn-info w-100"
                                                                       target="_blank">
                                                                        <i class="fas fa-eye"></i></a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <form id="deleteAttachment" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="_method"
                                                                               value="DELETE">
                                                                        <a class="btn btn-sm btn-danger w-100 delete-confirm"
                                                                           data-id="{{$attachment->id}}">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <i class="fas fa-info-circle"></i> <strong>Nenhum arquivo
                                                anexado.</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('modals')
        <!-- Modal -->
            <div class="modal fade" id="create-observation" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('dashboard.tickets.observation') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="type-visibility">Tipo de observação</label>
                                    <select class="custom-select" id="type-visibility" name="type-visibility">
                                        <option value="internal">Interna</option>
                                        <option value="public">Pública</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="observation">Observação</label>
                                    <textarea class="form-control" id="observation" name="observation"
                                              rows="3"></textarea>
                                </div>

                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @stop

        @section('scripts')
            <script>
                $('.delete-confirm').on('click', function () {
                    // recupera o data-id
                    let id = $(this).data('id');

                    // recupera o formulário
                    let form = $('#deleteAttachment');

                    // Adiciona a action do formulário
                    form.attr('action', '{{route('dashboard.attachment.delete', 'id')}}'.replace('id', id));


                    // Mensagem de confirmação
                    Swal.fire({
                        title: 'Deseja excluir o anexo?',
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
@stop
