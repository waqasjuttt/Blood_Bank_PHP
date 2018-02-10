<?php
require_once 'DbOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['mobile']))
        {
        $db = new DbOperations();
 
        $result = $db->isMobileExistForForgetPassword($_POST['mobile']);
        
        if($result == 1){
            $response['error'] = true;
            $response['message'] = "Mobile number exist";
        }
    else{
        $response['error'] = false; 
        $response['message'] = "Mobile number not exist";
    }        
    }
        
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);
?>