$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a function
    //-----------------------------------------------------

    /*
    /* Desabilita data
     */
    function disableDate(e) {
        e.preventDefault();
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate('[type="date"]', "keydown", disableDate);
});
