<?php
session_start();

$username = $_POST["uname"];
$password = $_POST["pword"];

// connect to mysql
$Pass = 'yourpassword'; // insert your password
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
        $_SESSION["name"] = $row[0];
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        header("Location: ../pages/main.php");
	}
	else {
		echo '<script language="javascript">';
        	echo 'alert("Incorrect password.");';
		echo 'window.location.href="../index.html";';
        	echo '</script>';
	}
    }
    else {
	echo '<script language="javascript">';
        echo 'alert("No user found! Please register or check your login credentials.");';
        echo 'window.location.href="../index.html";';
        echo '</script>';
    }
}
mysqli_close($conn);
?>
