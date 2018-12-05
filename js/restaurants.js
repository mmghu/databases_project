function loadRestaurants() {
    $.post("../php/get_restaurants_sort_rating.php", {}, function(data){
	data.forEach(function(res, i) {
	    var background_color = "rgba(0,0,0,0)";
	    if(i%2 == 0) {
		background_color = "rgba(130,181,72,.5)";
	    }
		
	    $("#restaurants").append(
		'<li style="background:' + background_color + '"><header>' +
		'<h3 style="margin:2px;"><a href="../pages/restaurant.php?restaurant=' + res['name'] + '">' + res['name'] + 
		'</a> ' + res['rating'] + '/5</h3>' +
		'<span style="color:#4CAF50; font-weight:bold">' + res['priceRating'] + '</span></header>' + 
		'<body style="padding:1%;"><span>' + res['specialty'] + '</span><br></br>' + res['description'] + '</body>' +
		'</li>');
	});
    });
}
