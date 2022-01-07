$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a variable
    //-----------------------------------------------------

    var token = $("input[name='_token']").val(),
        datatable_url = window.location.origin + "/datatable/traductionBR.json",
        route_datatable =  $("#route_datatable").val();

    //-----------------------------------------------------
    // Instance of plugins
    //-----------------------------------------------------

    //Inicializa o select2
    $(".select2").select2();

    // Mascara CEP
    $(".mask-zipcode").mask("00000-000", { reverse: true });

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
        columns: [
            {
                data: "name",
            },
            {
                data: "zip_code",
            },
            {
                data: "address",
            },
            {
                data: "number",
            },
            {
                data: "city",
                name: "city.name",
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

    //-----------------------------------------------------
    // Defining a function
    //-----------------------------------------------------

    /*
    /* Pesquisa por CEP
     */
    function searchZipCode() {
        var zipcode = $("#cep").val().replace("-", "");

        var url = "https://viacep.com.br/ws/" + zipcode + "/json/";

        if (zipcode.length != 8) {
            return false;
        }

        $.ajax({
            url: url,
            crossDomain: true,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#logradouro").val(data.logradouro);

                $("#bairro").val(data.bairro);
            },
        });
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate("#cep", "input", searchZipCode);
});
