$('.logout').on('click', function () {
    // Mensagem de confirmação
    Swal.fire({
        title: "Deseja sair do sistema?",
        showCancelButton: true,
        confirmButtonColor: '#3BA3B9',
        cancelButtonColor: '#737373',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Logout!'
    }).then((result) => {
        // Confirma a exclusão
        if (result.isConfirmed) {
            //Recupera o formulário
            let form = $('#logout');
            //Envia o formulário
            form.submit();
        }
    })
});
