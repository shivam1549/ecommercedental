<?php
class VerifyuserController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function verifyUser($token, $email){
        $sql = "SELECT * FROM user WHERE email = '$email' AND verify_token = '$token' LIMIT 1";
        $result = $this->conn->query($sql);
        // print_r($result);
        if($result->num_rows > 0){
           $data = $result->fetch_assoc();
        //   echo $data['id'];
           $this->activateUser($data['id']);
           return true;
        }
        else{
            return false;
        }
    }
    
    public function activateUser($id){
        $sql = "UPDATE user SET status = '1' WHERE id ='$id'";
        $result = $this->conn->query($sql);
    }
  
}
?>