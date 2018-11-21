$('#login-button').click(function(event) {
    alert("Log in successful. Chase make this do something :P");
})

$('#register-button').click(function(event) {
    $("#login-items").fadeOut();
    $("#register-items").hide();
    $("#login").addClass("hide");
    $("#register").removeClass("hide");
    $("#register").animate({height:"70%"}, function() {
        $("#register-items").fadeIn();
    });
})

$('#cancel-button').click(function(event) {
    $("#login-items").fadeOut();
    $("#register-items").fadeOut();
    $("#register").animate({height:"50%"}, function() {
        $("#register").addClass("hide");
        $("#login").removeClass("hide");
        $("#login-items").fadeIn();
    });
})

$("#register-button2").click(function(event) {
    alert("You've been registered! Chase make this doing something :P");
    $("#login-items").fadeOut();
    $("#register-items").fadeOut();
    $("#register").animate({height:"50%"}, function() {
        $("#register").addClass("hide");
        $("#login").removeClass("hide");
        $("#login-items").fadeIn();
    });
})

$('#home-button').click(function(event) {
    alert("Home");
})

$('#browse').click(function(event) {
    alert("Search");
})

$('#restaurants-button').click(function(event) {
    alert("Restaurants");
})

$('#profile-button').click(function(event) {
    alert("Profile");
})
