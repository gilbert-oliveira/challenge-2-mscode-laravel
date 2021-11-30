$(function () {
    $('.form-validate').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
            },
            document: {
                required: true,
                minlength: 11,
                maxlength: 14
            }
        },
        messages: {
            name: {
                required: "Por favor, informe o nome!",
                minlength: "O nome deve conter no mínimo 3 caracteres!"
            },
            email: {
                required: "Por favor, informe o email!",
                email: "Por favor, informe um email válido!"
            },
            document: {
                required: "Por favor, informe um CPF ou CNPJ!",
                minlength: "O documento deve conter no mínimo 11 caracteres para CPF e 14 para CNPJ!",
                maxlength: "O documento deve conter no mínimo 11 caracteres para CPF e 14 para CNPJ!",

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
            name: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
            },
            document: {
                required: true,
                minlength: 11,
                maxlength: 14
            }
        },
        messages: {
            name: {
                required: "Por favor, informe o nome!",
                minlength: "O nome deve conter no mínimo 3 caracteres!"
            },
            email: {
                required: "Por favor, informe o email!",
                email: "Por favor, informe um email válido!"
            },
            document: {
                required: "Por favor, informe um CPF ou CNPJ!",
                minlength: "O documento deve conter no mínimo 11 caracteres para CPF e 14 para CNPJ!",
                maxlength: "O documento deve conter no mínimo 11 caracteres para CPF e 14 para CNPJ!",

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

