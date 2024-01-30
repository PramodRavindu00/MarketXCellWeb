<?php
class Settings{

    private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

    public function displayProfile($loggeduserid){
        $db = new firebaseRDB(Settings::$databaseURL);
        $data = $db->retrieve("companyuser");
        $data = json_decode($data, 1);
        $loggeduser = $data[$loggeduserid];
        return $loggeduser;
    }

    public function updateProfile($post,$loggeduserid){
        $db = new firebaseRDB(Settings::$databaseURL);

        $name=trim(ucwords($_POST['name']));
        $email=$_POST[ 'email'];
        $phone=$_POST['mobile'];
        $address=preg_replace('/\s+/', ' ', trim($_POST['address']));
        $question=$_POST[ 'question'];
        $answer = preg_replace('/\s+/', ' ', trim($_POST['answer']));

        $update=$db->update("companyuser",$loggeduserid,[
            "name"=>$name,
            "email"=> $email,
            "phone"=> $phone,
            "address"=>$address,
            "securityquestion"=>$question,
            "answer"=>$answer ,
         ]);

         if($update){
            return true;
         }else{
            return false;
         }
    }

    public function updateProfilePicture($post,$loggeduserid){
        $db = new firebaseRDB(Settings::$databaseURL);
        $imageURL = $_POST['imgURL'];
        $update=$db->update("companyuser",$loggeduserid,[
           "photo"=> $imageURL
         ]);

         if($update){
            $_SESSION['profilepicture'] = $imageURL;
         }
    }
    public function removeProfilePicture($post,$loggeduserid){
        $db = new firebaseRDB(Settings::$databaseURL);
        $imageURL = "";
        $update=$db->update("companyuser",$loggeduserid,[
           "photo"=> $imageURL
         ]);

         if($update){
            $_SESSION['profilepicture'] = $imageURL;
         }
    }
}



?>