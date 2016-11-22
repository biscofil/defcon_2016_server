if (window.jQuery) {
    $(document).ready(function () {
        var site = "http://defcon2016.altervista.org/index.php/";
        var el = $("#defcon2016_badge");
        var key = el.data("key");
        /*console.log("Chiave : " + key);*/
        el.html('<a href="' + site + 'strutture/s/' + key + '"><img src="' + site + 'badge/img/' + key + '"></a>');
    });
} else {
    alert("JQuery required!");
}