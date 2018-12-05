var map;
var markers = []; 
var center; 
var centerMarker;  
var names = [];

var timeArray; 
var locationArray; 
var restrictionArray;
var timeMessage;
var locationMessage;
var restrictionMessage; 

function load() {
    //initialize
    center = new google.maps.LatLng(38.033457, -84.502789); 
    map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 15 });     
    centerMarker =  new google.maps.Marker({
          position: center,
          map: map,
          icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
        }); 

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
            names.push(res['name']);
            markers.push(marker); 
            marker.setMap(map); 
        });
        
    });
    
    //add listener for location box
    $('input[name=location_box]').change(locationListener);
}

function onSubmit() {
    //clear table
    $("#results").empty();

    //get list of all restaurants
    $.post("../php/get_restaurants.php", function(data){
        var restaurants = [];
         data.forEach(function(res, i) { 
             restaurants.push(res['name']);
         });
        
         //check what fields the user specified
         var useLocation = $('input[name=location_box]'); 
         var useRestriction = $('input[name=user_restrictions]');
         var time = $('#time');

         timeArray = restaurants; 
         locationArray = restaurants; 
         restrictionArray = restaurants;
         timeMessage = "any time"; 
         locationMessage = "any distance"; 
         restrictionMessage = "no"; 

         //entered time
         if(time.val()) { 
             var timeString = time.val();
             timeMessage = timeString;  
             var timeSplit = timeString.split(':');
             var hour = parseInt(timeSplit[0]);
             
             timeArray = [];
             $.post("../php/restaurant_by_hour.php", {hour:hour},  function(data){ //begin time post
                 data.forEach(function(res, i) { 
                     timeArray.push(res['name']);
                 });
                 
                 //use restriciton
                 if(useRestriction.is(':checked')) {
                    restriction(); 
                 } // restriction IF
                 else { //no restriciton
                    //use location
                    if(useLocation.is(':checked')) {
                         locationSearch();
                    }
                     
                    window.setTimeout(display(), 50);        
                 }//end no restriction?  
             });//end time post
         } //end time
         else { //NO TIME
             //use restriciton
             if(useRestriction.is(':checked')) {
                restriction(); 
             }
             else{ //NO RESTRICTION
                 if(useLocation.is(':checked')) {
                      locationSearch();
                 }
                  
                 window.setTimeout(display(), 50);        
             }
         }

    });
}


function restriction() {
    var useLocation = $('input[name=location_box]'); 

    restrictionMessage = "your";
    //get the user restrictions 
     $.post("../php/get_preferences.php", function(data){
         restrictions = [];
         data.forEach(function(res, i) {
             restrictions.push(res['ingredientName']);
         });
         
         if(restrictions.length > 0) {
            restrictionArray = [];
            $.post("../php/restaurant_by_restriction.php", {restrictions:restrictions}, function(data){
                var myarr = (data.split(',')).slice(0,-1);
                myarr.forEach(function(res, i) { 
                    restrictionArray.push(res);
                });
             
                //use location
                if(useLocation.is(':checked')) {
                     locationSearch();
                }
                 
                window.setTimeout(display(), 100);        
            }); //restarautn restriction
         } //restrictions length
     }); //restrictions get
} //function

function locationSearch() {
    locationArray = [];
    
    var range = parseFloat($("input[name='range']:checked").val()); 
    myPos = centerMarker.getPosition();
    markers.forEach(function(marker, i) {
        var markerPos = marker.getPosition(); 
        if(getDistance(myPos, markerPos) < range) {
            locationArray.push(names[i]);
        }
    });

    locationMessage = range.toString() + " miles";
}

function display() {
      //see what restaurants meet all requirements
      var intersect = []; 
      names.forEach(function(name) {
          if(locationArray.includes(name) && timeArray.includes(name) && restrictionArray.includes(name)) {
              intersect.push(name);
          }
      });
      
      //DISPLAY OUR BABIES ON THE SCREEN  
      searchText = "Restaurants that are open at " + timeMessage + " within " + locationMessage 
      + " of your location that have options friendly to " + restrictionMessage + " restrictions.";
      $("#criterea").text(searchText);  
      $("#criterea").css("visibility","visible");  
       
      intersect.forEach(function(name) { 
          //add a spot on the table
          $("#results").append(
                  '<tr class = "row">' + 
                  '<td class="resList"><p class="resText">' + name + '</p></td>' + 
                  '<td class="userList"> <form  method="post" action="../pages/restaurant.php?restaurant=' + name +
                     '"><input type = "submit"class="littleLink" value="View"/></form> </td>' + 
                  '</tr>' 
           );
      });
}


function locationListener() {
    if($(this).is(':checked')) {
        google.maps.event.addListener(map, 'dragend', function() { onDrag(); });
        //let user choose range
        $(".ranges").css("visibility", "visible"); 
    } 
    else {
        $(".ranges").css("visibility", "hidden"); 
        google.maps.event.clearListeners(map, 'dragend');
    }
} 

function onDrag() {
    //user location
    center = map.getCenter(); 
    centerMarker.setPosition(center);
} 


function rad(x) {
  return x * Math.PI / 180;
}

function getDistance(p1, p2) {
  var R = 6378137; // Earth’s mean radius in meter
  var dLat = rad(p2.lat() - p1.lat());
  var dLong = rad(p2.lng() - p1.lng());
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return(d * 0.000621371); // returns the distance in meter
}
