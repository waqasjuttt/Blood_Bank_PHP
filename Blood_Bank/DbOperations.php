<?php
    
    class DbOperations{
 
        private $con; 
 
        function __construct(){
 
            require_once dirname(__FILE__).'/DbConnect.php';
 
            $db = new DbConnect();
 
            $this->con = $db->connect();
 
        }
 
        /*CRUD -> C -> CREATE */
 
        public function createUser($mobile_number, $name, $pass){
            $password = md5($pass);
            $stmt = $this->con->prepare("INSERT INTO `blood` (`id`, `mobile`, `name`, `password`) VALUES (NULL, ?, ?, ?);");
            $stmt->bind_param("sss", $mobile_number, $name, $password);
            $this->createUserRequest($mobile_number, $name);
            if($stmt->execute()){
                return 1; 
            }else{
                return 2; 
            }
        }
        
        private function createUserRequest($mobile_number, $name){
            $stmt = $this->con->prepare("INSERT INTO `blood_request` (`id`, `mobile`, `name`) VALUES (NULL, ?, ?);");
            $stmt->bind_param("ss", $mobile_number, $name);
            if($stmt->execute()){
                return 1; 
            }else{
                return 2; 
            }
        }
        
        public function getUserByMobile($mobile_number){
            $stmt = $this->con->prepare("SELECT * FROM blood WHERE mobile =?");
            $stmt->bind_param("s", $mobile_number);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        
        public function getUserByMobileForBloodRequestDetails($mobile_number){
            $stmt = $this->con->prepare("SELECT * FROM blood_request WHERE mobile =?");
            $stmt->bind_param("s", $mobile_number);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        
        public function getUserByMobileForBloodRequest($mobile_number){
            $stmt = $this->con->prepare("SELECT * FROM blood_request WHERE mobile =?");
            $stmt->bind_param("s", $mobile_number);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        
        public function getUpdatedUserData($id){
            $stmt = $this->con->prepare("SELECT * FROM blood WHERE id = ?");
            $stmt->bind_param("s",$id);
            if($stmt->execute()){
               $stmt->get_result()->fetch_assoc();
               return 1;
            }
            else{
                return 0;;
            }
        }

        private function isUserExist($mobile_number){
            $stmt = $this->con->prepare("SELECT id FROM blood WHERE mobile = ? ");
            $stmt->bind_param("s", $mobile_number);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }

        public function userLogin($mobile_number,$pass){
            $password = md5($pass);
            $stmt = $this->con->prepare("SELECT id FROM blood WHERE mobile = ? AND password = ?");
            $stmt->bind_param("ss",$mobile_number,$password);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
        
        private function isMobileExist($mobile_number){
            $stmt = $this->con->prepare("SELECT id FROM blood WHERE mobile = ?");
            $stmt->bind_param("s",$mobile_number);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0; 
        }
        
        public function isMobileExistForForgetPassword($mobile_number){
            if($this->isMobileExist($mobile_number)){
                return 1; 
            }else{        
               return 0;
            }
        }
        
        public function createNewPassword($mobile_number, $pass)
        {
            if($this->isMobileExistForForgetPassword($mobile_number)){
                $password = md5($pass);
                $stmt = $this->con->prepare("UPDATE blood SET password = ? WHERE mobile = ?");
                $stmt->bind_param("ss",$password, $mobile_number);
                if($stmt->execute()){
                    return 1;
                }else{
                    return 2;
                }
            }
            else
            { 
                return 0; 
            }           
        }
        
        public function EditUser($name, $mobile_number, $dob, $city, $address, $blood_group)
        {
            $stmt = $this->con->prepare("UPDATE blood SET name = ?, blood_group = ?, city = ?, address = ? , dob = ? WHERE  mobile = ?");
            $stmt->bind_param("ssssss", $name, $blood_group, $city, $address, $dob, $mobile_number);
            $this->EditUserBloodRequest($name, $mobile_number);
            if($stmt->execute()){
                return 1;
            }else{
                return 2;
            }
        }
        
        private function EditUserBloodRequest($name, $mobile_number)
        {
            $stmt = $this->con->prepare("UPDATE blood_request SET name = ? WHERE  mobile = ?");
            $stmt->bind_param("ss", $name, $mobile_number);
            if($stmt->execute()){
                return 1;
            }else{
                return 2;
            }
        }
        
        public function EditUserRequest($mobile_number, $blood_group, $blood_bottle, $city, $hospital)
        {
            $stmt = $this->con->prepare("UPDATE blood_request SET blood_group = ?, blood_bottle = ?, city = ? , hospital = ? WHERE  mobile = ?");
            $stmt->bind_param("sssss", $blood_group, $blood_bottle, $city, $hospital, $mobile_number);
            if($stmt->execute()){
                return 1;
            }else{
                return 2;
            }
        }
}
?>