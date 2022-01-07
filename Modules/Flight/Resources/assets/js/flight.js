$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/traductionBR.json",
        route_datatable = $("#route_datatable").val();

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    // Mascara dinheiro
    $(".money").mask("0.000.000.000,00", {
        reverse: true,
        placeholder: "R$ 0,00",
    });

    // Inicializa o summernote
    $("#summernote").summernote();

    // Inicializa o summernote
    $("#summernote-disable").summernote("disable");

    // Inicializa DataTable
    $("#ajax-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: route_datatable,
            type: "POST",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        },
        columns: [{
                data: "date",
            },
            {
                data: "time_duration",
            },
            {
                data: "price",
            },
            {
                data: "plane",
                name: "plane.bland.name",
            },
            {
                data: "origin",
                name: "plane.origin.name",
            },
            {
                data: "destination",
                name: "plane.destination.name",
            },
            {
                data: "action",
                orderable: false,
                searchable: false,
            },
        ],
        language: {
            url: datatable_url,
        },
    });
});
