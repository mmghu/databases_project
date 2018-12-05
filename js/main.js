var map;
var markers = []; 

function loadMain() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 38.033457, lng: -84.502789},
        zoom: 15 });    
 
    //initialize
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }


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
        
        //get position and mark on map 
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success);
        } else {
            map = document.getElementById('map');
            map.innerHTML = "Geolocation is not supported by this browser.";
        }

	updateTable();
    });

    google.maps.event.addListener(map, 'dragend', function() { updateTable(); });
}

function success(position) {
    //center at the user's coordinate
    var lat = position.coords.latitude; 
    var lon = position.coords.longitude; 
    var center = new google.maps.LatLng(lat, lon); 
   map.panTo(center);
}


function updateTable() {
    //clear table
    $("#list").empty();  
    $("#list").append(
           '<tr>' + 
           '<th class="mainList"> Name </td>' + 
           '<th class="mainList"> Rating </td>' + 
           '<th class="mainList"> Price Rating </td>' +
          '</tr>' 
    );

    //find markers in bounds of map
    for(var i=0; i<markers.length; i++) {
        var pos = markers[i].getPosition();
        if(map.getBounds().contains(pos)) {
            //get info restaurants with these coordinates
            $.post("../php/restaurant_by_ip.php", {lat:pos.lat().toFixed(6), lon:pos.lng().toFixed(6)}, function(data){
                data.forEach(function(res, i) { 
                   //add a spot on the table
                   $("#list").append(
                           '<tr class = "row">' + 
                           '<td class="mainList"><a href="../pages/restaurant.php?restaurant=' + res['name'] +'">' + res['name'] + '</a></td>' + 
                           '<td class="mainList">' + res['rating'] + '</td>' + 
                           '<td class="mainList">' + res['priceRating'] + '</td>' +
                           '</tr>' 
                    );
                });
            });
         }
    }
}

