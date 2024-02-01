//var base_uri = "https://41ff-177-101-45-179.ngrok-free.app";
var base_uri = "http://127.0.0.1:8000";

function revisoes(id) {
    $(document).ready(function () {

        let table = $("#tabela_revisoes").DataTable({
            destroy: true,
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
            "ajax": `${base_uri}/revisoes_api/${id}`,
            "columns": [
                { "data": "id" },
                { "data": "data" },
                { "data": "km" },
                { "data": "tipo_revisao" },
                { "data": "custo" },
                { "data": "marca" },
                { "data": "modelo" },
                { "data": "ano" },
                { "data": "placa" },
                { "data": "nome" },

                {
                    "data": "acoes",
                    render: function (data, type) {
                        return `
                            <button
                            onclick="modal_editar_revisao(${data}, '${base_uri}/revisoes/editar_frm/')"
                            type="button" class="btn btn-primary btn-sm" data-toggle="modal">
                            Editar
                            </button>
                                
                            <button
                            onclick="modal_deletar_revisao(${data})"
                            type="button" class="btn btn-danger btn-sm" data-toggle="modal">
                            Deletar
                            </button>
                        `
                    }
                },
            ],
        });

        $("#startdate").datepicker({
            "dateFormat": "dd/mm/yy",
            "onSelect": function (date) {
                minDateFilter = new Date(date).getTime();
                table.draw();
            }
        }).keyup(function () {
            minDateFilter = new Date(this.value).getTime();
            table.draw();
        });

        $("#enddate").datepicker({
            "dateFormat": "dd/mm/yy",
            "onSelect": function (date) {
                maxDateFilter = new Date(date).getTime();
                table.draw();
            }
        }).keyup(function () {
            maxDateFilter = new Date(this.value).getTime();
            table.draw();
        });

        minDateFilter = "";
        maxDateFilter = "";

        $.fn.dataTableExt.afnFiltering.push(
            function (oSettings, aData, iDataIndex) {
                if (typeof aData._date == 'undefined') {
                    aData._date = new Date(aData[1]).getTime();
                }

                if (minDateFilter && !isNaN(minDateFilter)) {
                    if (aData._date < minDateFilter) {
                        return false;
                    }
                }

                if (maxDateFilter && !isNaN(maxDateFilter)) {
                    if (aData._date > maxDateFilter) {
                        return false;
                    }
                }

                return true;
            }
        );

    });
}


function modal_editar_revisao(id, url) {
    $('#modal_editar_revisao').show();
    $.get(`${url}${id}`, function (data) {
        $("#id_r").val(data.id);
        $("#km_r").val(data.km);
        $("#data_rev").val(data.data.split('-').reverse().join('-'));
        $("#tipo_revisao_r").val(data.tipo_revisao);
        $("#custo_r").val(data.custo);
        $("#id_veiculo_r").val(data.id_veiculo).select2();
    });
}


function modal_deletar_revisao(id) {
    $("#id_rd").val(id);
    $('#modal_deletar_revisao').show();
}

//// editar revisoes ajax
let editar_revisao = $("#editar_revisao");
editar_revisao.submit(function (e) {

    e.preventDefault();
    $.ajax({
        type: "post",
        url: `${base_uri}/revisoes/editar`,
        data: editar_revisao.serialize(),
        success: function (data) {
            console.log(data);
            $('#editar_revisao input').val("");
            alert(data);
            $('#modal_editar_revisao').hide();
            $('#tabela_revisoes').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});


//// deletar revisoes ajax
let deletar_revisao = $("#deletar_revisao");
deletar_revisao.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: "post",
        url: `${base_uri}/revisoes/deletar`,
        data: deletar_revisao.serialize(),
        success: function (data) {
            console.log(data);
            $('#deletar_revisao input').val("");
            alert(data);
            $('#modal_deletar_revisao').hide();
            $('#tabela_revisoes').DataTable().ajax.reload();
        },
        error: function (data) {
            var responseObject = JSON.parse(data.responseText);
            alert(responseObject.message);
        },
    });
});