<?php
session_start();

$username = $_SESSION["username"];
$iname = $_POST["iname"];
$gname = $_POST["gname"];

$Pass = 'yourpassword';
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
    echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else if(empty($iname) || empty($gname)) {
    echo "Please enter all fields.\n";
}

// in progress
else {
        $insert_query = "INSERT INTO restrictions(username, ingredientName, foodGroup) VALUES ('$username', '$iname', '$gname')";    	
        if(mysqli_query($conn, $insert_query)) {
            header("Location: ../../pages/profile.php");
        }
        else {
            echo $insert_query;
        }
}
mysqli_close($conn);
?>
