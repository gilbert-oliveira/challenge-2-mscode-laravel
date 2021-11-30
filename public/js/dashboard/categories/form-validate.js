$(function () {
    $('.form-validate').validate({
        rules: {
            'name': {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            'name': {
                required: "Por favor, informe o nome!",
                minlength: "O nome deve conter no mínimo 3 caracteres!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

$(function () {
    $('.form-validate-edit').validate({
        rules: {
            'name': {
                required: true,
                minlength: 3,
                maxlength: 255
            }
        },
        messages: {
            'name': {
                required: "Por favor, informe o nome!",
                minlength: "O nome deve conter no mínimo 3 caracteres!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

