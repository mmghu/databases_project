<?php
// connect to mysql
$Pass = ''; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

$username = $_POST["username"];

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    // check username
    $user_query = "SELECT * FROM restrictions WHERE username = '". $username."';" ;
    if(!$result = mysqli_query($conn,$user_query)) {
	echo "Query failed: ". $mysqli->error. "\n";
    }
 
    if(mysqli_num_rows($result) > 0) {
        $restrictions = array(); 
        //read the rows of result
        while($row = mysqli_fetch_assoc($result)) {
             $restrictions[] = $row;  
        }

        header('Content-type: application/json');
        print json_encode($restrictions);
	}
}
mysqli_close($conn);
?>
