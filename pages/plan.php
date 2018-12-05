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
        
         <h1 style="margin-top:5px;"><i>EatWell</i></h1>
        <!--
         <div id="search-div">
             <input type="text" name="search" style="width:90%;">
         </div>
         <button type="submit" id="browse"> Browse</button>
        -->
            
     
        <div class="mini-wrapper" style="margin-left:60%;">
            <div class='nav-name mini' id='plan-button' onclick="window.location.href='./plan.php'"> Plan</div>
        </div>

         <div class="mini-wrapper" >
             <div class='nav-name mini' id='restaurants-button' onclick="window.location.href='./restaurants.php'"> Restaurants</div>
         </div>

	 <div class="mini-wrapper">
             <div class='nav-name mini' id='profile-button' onclick="window.location.href='./profile.php'"> My Profile</div>
         </div>
     </div>

    <div style="top:10%; left:2.5%;  position:fixed; margin:0; width:45%; text-align:center; height:80%; border-style:solid;">
       <h1 style="margin:0px;">Plan your meal</h1> 
        <!--time-->
       <h2 style="margin:0px;">When are you eating?</h2>
        <input type="time" id="time" min="0:00" max="24:00"> 
        
        <!--location-->
        <!--use user location-->
        <h2 style="margin:0px;">Use your location? </h2>
        <label class="switch" >
          <input type="checkbox" name="location_box">
          <span class="slider" ></span>
        </label>
        <br>
        <!--choose range of restaurants within location--> 
        <input class ="ranges" type="radio" name="range" checked="checked" value=1>
        <p style="display:inline-block;" class="ranges"> 1 Mile</p>
        <input class ="ranges" type="radio" name="range" value=5> 
        <p style="display:inline-block;" class="ranges">5 Mile</p>
        <input class ="ranges" type="radio" name="range" value=10> 
        <p style="display:inline-block;" class="ranges">5+ Mile</p>
        <br>
        <!-- map-->
        <div id="map" style="height:25%; width:60%; display:inline-block; margin-top:20px;  background-color:black; "> </div>
       
        <!-- include restrictions? -->  
        <h3>Include my restrictions?</h3>
        <label  class="switch">
          <input type="checkbox" name="user_restrictions">
          <span class="slider"></span>
        </label>
         
        <br>
        <button type="submit" id="submit" onclick="onSubmit()" style="width:80%; height:10%; display:inline-block; margin:10px;">Plan!</button>
    </div>

    <div id="display" style="border-style:solid; text-align:center; width:45%; position:fixed; top:10%; right:2.5%; height:80%; padding:0px;">
        <h2 id="criterea" style="height:30%; width:90%; display:inline-block; "> </h2>
        <table id="results" style="height:60%; width:90%; border-style:solid; display:inline-block;"> </table>
    </div>`
</body>

</html>
