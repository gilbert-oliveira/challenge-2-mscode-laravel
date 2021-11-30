$('.reopen-ticket').on('click', function () {
    // recupera o data-id
    let id = $(this).data('id');

    // insere Id(id);
    $('input[id=input-reopen-ticket]').val(id);

    // Mensagem de confirmação
    Swal.fire({
        title: 'Deseja reabrir o ticket?',
        text: "Será criado outro ticket contendo as mesmas informações exeto as observações. Também será enviado um email informando  o cliente que o ticket foi reaberto!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#4CA847',
        cancelButtonColor: '#424242',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, Reabrir!'
    }).then((result) => {
        // Confirma a exclusão
        if (result.isConfirmed) {
            //Recupera o formulário
            let form = $('#reopen-ticket');
            console.log(form)
            //Envia o formulário
            form.submit();
        }
    })
});
