<?php
session_start();

$username = $_SESSION["username"];
$rid = $_SESSION["rid"];
$restaurant = $_SESSION["restaurant"];
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

// in progress
else {
        $t = date("Y-m-d H:i:s");
        $insert_query = "INSERT INTO reviews(username, rid, review, rating, timestamp) VALUES ('$username', '$rid', '$review', $rating, '$t')";    	
        if(mysqli_query($conn, $insert_query)) {
            header("Location: ../../pages/restaurant.php?restaurant="."$restaurant");
        }
        else {
            echo $insert_query;
        }
}
mysqli_close($conn);
?>
