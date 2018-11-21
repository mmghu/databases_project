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
    $("#login-items").fadeOut();
    $("#register-items").fadeOut();
    $("#register").animate({height:"50%"}, function() {
        $("#register").addClass("hide");
        $("#login").removeClass("hide");
        $("#login-items").fadeIn();
    });
})
