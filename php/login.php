<?php
$username = $_POST["uname"];
$password = $_POST["pword"];

// connect to mysql
$Pass = ''; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    // check username
    $user_query = "SELECT name, password FROM customer WHERE username = '$username'";
    if(!$result = mysqli_query($conn,$user_query)) {
	echo "Query failed: ". $mysqli->error. "\n";
    }

    else if(mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_row($result);
	if($row[1] === $password) {
	    echo "Welcome, ". $row[0]. "!\n";
	}
	else {
	    echo "Incorrect password, please try again.\n";
	}
    }
    else {
	echo "No user found! Please register or check your login credentials.\n";
    }
}
mysqli_close($conn);
?>
