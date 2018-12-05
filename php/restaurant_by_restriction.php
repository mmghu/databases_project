<?php
// connect to mysql
$Pass = 'yourpassword'; // insert your password
$DB = 'lexHealth';
$conn = mysqli_connect('127.0.0.1', 'root', $Pass, $DB);


$restrictions = $_POST["restrictions"];

if (!$conn) {
   echo "Connection failed: ". mysqli_connect_error(). "\n";
}
else {
    $final_values = array(); 
    $get_res = "SELECT name FROM restaurant";
    if(!$result = mysqli_query($conn,$get_res)) {
        echo "Query failed: ". $mysqli->error. "\n";
    }
    
    if(mysqli_num_rows($result) > 0) {
        //read the rows of result
        while($res_ob = mysqli_fetch_assoc($result)) {
            $restaurant = $res_ob['name'];
    
            #find all items in that restaurant
            $items = array(); 
            $res_q = "SELECT DISTINCT menuitem.name FROM menuitem, restaurant WHERE restaurant.rid = menuitem.rid AND restaurant.name = '$restaurant'";  
            if(!$result2 = mysqli_query($conn,$res_q)) {
                echo "Query failed: ". $mysqli->error. "\n";
            }
            
            if(mysqli_num_rows($result2) > 0) {
                //read the rows of result
                while($row2 = mysqli_fetch_assoc($result2)) {
                     $items[] = $row2['name'];
                }
            }
            
            $baditems = array(); 
            foreach($restrictions as $restriction) { //all items that don't meet a restriction
                $query = "SELECT DISTINCT contains.name FROM contains, restaurant WHERE restaurant.rid = contains.rid AND ingredientName = '$restriction'
                AND restaurant.name = '$restaurant'"; #all restaurant items that have ingredient 
                
                if(!$result3 = mysqli_query($conn,$query)) {
                    echo "Query failed: ". $mysqli->error. "\n";
                }
                
                if(mysqli_num_rows($result3) > 0) {
                    //read the rows of result
                    while($row3 = mysqli_fetch_assoc($result3)) {
                         $baditems[] = $row3['name'];
                    }
                }
            }
            $baditems = array_unique($baditems); 

            $final_list = array_diff($items, $baditems); 
            if(count($final_list) > 0) {
                $final_values[] = $restaurant; 
            }
        }
        
        foreach($final_values as $viable){
            echo $viable,",";
        }
    }
    else {
        echo "ERROR";
    }
    

}
mysqli_close($conn);
?>
