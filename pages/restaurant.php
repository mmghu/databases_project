<?php
session_start();
$restaurant = $_GET['restaurant'];

// connect to mysql
$Pass = 'yourpassword'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
        /* Restaurant information block
	Query for restaurant info to display */
        $restaurant_query = mysqli_query($conn, "SELECT * FROM restaurant WHERE name = '$restaurant'");
        $restaurant_info = mysqli_fetch_row($restaurant_query);

        $open_hour = $restaurant_info[5];
        if($open_hour > 12) {
                $open_hour = $open_hour%12 .' PM';
        }
        else if($open_hour == 24) {
                $open_hour = '12 AM';
        }
        else if($open_Hour == 12) {
                $open_hour = '12 PM';
        }
        else {
                $open_hour = $open_hour .' AM';
        }

     $close_hour = $restaurant_info[6];
     if($close_hour > 12) {
          $close_hour = $close_hour%12 .' PM';
     }
     else if($close_hour == 24) {
          $close_hour = '12 AM';
     }
     else if($close_hour == 12) {
          $close_hour = '12 PM';
     }
     else {
          $close_hour = $close_hour .' AM';
     }

     $rid = $restaurant_info[0];
     $_SESSION["rid"] = $rid;
     $_SESSION["restaurant"] = $restaurant;
     $latitude = $restaurant_info[2];
     $longitude = $restaurant_info[3];
     $price = $restaurant_info[4];
     $rating = $restaurant_info[8];
     $specialty = $restaurant_info[9];

	// reviews query
	$review_query = mysqli_query($conn, "SELECT * FROM reviews WHERE rid = '$restaurant_info[0]' ORDER BY timestamp DESC");
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

</head>

<body>
	<!-- nav bar -->
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

     <!-- restaurant info -->
     <div style="position:fixed; top:5%; width:100%;">
	<h1><?php echo $restaurant ?></h1>
	<h3><?php echo 'Open Hours: '. $open_hour. '-'. $close_hour?></h3>
	<h3><?php echo 'latitude: '. $latitude?></h3>
	<h3><?php echo 'longitude: '. $longitude?></h3>
	</div>

 
	<!-- review section -->
	<div style="position:fixed; top:30%; width:50%;left:0%;">
	     <h2>Submit a Review</h2>
	     <form action="../php/submit_review.php/?rid=<?php echo $rid?>" method="post">
        <?php echo 'How was '. $restaurant. '? '?> 
                <label for="bad">1</label>
                <input name="rating" type="range" min="1" max="5" step="1"></textarea></ br>
                <label for="">5</label>
		<textarea name="review" rows="6" cols="80"></textarea>
		<button id="submit_review" type="submit" style="position:relative;right:7%">Submit</button>
	     </form>
     </div>

    <!--past reviews-->
	<div style="position:fixed; top:5%; right:0%; width:50%;">
	     <h2>Reviews</h2>
	     <dl style="position:relative; left:2%">
        <?php
        $length = 10;
        $i = 0;
        while($review = $review_query->fetch_assoc()){
            if($i < $length) {
                echo '<dt>'. $review['timestamp'] . " " . $review['username'];
                echo '<dd>'. $review['rating'] . '/5: ' . $review['review']. '</dd>';
            }
            $i = $i + 1;
		    }
		?>
	     </dl>
     </div>



</body>

</html>
