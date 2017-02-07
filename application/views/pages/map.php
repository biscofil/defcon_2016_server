<div id="map">My map will go here</div>

<script tyle="text/javascript">

    function initialize() {

        // Creates and inserts Google Map

        var mapOptions = {
            zoom: 4,
            center: new google.maps.LatLng(38, -97),
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            scrollwheel: false
        };

        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

        // Constructs a heat map overlay

        var heatMap = new HeatMap({
            key: 'AIzaSyBWhyqDD60cf0kZDs6l3rGevkPp55smXCQ',
            data: 'https://www.heatmaptool.com/data/mcdonalds.csv',
            gradient: 'fire',
            scale_dimming: 0.9,
            radius: 10
        });

        // Adds heat map to Google Map

        heatMap.addTo(map);

    }

</script>