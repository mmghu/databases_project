<?php
// connect to mysql
$Pass = 'Perina3872!'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    // check username
    $user_query = "SELECT * FROM restaurant;";
    if(!$result = mysqli_query($conn,$user_query)) {
	echo "Query failed: ". $mysqli->error. "\n";
    }
 
    if(mysqli_num_rows($result) > 0) {
        $restaurants = array(); 
        //read the rows of result
        while($row = mysqli_fetch_assoc($result)) {
             $restaurants[] = $row;  
        }

        header('Content-type: application/json');
        print json_encode($restaurants);
	}
}
mysqli_close($conn);
?>
