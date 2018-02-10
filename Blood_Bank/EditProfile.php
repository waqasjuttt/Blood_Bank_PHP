<?php
require_once 'DbOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['name']) and
            isset($_POST['mobile']) and
                isset($_POST['dob']) and
                    isset($_POST['city']) and
                        isset($_POST['address']) and
                            isset($_POST['blood_group']))
        {
        //operate the data further 
 
        $db = new DbOperations();
 
        $result = $db->EditUser(
            $_POST['name'] 
            , $_POST['mobile']
            , $_POST['dob']
            , $_POST['city']
            , $_POST['address']
            , $_POST['blood_group']);
        if($result == 1){
            $response['error'] = false;
            $response['message'] = "Profile update successfully";
        }
        else{       
            $response['error'] = true; 
            $response['message'] = "Profile not updated";
        }
    }
}else{
    $response['error'] = true; 
    $response['message'] = "Invalid Request";
}
 
echo json_encode($response);
?>