<?php
require_once 'DbOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
            isset($_POST['mobile']) and
            isset($_POST['blood_group']) and
            isset($_POST['blood_bottle']) and
            isset($_POST['city']) and
            isset($_POST['hospital']))
        {
        //operate the data further 
        $db = new DbOperations();
 
        $result = $db->EditUserRequest(
            $_POST['mobile']
            , $_POST['blood_group']
            , $_POST['blood_bottle']
            , $_POST['city']
            , $_POST['hospital']);
        
        if($result == 1){
            $response['error'] = false;
            
            $result = $db->getUserByMobileForBloodRequest($_POST['mobile']);
            $response['mobile'] = $result['mobile'];
            $response['blood_group'] = $result['blood_group'];
            $response['blood_bottle'] = $result['blood_bottle'];
            $response['city'] = $result['city'];
            $response['hospital'] = $result['hospital'];
            
            $response['message'] = "Request update successfully";
        }
        else{       
            $response['error'] = true; 
            $response['message'] = "Request not updated";
        }
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);
?>