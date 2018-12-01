function loadProfile(username) {
    loadFavorites(username);
    loadPreferences(username);
    loadReviews(username); 
}

function loadFavorites(username) {
    $.post("php/get_favorites.php", {username:username}, function(data){
        data.forEach(function(res, i) { 
            $("#favoritesList").append(
                    '<tr class="row">' + 
                    '<td>' + res['itemName'] + '</td>' + 
                    '<td>' + res['rname'] + '</td>' +
                    '</tr>' 
             );
        });
    });
}

function loadPreferences(username) {
    $.post("php/get_preferences.php", {username:username}, function(data){
        data.forEach(function(res, i) { 
            $("#preferenceList").append(
                    '<tr class="row">' + 
                    '<td>' + res['ingredientName'] + ', ' + res['foodGroup']  + '</td>' +
                    '</tr>' 
             );
        });
    });
}

function loadReviews(username) {
    $.post("php/get_user_reviews.php", {username:username}, function(data){
        data.forEach(function(res, i) {
           var review = res['review'].substring(0, 20) + "...";
            $("#reviews").append(
                    '<tr class="row">' + 
                    '<td>' + res['rname'] + '</td>' + 
                    '<td>' + res['rating'] + '</td>' +
                    '<td>' + review + '</td>' +
                    '<td>' + res['timestamp'] + '</td>' +
                    '</tr>' 
             );
        });
    });
}
