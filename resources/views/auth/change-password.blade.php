@extends('layout.template')

@section('title', 'Alterar Senha')

@section('breadcrumb')
    <li class="breadcrumb-item active">Alterar Senha</li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="change-password" action="{{ route('dashboard.change-password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Senha Atual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                   placeholder="Senha Atual">
                        </div>
                        <div class="form-group">
                            <label for="new_password">Nova Senha</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                   placeholder="Nova Senha" value="{{old('new_password')}}">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                   name="new_password_confirmation" placeholder="Confirmar Nova Senha"
                                   value="{{old('new_password_confirmation')}}">
                        </div>
                        <div class="row text-right">
                            <div class="col">
                                <a class="btn btn-primary change-password">Alterar Senha</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.change-password').on('click', function () {
            console.log(this);
            // recupera o data-id
            let id = $(this).data('id');

            // insere Id(id);
            $('input[id=input-disble-user]').val(id);

            // Mensagem de confirmação
            Swal.fire({
                title: 'Deseja Alterar sua senha?',
                text: "Após a alteração da sua senha a sessão sera deslogada!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#45C3EE',
                cancelButtonColor: '#2d2d2d',
                confirmButtonText: 'Sim, alterar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // Confirma a exclusão
                if (result.isConfirmed) {
                    //Recupera o formulário
                    let form = $('#change-password');
                    //Envia o formulário
                    form.submit();
                }
            })
        });
    </script>
@stop
