$(document).ready(function () {
    //-----------------------------------------------------
    // Defining a function
    //-----------------------------------------------------

    /*
    /* Desabilita data
     */
    function disableDate(e) {
        e.preventDefault();
        return false;
    }

    //-----------------------------------------------------
    // Defining a call function
    //-----------------------------------------------------

    $(document).delegate('[type="date"]', "keydown", disableDate);
});
