$('.assumed-ticket').on('click', function () {
    // recupera o data-id
    let id = $(this).data('id');

    // insere Id(id);
    $('input[id=input-assumed-ticket]').val(id);

    // Mensagem de confirmação
    Swal.fire({
        title: 'Deseja assumir o ticket?',
        text: "Após assumido o ticket ficará sobre sua responsabilidade!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#4CA847',
        cancelButtonColor: '#424242',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, Assumir!'
    }).then((result) => {
        // Confirma a exclusão
        if (result.isConfirmed) {
            //Recupera o formulário
            let form = $('#assumed-tickets');
            //Envia o formulário
            form.submit();
        }
    })
});
