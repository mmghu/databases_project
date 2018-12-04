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
    <script src="../js/main.js"></script>
    <!-- google maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRvaTL4If1SfVTXDalSe9aJwU7TQzP8D8">
    </script>

</head>

<body onload="loadMain()">
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
            <div class='nav-name mini' id='profile-button' onclick="window.location.href='./profile.php'"> Plan</div>
        </div>

        <div class="mini-wrapper" style='margin-left: 30%;'>
            <div class='nav-name mini' id='restaurants-button'>Restaurants</div>
        </div>

        <div class="mini-wrapper">
            <div class='nav-name mini' id='profile-button' onclick="window.location.href='./profile.php'"> My Profile</div>
        </div>
    </div>

    <!-- header -->
    <h1 style="position:fixed; width:100%; top:10%"><center>Welcome, <?php echo $_SESSION['name']; ?> </center></h1>

    <!-- map -->
    <div id="map" style="position:fixed; width:50%; height:60%; left:42.5%; top:25%; background-color:black;">
    </div>


    <!-- display -->
    <div style="position:fixed; width:30%; top:25%; background-color:white; height:60%; left:7.5%; valign:top; border:2px solid black;">
    <table id="list" style="width:100%; height:100%;">
    </table>
    </div>


</body>

</html>
