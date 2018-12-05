<?php
// connect to mysql
$Pass = 'yourpassword'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

$username = trim($_POST["username"]);
$ingredientName = $_POST["ingredientName"];
$foodGroup = $_POST["foodGroup"];

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    // check username
    $query = "DELETE FROM restrictions WHERE username = '$username' AND ingredientName = '$ingredientName' AND foodGroup = '$foodGroup'";
    if(!$result = mysqli_query($conn,$query)) {
	echo $query;
    }
}
mysqli_close($conn);
?>
