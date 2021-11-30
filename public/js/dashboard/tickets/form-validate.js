$(function () {
    $('.form-validate').validate({
        rules: {
            title: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            category: {
                required: true,
            },
            customer: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Por favor, informe o título!",
                minlength: "O título deve conter no mínimo 3 caracteres!",
                maxlength: "O título deve conter no máximo 255 caracteres!"
            },
            category: {
                required: "Por favor, informe uma categoria!",
            },
            customer: {
                required: "Por favor, informe um cliente!",
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
