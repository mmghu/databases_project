<?php
$username = trim($_POST["uname"]);
$fullname = trim($_POST["fullname"]);
$password = trim($_POST["pword"]);
$re_password = trim($_POST["pword2"]);

$Pass = 'Perina3872!';
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
    echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else if(empty($username)) {
    echo "Please enter a username.\n";
}
else if(empty($fullname)) {
    echo "Please enter a full name.\n";
}
else if(empty($password)) {
    echo "Please enter a password.\n";
}
else if($password != $re_password) {
    echo "Please check your re-entered password.\n";
}
else {
    $search_query = "SELECT name FROM customer WHERE username = '$username'";
    if(mysqli_num_rows(mysqli_query($conn, $search_query)) === 1) {
	echo "Username taken, please try another.\n";
    }
    else {
    	$insert_query = "INSERT INTO customer (username, name, password) VALUES ('$username', '$fullname', '$password')";
    	if(mysqli_query($conn, $insert_query)) {
	    echo "Successfuly registered as ". $username. "!\n";
    	}
        else {
 	    echo "Registration failed, please try again.\n";
    	}
    }
}
mysqli_close($conn);
?>   
