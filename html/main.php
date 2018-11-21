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

<body onload="loadMain()">
    <!-- nav bar --> 
    <div class="top-bar">  
    </div>

    <!-- header -->
    <h1 style="position:fixed; width:100%; top:10%"><center>Welcome, <?php echo $_SESSION['name']; ?> </center></h1>   

    <!-- map -->
    <div id="map" style="position:fixed; width:50%; height:60%; left:42.5%; top:25%; background-color:black;">	
    </div>
    

    <!-- display -->
    <table id="list" style="position:fixed; width:30%; top:25%; background-color:purple; height:60%; left:7.5%;"> 
    </table>

    <!-- js --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- google maps --> 
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRvaTL4If1SfVTXDalSe9aJwU7TQzP8D8">
    </script>

</body>

</html>
