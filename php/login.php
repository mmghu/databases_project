<?php

$username = $_POST["uname"];
$password = $_POST["pword"];

// connect to mysql
$Pass = 'Pepperjen(23';
$DB = 'lexHealth';
$mysqli = new mysqli('127.0.0.1', 'root', $Pass, $DB);

if(mysqli->connect_errno) {
    echo "Could not connect to database\n";
    exit;
}
else {
    // check username and password validity
    $user_query = "
    $user_result = mysqli_query
}
?>
