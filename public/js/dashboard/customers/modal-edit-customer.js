$('.edit-customer').on('click', function () {
    let id = $(this).data('edit-id');
    let name = $(this).data('edit-name');
    let email = $(this).data('edit-email');
    let document = $(this).data('edit-document');

    $('.edit-customer-id').val(id);
    $('.edit-customer-name').val(name);
    $('.edit-customer-email').val(email);
    $('.edit-customer-document').val(document);

    $('#editar-cliente').modal('show');
});
