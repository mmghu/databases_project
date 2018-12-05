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
    
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/profile.js"></script>

</head>

<body onload="loadProfile('<?php echo $_SESSION['username'] ?>')">
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

    <!-- user name -->
    <h1 style="position:fixed; width:100%; top:10%"><center><?php echo $_SESSION['name']; ?> </center></h1>

    <!-- edit buttom -->
    <button id="edit" style="position:fixed; width:10%; right:5%; top:0%;" 
    onclick="editProfile()"><center>Edit profile </center></button>
    <button id="save" style="position:fixed; width:10%; right:5%; top:0%; display:none;" 
    onclick="freezeProfile()"><center>Quit Editing </center></button>
    <!-- favorites -->
    <div style="position:fixed; width:37.5%; top:20%; height:40%; left:10%; border-style:solid;">
        <h2 class="divLabel"> Favorites </h2>
	 <form style="visibility:hidden; height:10%; width:40%; position:relative; left:60%; margin:0; margin-left:5%;" 
            action="../php/add_favorite.php" method="post" id="favorites_input">
            <p style="width:12%; margin:0;">Restaurant</p>
	    <select name="rid" style="width:70%; margin:0;" id = "restaurant_dropdown" onchange="updateItemDropdown()">
	    </select>
            <p style=" width:70%;margin:0;" >Item</p>
	    <select style="width:70%;margin:0;"  name="itemname" id = "item_dropdown">
	    </select>
            <button type="submit" style="padding:0; height:20px;  width:70%; margin:0px; margin-top:10px;">Add</button>
	 </form> 
         <table id="favoritesList" style="height:70%; position:relative;left:0%; width:60%;"> </table>
    </div>

    <!-- restrictions -->
    <div style="position:fixed; width:37.5%; top:20%; height:40%; right:10%; border-style:solid;">
        <!--- header-->
        <h2 class="divLabel" style="display:inline-block; margin:auto; "> Preferences </h2>
        <p style='display:inline-block; margin:auto;'> Does not eat... </p>
	
        <!-- form --> 
        <form id="restriction_input" style="visibility:hidden; height:10%; width:40%; position:relative; left:60%; margin:0; margin-left:5%;"
        action="../php/add_restriction.php" method="post" id="restrictions_input">
            <p style="width:70%; margin:0;">Food Group</p>
	    <select name="gname" style="width:70%; margin:0;" id = "group_dropdown" onchange="updateIngredientDropdown()">
	    </select>
            <p style=" width:70%;margin:0;" >Ingredient</p>
	    <select style="width:70%;margin:0;"  name="iname" id = "ingredient_dropdown">
	    </select>
            <button type="submit" style="padding:0; height:20px;  width:70%; margin:0px; margin-top:10px;">Add</button>
	</form> 

        <!---list items-->
        <table id="preferenceList" style="height:70%; position:relative; left:0%; width:60%;"> </table>
    </div>

    <!-- past reviews -->
    <div style="position:fixed; width:80%; bottom:5%; height:30%; left:10%; border-style:solid;">
        <!--- header-->
        <h2 class="divLabel" style="text-align:center;"> Reviews </h2>
        
        <!---list items-->
        <table id="reviews" style="width:100%;"> </table>
    </div>

</body>

</html>
