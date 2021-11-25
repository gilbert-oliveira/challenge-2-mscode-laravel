$(function () {
  $('#formCadastroUsuario').validate({
    rules: {
      name: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true,
      },
      cpf: {
        required: true,
        minlength: 11
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
      cpf: {
        required: "Por favor, informe o CPF!",
        minlength: "O CPF deve conter no mínimo 11 caracteres!"
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
