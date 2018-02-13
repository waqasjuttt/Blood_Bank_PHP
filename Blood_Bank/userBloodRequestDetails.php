<?php
require_once 'DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['mobile']))
        {
        //operate the data further 
 
        $db = new DbOperations();
 
        $user = $db->getUserByMobileForBloodRequestDetails($_POST['mobile']);
            $response['mobile'] = $user['mobile'];
            $response['blood_group'] = $user['blood_group'];
            $response['blood_bottle'] = $user['blood_bottle'];
            $response['city'] = $user['city'];
            $response['hospital'] = $user['hospital'];
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);
?>