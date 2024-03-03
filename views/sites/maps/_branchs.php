<?php

use app\models\Dashboard;


$branches = Dashboard::branchsParaConsultaGeral();


?>

<!-- Inclua a biblioteca do Google Maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgFi2B2HqoJQhkOa_bEI70JYVSnK9098A&callback=initMap"></script>

<div id="map" style="width: 100%; height: 400px;"></div>

<script>


    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: -14.235, lng: -51.9253}, // este é um ponto central arbitrário, ajuste conforme necessário
        });

        // Array com as coordenadas, assumindo que você já tenha obtido isso do PHP
        var locations = <?php echo json_encode($branches); ?>;

        for (var i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
                map: map,
                title: locations[i].name
            });
        }
    }
</script>
