$(document).ready(function () {
    $('.telefone').mask('(00) 00000-0000');
    $('.ano').mask('0000');
    $('.km').mask('0000000');
    $('.placa').mask('AAAAAAA');
    $('.data_nascimento').mask('00-00-0000');
    $('.custo').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#data').mask('00-00-0000');

    $('.selecao').select2({
        width: '100%',
    });
});

