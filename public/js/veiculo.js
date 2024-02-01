//var base_uri = "https://41ff-177-101-45-179.ngrok-free.app";
var base_uri = "http://127.0.0.1:8000";

function veiculos(id) {
    $("#id_proprietario_db").val(id);
    $(document).ready(function () {
        let tabela_veiculos = $("#tabela_veiculos").DataTable({
            destroy: true,
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
            "ajax": `${base_uri}/veiculos_api/${id}`,
            "columns": [
                { "data": "id" },
                { "data": "marca" },
                { "data": "modelo" },
                { "data": "ano" },
                { "data": "placa" },
                { "data": "nome" },
                { "data": "data_ultima_revisao" },

                {
                    "data": "acoes",
                    render: function (data, type) {
                        return `
                            <button
                            onclick="modal_editar_veiculo(${data}, '${base_uri}/veiculos/editar_frm/')"
                            type="button" class="btn btn-primary btn-sm" data-toggle="modal">
                            Editar
                            </button>
        
                            <button
                            onclick="modal_cadastrar_revisao(${data})"
                            type="button" class="btn btn-primary btn-sm" data-toggle="modal">
                            Cadastrar uma revisão
                            </button>
                                
                            <button
                            onclick="modal_deletar_veiculo(${data})"
                            type="button" class="btn btn-danger btn-sm" data-toggle="modal">
                            Deletar
                            </button>
                        `
                    }
                },
            ],
        });
    });
}

function modal_editar_veiculo(id, url) {
    $('#modal_editar_veiculo').show();
    $("#proprietario_v").val($("#id_proprietario_db").val());
    $.get(`${url}${id}`, function (data) {
        $("#id_v").val(data.id);
        $("#marca_v").val(data.marca);
        $("#modelo_v").val(data.modelo);
        $("#placa_v").val(data.placa);
        $("#ano_v").val(data.ano);
        $("#id_v").val(data.id);
        $("#proprietario_v").val(data.id_proprietario);
    });
}

function modal_cadastrar_revisao(id) {
    $("#veiculo_r").val(id);
    $('#modal_cadastrar_revisao').show();
}

function modal_deletar_veiculo(id) {
    $('#modal_deletar_veiculo').show();
    $("#id_vd").val(id);
}

//// salvar veiculos ajax
let salvar_veiculo = $("#salvar_veiculo");
salvar_veiculo.submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/veiculos/salvar`,
        data: salvar_veiculo.serialize(),
        success: function (data) {
            console.log(data);
            $('#salvar_veiculo input').val("");
            alert(data);
            $('#modal_cadastrar_veiculo').hide();
            $('#tabela_veiculos').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });

    

});
//// botao cadastrar
function botao_cadastrar_veiculo(id){
    $('#modal_cadastrar_veiculo').show();
    $("#proprietario").val($("#id_proprietario_db").val());
}

//// editar veiculos ajax
let editar_veiculo = $("#editar_veiculo");
editar_veiculo.submit(function (e) {

    e.preventDefault();
    $.ajax({
        type: "post",
        url: `${base_uri}/veiculos/editar`,
        data: editar_veiculo.serialize(),
        success: function (data) {
            console.log(data);
            $('#editar_veiculo input').val("");
            alert(data);
            $('#modal_editar_veiculo').hide();
            $('#tabela_veiculos').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});

//// deletar veiculos ajax
let deletar_veiculo = $("#deletar_veiculo");
deletar_veiculo.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/veiculos/deletar`,
        data: deletar_veiculo.serialize(),
        success: function (data) {
            console.log(data);
            $('#deletar_veiculo input').val("");
            alert(data);
            $('#modal_deletar_veiculo').hide();
            $('#tabela_veiculos').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});

//// salvar revisao ajax
let salvar_revisao = $("#salvar_revisao");
salvar_revisao.submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/revisoes/salvar`,
        data: salvar_revisao.serialize(),
        success: function (data) {
            console.log(data);
            $('#salvar_revisao input').val("");
            alert(data);
            $('#modal_cadastrar_revisao').hide();
            $('#tabela_veiculos').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });

});