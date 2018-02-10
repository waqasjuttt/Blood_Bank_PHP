<?php
    require_once 'DbOperations.php';
 
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['mobile']) and isset($_POST['name']) and isset($_POST['password'])) {
        $db = new DbOperations();

        $result = $db->createUser($_POST['mobile'], $_POST['name'], $_POST['password']);

        if ($result == 1) {
            $user = $db->getUserByMobile($_POST['mobile']);
            
            $response['error'] = false;
            $response['message'] = "User registered successfully";

                        
            $response['id'] = $user['id'];
            $response['name'] = $user['name'];
            $response['mobile'] = $user['mobile'];
            $response['dob'] = $user['dob'];
            $response['city'] = $user['city'];
            $response['address'] = $user['address'];
            $response['blood_group'] = $user['blood_group'];

        }else{
            $response['error'] = true;
            $response['message'] = "This mobile number is already exists";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}
echo json_encode($response);
?>