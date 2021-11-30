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
