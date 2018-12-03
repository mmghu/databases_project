function loadProfile(username) {
    loadFavorites(username);
    loadPreferences(username);
    loadReviews(username); 
}


function editProfile() {
    //buttons
    $('#edit').hide();
    $('#save').show();

    //edit the favorites
    $("#favorites_input").css("visibility", "visible");
    $("#restriction_input").css("visibility", "visible");
    

    //show delete icon for all row elements 
    $(".trash").css("visibility", "visible");     
    $(".trash").css("cursor", "pointer");     
}

function freezeProfile() {
    //buttons
    $('#save').hide();
    $('#edit').show();

    //edit the favorites
    $("#favorites_input").css("visibility", "hidden");
    $("#restriction_input").css("visibility", "hidden");
    

    //show delete icon for all row elements 
    $(".trash").css("visibility", "hidden");     
    $(".trash").css("cursor", "default");     
}

/*********** FAVORITES ******************/
function deleteFavorite(username, itemname, rid) {
    $.post("../php/delete_favorite.php", {username:username, itemname:itemname, rid:rid}, function(data){
        location.reload(); 
        editProfile(username);  
    });    
}

function loadFavorites(username) {
    $("#favoritesList").append(
           '<tr>' + 
           '<th class="userList"> Item </td>' + 
           '<th class="userList"> Restaurant </td>' + 
          '</tr>' 
    );

    $.post("../php/get_favorites.php", {username:username}, function(data){
        data.forEach(function(res, i) { 
            $("#favoritesList").append(
                    '<tr class="row">' + 
                    '<td class="userList">' + res['itemName'] + '</td>' + 
                    '<td class="userList">' + res['rname'] + '</td>' +
                    '<td class="userList""> <img class="trash" src="../css/images/trash.png" onclick="deleteFavorite(\''+
                         username + '\',\'' + 
                         res['itemName'] + '\',' + 
                         res['rid'] + 
                        ')"> </td>' +
                    '</tr>' 
             );
        });
    });
    
    $.post("../php/get_restaurants.php", {}, function(data){
        data.forEach(function(res, i) {
            var o = new Option(res['name'], res['rid']); 
            $(o).html(res['name']);
            $("#restaurant_dropdown").append(o);
            document.getElementById('restaurant_dropdown').value = res['rid'];
        });
    });

    updateItemDropdown();
 
}

function updateItemDropdown() {
    var menu = document.getElementById('restaurant_dropdown');
    var rid = menu.value;
    //clear initiallize
    $("#item_dropdown").empty();
    $.post("../php/get_menuitems.php", {rid:rid}, function(data){
        data.forEach(function(res, i) {
            var o = new Option(res['name'], res['name']); 
            $(o).html(res['name']);
            $("#item_dropdown").append(o);
        });
    });
}

/*************** PREFERENCES *****************/
function deletePreference(username, ingredientName, foodGroup) {
    $.post("../php/delete_preference.php", {username:username, ingredientName, foodGroup}, function(data){
        location.reload(); 
    });    
}

function loadPreferences(username) {
    $("#preferenceList").append(
           '<tr>' + 
           '<th class="userList"> Ingredient </td>' + 
           '<th class="userList"> Group </td>' + 
          '</tr>' 
    );

    $.post("../php/get_preferences.php", {username:username}, function(data){
        data.forEach(function(res, i) { 
            $("#preferenceList").append(
                    '<tr class="row">' + 
                    '<td class="userList">' + res['ingredientName'] + '</td> ' + 
                    '<td class="userList">' + res['foodGroup']  + '</td>' +
                    '<td class="userList"> <img class="trash" src="../css/images/trash.png" onclick="deletePreference(\''+
                         username + '\',\'' + 
                         res['ingredientName'] + '\',' + 
                         res['foodGroup'] + 
                        ')"> </td>' +
                    '</tr>' 
             );
        });
    });
    
    $.post("../php/get_foodgroups.php", {}, function(data){
        data.forEach(function(res, i) {
            var o = new Option(res['foodGroup'], res['foodGroup']); 
            $("#group_dropdown").append(o);
            document.getElementById('group_dropdown').value = res['foodGroup'];
        });
    });

    updateIngredientDropdown();
}

function updateIngredientDropdown() {
    //get food group
    var menu = document.getElementById('group_dropdown');
    var foodGroup = menu.value;

    //clear initiallize
    $("#ingredient_dropdown").empty();
    $.post("../php/get_ingredient_by_foodgroup.php", {foodGroup:foodGroup}, function(data){
        data.forEach(function(res, i) {
            var o = new Option(res['name'], res['name']); 
            $("#ingredient_dropdown").append(o);
        });
    });
}


/************** REVIEWS *********************/
function loadReviews(username) {
    $("#reviews").append(
           '<tr>' + 
           '<th class="reviewList"> Restaurant </td>' + 
           '<th class="reviewList"> Rating </td>' + 
           '<th class="reviewList"> Review </td>' + 
           '<th class="reviewList"> Date </td>' + 
          '</tr>' 
    );

    $.post("../php/get_user_reviews.php", {username:username}, function(data){
        data.forEach(function(res, i) {
           var review = res['review'].substring(0, 20) + "...";
            $("#reviews").append(
                    '<tr class="row">' + 
                    '<td class="reviewList">' + res['rname'] + '</td>' + 
                    '<td class="reviewList">' + res['rating'] + '</td>' +
                    '<td class="reviewList">' + review + '</td>' +
                    '<td class="reviewList">' + res['timestamp'] + '</td>' +
                    '</tr>' 
             );
        });
    });
}
