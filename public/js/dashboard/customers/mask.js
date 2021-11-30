var masks = ['000.000.000-000', '00.000.000/0000-00'];

let tableDocument = $('.table-cpf-cnpj')
tableDocument.mask((document.length = 11) ? masks[1] : masks[0]);

$("input[id*='document']").inputmask({
    mask: ['999.999.999-99', '99.999.999/9999-99'],
    keepStatic: true
});
