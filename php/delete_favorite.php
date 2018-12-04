<?php
// connect to mysql
$Pass = 'yourpassword'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

$username = trim($_POST["username"]);
$itemname = $_POST["itemname"];
$rid = $_POST["rid"];

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    // check username
    $query = "DELETE FROM favorites WHERE username = '$username' AND itemName = '$itemname' AND rid = $rid";
    if(!$result = mysqli_query($conn,$query)) {
	echo "Query failed: ". $mysqli->error. "\n";
    }
}
mysqli_close($conn);
?>
