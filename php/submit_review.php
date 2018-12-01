<?php
session_start();

$username = trim($_POST["username"]);
$rid = trim($_POST["rid"]);
$timestamp = trim($_POST["timestamp"]);
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
    $search_query = "SELECT name FROM customer WHERE username = '$username'";
    if(mysqli_num_rows(mysqli_query($conn, $search_query)) === 1) {
	echo "Username taken, please try another.\n";
    }
    else {
    	$insert_query = "INSERT INTO customer (username, name, password) VALUES ('$username', '$fullname', '$password')";
    	if(mysqli_query($conn, $insert_query)) {
            $_SESSION["name"] = $fullname;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("Location: ../main.php");
    	}
        else {
     	    echo "Registration failed, please try again.\n";
    	}
    }
}
mysqli_close($conn);
?>
