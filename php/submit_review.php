<?php
session_start();

$username = $_SESSION["username"];
$rid = $_SESSION["rid"];
$restaurant = $_SESSION["restaurant"];
$original_rating = $_SESSION["rating"];
$rating = trim($_POST["rating"]);
$review = trim($_POST["review"]);

$Pass = 'yourpassword';
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
    echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else if(empty($rating) || $rating > 5 || $rating < 0) {
    echo "Please enter a valid rating.\n";
}

else {
	// insert review
        $t = date("Y-m-d H:i:s");
        $insert_query = "INSERT INTO reviews(username, rid, review, rating, timestamp) VALUES ('$username', '$rid', '$review', $rating, '$t')";    	
        if(mysqli_query($conn, $insert_query)) {
	    // review successfully submitted, update restaurant entry and navigate page
	    $number_of_reviews = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS NumberOfReviews FROM reviews WHERE rid='$rid'"))['NumberOfReviews'];

	    $sum_of_reviews = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(rating) AS TotalRating FROM reviews WHERE rid='$rid'"))['TotalRating'];

	    $new_rating = sprintf('%0.1f', $sum_of_reviews / $number_of_reviews);
	
	    $update_query = mysqli_query($conn, "UPDATE restaurant SET rating='$new_rating' WHERE rid='$rid'");

	    if($update_query) {
		header("Location: ../../pages/restaurant.php?restaurant=".$restaurant);
	    }
	    else {
		echo $update_query;
	    }
        }
        else {
            echo $insert_query;
        }
}
mysqli_close($conn);
?>
