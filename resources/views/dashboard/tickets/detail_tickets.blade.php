@extends('layout.template')

@section('title', 'Detalhes do Ticket')

@section('css')
    <style>
        .modal-dialog {
            overflow-y: initial !important
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

    </style>
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

                    <div class="row mt-3">
                        <div class="col text-right d-flex justify-content-end">
                            @if(!$ticket->finished and $ticket->users_id == auth()->user()->id)
                                <button class="btn btn-primary mr-2">
                                    Finalizar Ticket
                                </button>
                            @elseif(!$ticket->finished)
                                <form action="{{route('dashboard.tickets.assume')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$ticket->id}}">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        Assumir Ticket
                                    </button>
                                </form>
                            @endif
                            @if(!$ticket->finished AND $ticket->users_id == auth()->user()->id)
                                <button type="button" data-toggle="modal" data-target="#transfer-ticket"
                                        class="btn btn-success">
                                    Transferir Ticket
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <strong>
                            Observações
                        </strong>
                    </h4>

                    <div class="card-tools">
                        @if(!$ticket->finished)
                            <button class="btn btn-dark" data-toggle="modal" data-target="#create-observation">
                                Cadastrar
                            </button>
                        @endif
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#view-observations">
                            Visualizar
                        </button>
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
                        @if (count($ticket->attachments()))
                            @foreach ($ticket->attachments() as $attachment)

                                @if (strstr($attachment->path, '.pdf'))
                                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6 mb-3">
                                        <div class="card p-2">
                                            <img class="card-img-top" src="{{ asset('img/pdf.png') }}"
                                                 style="object-position: center; object-fit: cover; height: 140px"
                                                 alt="Imagem de capa do card">
                                            <div class="card-body p-1 pt-4">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <a href="{{ asset("storage/$attachment->path") }}"
                                                           class="btn btn-sm btn-info w-100" target="_blank"><i
                                                                class="fab fa-readme"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form id="deleteAttachment" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <a class="btn btn-sm btn-danger w-100 delete-confirm"
                                                               data-id="{{ $attachment->id }}">
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
                                            <img class="card-img-top" src="{{ asset("storage/$attachment->path") }}"
                                                 style="object-position: center; object-fit: cover; height: 140px"
                                                 alt="Imagem de capa do card">
                                            <div class="card-body p-1 pt-4">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <a href="{{ asset("storage/$attachment->path") }}"
                                                           class="btn btn-sm btn-info w-100" target="_blank">
                                                            <i class="fas fa-eye"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form id="deleteAttachment" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <a class="btn btn-sm btn-danger w-100 delete-confirm"
                                                               data-id="{{ $attachment->id }}">
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
                            <div class="col-12 d-flex justify-content-between">
                                <i class="fas fa-info-circle">
                                    <strong> Nenhum anexo cadastrado.</strong>
                                </i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <form method="POST" action="{{route('dashboard.attachment.new', $ticket->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col d-flex justify-content-end">

                                <div class="input-group mr-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="attachments"
                                               name="attachments[]" multiple required>
                                        <label class="custom-file-label" for="attachments">Escolher arquivo</label>
                                    </div>
                                </div>
                                <button class="btn btn-success">Anexar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="create-observation" tabindex="-1" aria-labelledby="create-observation"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.tickets.observation') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-observation">Nova Observação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="public">Tipo de observação</label>
                            <select class="custom-select" id="public" name="public">
                                <option value="0">Interna</option>
                                <option value="1">Pública</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observation">Observação</label>
                            <textarea class="form-control" id="observation" name="observation" rows="3"></textarea>
                        </div>

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
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

    <!-- Modal Observations-->
    <div class="modal fade" id="view-observations" tabindex="-1" aria-labelledby="view-observations" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header text-white bg-dark">
                    <h5 class="modal-title" id="view-observations">Observações Cadastradas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"
                     @if(count($ticket->observations()))style="background-image: url('{{asset('img/background-observations.png')}}')"@endif>

                    <div class="container">
                        <div class="row mt-3">
                            @if (count($ticket->observations()))
                                @foreach ($ticket->observations() as $observation)
                                    @if ($observation->by_customer)
                                        <div class="col-12 d-flex justify-content-end">
                                            <div class="card" style="width: 85%">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <p style="font-size: 12px">{{ $observation->ticket()->customer()->name }}</p>
                                                    </div>
                                                    <p>{{ $observation->text }}</p>
                                                    <div class="d-flex justify-content-end">
                                                        <small>
                                                            {{ $observation->created_at->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 d-flex">
                                            <div class="card" style="width: 85%">
                                                <div class="card-body">
                                                    @if(!$observation->public)
                                                        <div class="ribbon-wrapper">
                                                            <div class="ribbon bg-danger">
                                                                Interno
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex justify-content-between">
                                                        <p style="font-size: 13px">{{ $observation->user()->name }}</p>
                                                    </div>
                                                    <p>{{ $observation->text }}</p>
                                                    <div class="d-flex justify-content-end">
                                                        <small>
                                                            {{ $observation->created_at->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-12 d-flex justify-content-between">
                                    <i class="fas fa-info-circle">
                                        <strong> Nenhuma observação cadastrada.</strong>
                                    </i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
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
    <script>
        $('.delete-confirm').on('click', function () {
            // recupera o data-id
            let id = $(this).data('id');

            // recupera o formulário
            let form = $('#deleteAttachment');

            // Adiciona a action do formulário
            form.attr('action', '{{ route('dashboard.attachment.delete', 'id') }}'.replace('id', id));

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
    <script>
        function setModalMaxHeight(element) {
            this.$element = $(element);
            this.$content = this.$element.find('.modal-content');
            var borderWidth = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
                .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
        }

        $('.modal').on('show.bs.modal', function () {
            $(this).show();
            setModalMaxHeight(this);
        });

        $(window).resize(function () {
            if ($('.modal.in').length != 0) {
                setModalMaxHeight($('.modal.in'));
            }
        });
    </script>
@stop
