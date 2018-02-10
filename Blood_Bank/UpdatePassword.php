<?php
require_once 'DbOperations.php';
 
$response = array(); 
 
if($_SERVER['REQUEST_METHOD']=='POST')
    {
    if(isset($_POST['mobile']) and isset($_POST['password']))
        {
            $db = new DbOperations();
 
            $result = $db->createNewPassword($_POST['mobile'], $_POST['password']);
            
            if($result == 1)
            {
                $response['error'] = false;

                $user = $db->getUserByMobile($_POST['mobile']);
                $response['id'] = $user['id'];
                $response['name'] = $user['name'];
                $response['mobile'] = $user['mobile'];
                $response['city'] = $user['city'];
                $response['address'] = $user['address'];
                $response['blood_group'] = $user['blood_group'];
                $response['dob'] = $user['dob'];
     
                $response['message'] = "Successfully Changed Password";
            }
            else
            {
                $response['error'] = true;
                $response['message'] = "Password not Updated, Check your Email Address";
            } 
        }
    }
else{
    $response['error'] = true; 
    $response['message'] = "Required fields are missing";
}
 
echo json_encode($response);
?>