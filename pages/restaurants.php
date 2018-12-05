<?php
//start the session
session_start();
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>LexHealth</title>
    <meta name="description" content="Lexington food according to your health needs.">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="../css/style.css">
    
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/restaurants2.js"></script>
</head>

<body onload="loadRestaurants()">
    <!-- nav bar -->
    <div class="top-bar">
        <div class='nav-name' id='home-button' onclick="window.location.href='./main.php'">
            <img id="icon" src="../css/images/icon.png" alt="lexHealth"/>
        </div>
        <div id="search-div">
            <input type="text" name="search" style="width:90%;">
        </div>
        <button type="submit" id="browse"> Browse</button>
        
        <div class="mini-wrapper">
            <div class='nav-name mini' id='plan-button' onclick="window.location.href='./plan.php'"> Plan</div>
        </div>

        <div class="mini-wrapper" style='margin-left: 30%;'>
            <div class='nav-name mini' id='restaurants-button'>Restaurants</div>
        </div>

        <div class="mini-wrapper">
            <div class='nav-name mini' id='profile-button' onclick="window.location.href='./profile.php'"> My Profile</div>
        </div>
    </div>

    <div class='restaurant-list'><ul id="restaurants" style="list-style-type:none"></ul></div>
</body>

</html>
