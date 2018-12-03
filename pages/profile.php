<?php
//start the session
session_start();
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body onload="loadProfile('<?php echo $_SESSION['username'] ?>')">
    <div class="top-bar">
        <div class='nav-name' id='home-button' onclick="window.location.href='./main.php'">
            <img id="icon" src="../css/images/icon.png" alt="lexHealth"/>
        </div>
        <div id="search-div">
            <input type="text" name="search" style="width:90%;">
        </div>
        <button type="submit" id="browse"> Browse</button>

        <div class="mini-wrapper" style='margin-left: 30%;'>
            <div class='nav-name mini' id='restaurants-button'>Restaurants</div>
        </div>
        <div class="mini-wrapper">
            <div class='nav-name mini' id='profile-button' onclick="window.location.href='./profile.php'"> My Profile</div>
        </div>

    </div>

    <!-- user name -->
    <h1 style="position:fixed; width:100%; top:10%"><center><?php echo $_SESSION['name']; ?> </center></h1>

    <!-- favorites -->
    <div style="position:fixed; width:37.5%; top:20%; height:40%; left:10%; border-style:solid;">
        <h2 class="divLabel"> Favorites </h2>
         <table id="favoritesList"> </table>
    </div>

    <!-- restrictions -->
    <div style="position:fixed; width:37.5%; top:20%; height:40%; right:10%; border-style:solid;">
        <h2 class="divLabel"> Preferences </h2>
        <p > Does not eat... </p>
        <table id="preferenceList"> </table>
    </div>

    <!-- past reviews -->
    <div style="position:fixed; width:80%; bottom:5%; height:30%; left:10%; border-style:solid;">
        <h2 class="divLabel"> Reviews </h2>
        <table id="reviews"> </table>
    </div>

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./js/profile.js"></script>
</body>

</html>
