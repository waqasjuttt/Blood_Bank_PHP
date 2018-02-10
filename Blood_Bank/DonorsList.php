<?php  
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'blood_bank');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT name, mobile, blood_group, city, address FROM blood;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($name, $mobile, $blood_group, $city, $address);
 
 $bloodlist = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['name'] = $name; 
 $temp['mobile'] = $mobile; 
 $temp['blood_group'] = $blood_group; 
 $temp['city'] = $city; 
 $temp['address'] = $address; 
 array_push($bloodlist, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($bloodlist);