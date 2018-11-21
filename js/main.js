var map;
var markers = []; 

function loadMain() {
    //initialize
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 38.033457, lng: -84.502789},
        zoom: 15 });     

    //mark all the restaurants on map
    $.post("http://localhost:8000/php/get_restaurants.php", function(data){
        data.forEach(function(res, i) { 
            //get each coordinate
            var lat = res['latitude'];
            var lon = res['longitude'];
            //plot each restaurant
            var marker = new google.maps.Marker({
                   position: new google.maps.LatLng(lat,lon)
            });
            markers.push(marker); 
            marker.setMap(map); 
        });
        
        //get position and mark on map 
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success);
        } else {
            map = document.getElementById('map');
            map.innerHTML = "Geolocation is not supported by this browser.";
        }

        updateTable();
            
    });


}

function success(position) {
    //center at the user's coordinate
    var lat = position.coords.latitude; 
    var lon = position.coords.longitude; 
//    var center = new google.maps.LatLng(lat, lon); 
//    map.panTo(center);
}


function updateTable() {
    //clear table
    $("#list tr").remove();  
    $("#list > tbody:last-child").append(
           '<tr>' + 
           '<td> Name </td>' + 
           '<td> Rating </td>' + 
           '<td> Price Rating </td>' +
          '</tr>' 
    );

    //find markers in bounds of map
    for(var i=0; i<markers.length; i++) {
        var pos = markers[i].getPosition();
        if(map.getBounds().contains(pos)) {
            //get info restaurants with these coordinates
            $.post("http://localhost:8000/php/restaurant_by_ip.php", {lat:pos.lat().toFixed(6), lon:pos.lng().toFixed(6)}, function(data){
                data.forEach(function(res, i) { 
                    console.log(res["name"]);
                    console.log(res["rating"]);
                    console.log(res["priceRating"]);
                   //add a spot on the table
                   $("#list").append(
                           '<tr>' + 
                           '<td>' + res['name'] + '</td>' + 
                           '<td>' + res['rating'] + '</td>' + 
                           '<td>' + res['priceRating'] + '</td>' +
                           '</tr>' 
                    );
                });
            });
         }
    }
}

