function initMap() {
    var kalutaraBusStand = {lat: 6.5832, lng: 79.9608}; // Coordinates for Kalutara Bus Stand

    var map = new google.maps.Map(document.getElementById('map'), {
        center: kalutaraBusStand,
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: kalutaraBusStand,
        map: map,
        title: 'Kalutara Bus Stand'
    });
}