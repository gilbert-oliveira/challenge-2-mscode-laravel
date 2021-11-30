$('.finish-ticket').on('click', function () {
    // recupera o data-id
    let id = $(this).data('id');

    // insere Id(id);
    $('input[id=input-finish-ticket]').val(id);

    // Mensagem de confirmação
    Swal.fire({
        title: 'Deseja finalizar o ticket?',
        text: "Após finalizar o ticket o cliente será notificado e ficará sobre sua responsabilidade!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#4CA847',
        cancelButtonColor: '#424242',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, Finalizar!'
    }).then((result) => {
        // Confirma a exclusão
        if (result.isConfirmed) {
            //Recupera o formulário
            let form = $('#finish-ticket');
            //Envia o formulário
            form.submit();
        }
    })
});
