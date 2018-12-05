<?php
function success() {
	echo '<script language="javascript">';
	echo 'alert("You have been registered!");';
	echo 'window.location.href="../pages/main.php";';
	echo '</script>';
}

session_start();

$username = trim($_POST["uname"]);
$fullname = trim($_POST["fullname"]);
$password = trim($_POST["pword"]);
$re_password = trim($_POST["pword2"]);

$Pass = 'yourpassword';
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
    error("Connection failed.");
}
else if(empty($username)) {
    error("Please enter a username.");
}
else if(empty($fullname)) {
    error("Please enter a full name.");
}
else if(empty($password)) {
    error("Please enter a password.");
}
else if($password != $re_password) {
	echo '<script language="javascript">';
	echo 'alert("Please check your password confirmation.");';
	echo 'window.location.href="../index.html";';
	echo '</script>';
}
else {
    $search_query = "SELECT name FROM customer WHERE username = '$username'";
    if(mysqli_num_rows(mysqli_query($conn, $search_query)) === 1) {
	echo '<script language="javascript">';
	echo 'alert("Username has been taken, please try again.");';
	echo 'window.location.href="../index.html";';
	echo '</script>';
    }
    else {
    	$insert_query = "INSERT INTO customer (username, name, password) VALUES ('$username', '$fullname', '$password')";
    	if(mysqli_query($conn, $insert_query)) {
            $_SESSION["name"] = $fullname;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
	    success();
    	}
        else {
    	}
    }
}
mysqli_close($conn);
?>
