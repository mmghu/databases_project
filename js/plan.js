var map;
var markers = []; 

function load() {
    //initialize
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 38.033457, lng: -84.502789},
        zoom: 15 });     

    //mark all the restaurants on map
    $.post("../php/get_restaurants.php", function(data){
        data.forEach(function(res, i) { 
            //get each coordinate
            var lat = res['latitude'];
            var lon = res['longitude'];
            //plot each restaurant
            var marker = new google.maps.Marker({
                   position: new google.maps.LatLng(lat,lon),
                   label: { fontWeight: 'bold', fontSize: '12px', text: res['name'] }
            });
            markers.push(marker); 
            marker.setMap(map); 
        });
        
    });
}
