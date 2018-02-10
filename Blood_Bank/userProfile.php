<?php
require_once 'DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['mobile']))
        {
        //operate the data further 
 
        $db = new DbOperations();
 
        $user = $db->getUserByMobile($_POST['mobile']);
            $response['id'] = $user['id'];
            $response['name'] = $user['name'];
            $response['mobile'] = $user['mobile'];
            $response['dob'] = $user['dob'];
            $response['city'] = $user['city'];
            $response['address'] = $user['address'];
            $response['blood_group'] = $user['blood_group'];
        // if($result == 1){
        //     $response['error'] = false;
        //     $response['message'] = "Profile update successfully";
        // }
        // else{       
        //     $response['error'] = true; 
        //     $response['message'] = "Profile not updated";
        // }
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);
?>