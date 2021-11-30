<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes - {{config('app.name')}}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .scroll-description {
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
</head>
<body
    style="background-image: url('{{asset('errors/img/bg.jpg')}}'); background-size: cover">
<div class="container p-3">
    <div class="row mb-2">
        <div class="col-12 mb-2 text-center">
            <img class="img-fluid m-3" src="{{asset('img/logo-login-2.png')}}" style="width: 200px">
        </div>
        <div class="col-12">
            <div class="card mb-3">
                <!-- /.card-header -->
                <h5 class="card-header bg-dark text-white text-center p-3">Detalhes do Ticket</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col">

                                    <label>Título</label>
                                    <li class="list-group-item">{{ $ticket->title }}</li>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">

                                    <label>Categoria</label>
                                    <li class="list-group-item">{{ $ticket->category()->name }}</li>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <label>Descrição</label>
                            <li class="list-group-item scroll-description">
                                {!! $ticket->description !!}
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-4 mb-3">
            <div class="card">

                <h5 class="card-header bg-dark text-white text-center">Observações</h5>
                <div class="card-body text-center">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#view-observations">
                        Visualizar
                    </button>

                    @if(!$ticket->finished)
                        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#create-observation">
                            Cadastrar
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Visualização-->
<div class="modal fade" id="view-observations" tabindex="-1" aria-labelledby="view-observations" aria-hidden="true"
@if(count($ticket->observations()))@endif>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="view-observations">Observações Cadastradas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"
                 @if(count($ticket->observations())) style="background-image: url('{{asset('img/background-observations.png')}}')" @endif>
                <div class="row mt-3">
                    @if (count($ticket->observations()))
                        @foreach ($ticket->observations()->where('public', true) as $observation)
                            @if ($observation->by_customer)
                                <div class="col-12 d-flex justify-content-end mb-3">
                                    <div class="card" style="width: 85%">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <p style="font-size: 12px">{{ $observation->ticket()->customer()->name }}</p>
                                            </div>
                                            <p>{{ $observation->text }}</p>
                                            <div class="d-flex justify-content-end">

                                                <small style="font-size: 12px">
                                                    {{ $observation->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 d-flex mb-3">
                                    <div class="card" style="width: 85%">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <p style="font-size: 12px">{{ $observation->user()->name }}</p>
                                            </div>
                                            <p>{{ $observation->text }}</p>
                                            <div class="d-flex justify-content-end">

                                                <small style="font-size: 12px">
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

<!-- Modal Cadastro-->
<div class="modal fade" id="create-observation" tabindex="-1" aria-labelledby="create-observation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('public.observation.new', $ticket->token) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registar Observação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating">
                    <textarea class="form-control h-100" id="observation"
                              name="observation" rows="10"></textarea>
                        <label for="observation">Observação:</label>
                    </div>

                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                </div>

                <input type="hidden" name="toket_ticket" value={{ $ticket->token }}>
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">

</script>
<!-- Sweet Alert CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{session()->get('success')}}'
        })
    </script>
@endif
@if(session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: '{{session()->get('error')}}'
        })
    </script>
@endif
</body>
</html>
