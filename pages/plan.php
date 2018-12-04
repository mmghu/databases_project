<?php
session_start();

// connect to mysql
$Pass = 'yourpassword'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
}
mysqli_close($conn);
?>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="../css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/plan.js"></script>
    <!-- google maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRvaTL4If1SfVTXDalSe9aJwU7TQzP8D8">
    </script>

</head>

<body onload="load()">
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

    <div style="top:10%; left:2.5%;  position:fixed; margin:auto; width:45%; text-align:center; height:80%; border-style:solid;">
       <h1>Plan your meal</h1> 
        <!--time-->
       <h2>When are you eating?</h2>
        <input type="time" name="time" min="0:00" max="24:00" required> 
        
        <!--location-->
       <h2 style="display:inline; ">Use your location? </h2> 
       <input type="checkbox" style="display:inline;" name="location"> 
        <div id="map" style="height:25%; width:60%; display:inline-block; background-color:black; "> </div>
         
        <!--restriction-->
       <h2>Dietary restrictions </h2>
    </div>

    <div id="display" style="border-style:solid; width:45%; position:fixed; top:10%; right:2.5%; height:80%; ">

    </div>`
</body>

</html>
