if (window.jQuery) {
    $(document).ready(function () {
        var key = $("#badge").data("key");
        console.log("Chiave : " + key);
        $("#badge").html('<a href="http://defcon2016.altervista.org/index.php/strutture/s/' + key
                + '"><img src="http://defcon2016.altervista.org/index.php/badge/img/' + key + '"></a>');
    });
} else {
    alert("MISSING JQUERY");
}
