<?php
	require_once 'DbOperations.php';
 
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='POST'){
	if (isset($_POST['mobile']) and isset($_POST['password']) ) {
		$db = new DbOperations();

		if ($db->userLogin($_POST['mobile'], $_POST['password'])) {
			$user = $db->getUserByMobile($_POST['mobile']);
			
			$response['error'] = false;
                        
			$response['id'] = $user['id'];
			$response['name'] = $user['name'];
			$response['mobile'] = $user['mobile'];
			$response['dob'] = $user['dob'];
			$response['city'] = $user['city'];
			$response['address'] = $user['address'];
			$response['blood_group'] = $user['blood_group'];

		}else{
			$response['error'] = true;
			$response['message'] = "Inavlid Mobile Number or Password";
		}
	}else{
		$response['error'] = true;
		$response['message'] = "Required fields are missing";
	}
}
echo json_encode($response);
?>