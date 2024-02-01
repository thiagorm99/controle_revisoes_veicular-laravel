//var base_uri = "https://41ff-177-101-45-179.ngrok-free.app";
var base_uri = "http://127.0.0.1:8000";

$(document).ready(function () {
    let table = $("#tabela_proprietarios").DataTable({
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        "ajax": `${base_uri}/proprietarios_api`,
        "columns": [
            { "data": "id" },
            { "data": "nome" },
            { "data": "endereco" },
            { "data": "telefone" },
            { "data": "sexo" },
            { "data": "data_nascimento" },

            {
                "data": "acoes",
                render: function (data, type) {
                    return `
                        <button
                        onclick="modal_editar_proprietario(${data}, '${base_uri}/proprietarios/editar_frm/')"
                        type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal_editar_proprietario">
                        Editar
                        </button>

                        <button
                        onclick="veiculos(${data})"
                        type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal_veiculos">
                        Veículos
                        </button>

                        <button
                        onclick="revisoes(${data})"
                        type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal_revisoes">
                        Revisoes
                        </button>
    
                        <button
                        onclick="modal_deletar_proprietario(${data})"
                        type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#modal_deletar_proprietario">
                        Deletar
                        </button>
                    `
                }
            },
        ],
    });

    setInterval(function () {
        table.ajax.reload(null, false);
    }, 5000);
});

function modal_editar_proprietario(id, url) {
    $.get(`${url}${id}`, function (data) {
        $("#id_p").val(data.id);
        $("#nome_p").val(data.nome);
        $("#endereco_p").val(data.endereco);
        $("#telefone_p").val(data.telefone);
        $("#sexo_p").val(data.sexo);
        $("#data_nascimento_p").val(data.data_nascimento.split('-').reverse().join('-'));
    });
}

function modal_deletar_proprietario(id) {
    $("#id_pd").val(id);
}


//// salvar proprietarios ajax
let salvar_proprietario = $("#salvar_proprietario");
salvar_proprietario.submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/proprietarios/salvar`,
        data: salvar_proprietario.serialize(),
        success: function (data) {
            console.log(data);
            $('#salvar_proprietario input').val("");
            alert(data);
            $('#modal_cadastrar_proprietario').modal('hide');
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });

});

//// editar proprietarios ajax
let editar_proprietario = $("#editar_proprietario");
editar_proprietario.submit(function (e) {

    e.preventDefault();
    $.ajax({
        type: "post",
        url: `${base_uri}/proprietarios/editar`,
        data: editar_proprietario.serialize(),
        success: function (data) {
            console.log(data);
            $('#editar_proprietario input').val("");
            alert(data);
            $('#modal_editar_proprietario').modal('hide');
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});

//// deletar proprietarios ajax
let deletar_proprietario = $("#deletar_proprietario");
deletar_proprietario.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/proprietarios/deletar`,
        data: deletar_proprietario.serialize(),
        success: function (data) {
            console.log(data);
            $('#deletar_proprietario input').val("");
            alert(data);
            $('#modal_deletar_proprietario').modal('hide');
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});