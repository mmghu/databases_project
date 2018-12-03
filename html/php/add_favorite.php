<?php
session_start();

$username = $_SESSION["username"];
$rid = $_POST["rid"];
$itemname = $_POST["itemname"];

$Pass = 'yourpassword';
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
    echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else if(empty($rid) || empty($itemname)) {
    echo "Please enter all fields.\n";
}

// in progress
else {
        $insert_query = "INSERT INTO favorites(username, itemName, rid) VALUES ('$username', '$itemname', $rid)";    	
        if(mysqli_query($conn, $insert_query)) {
            header("Location: ../../pages/profile.php");
        }
        else {
            echo $insert_query;
        }
}
mysqli_close($conn);
?>
