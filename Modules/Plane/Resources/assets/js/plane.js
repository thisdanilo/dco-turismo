$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/traductionBR.json";

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    // DataTable Ajax
    $("#ajax-datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#route_datatable").val(),
            type: "POST",
            beforeSend: function (request) {
                return request.setRequestHeader("X-CSRF-Token", token);
            },
        },
        columns: [{
                data: "total_passengers"
            },
            {
                data: "class"
            },
            {
                data: "bland",
                name: "bland.name"
            },
            {
                data: "action",
                orderable: false,
                searchable: false
            },
        ],
        language: {
            url: datatable_url,
        },
    });
});
