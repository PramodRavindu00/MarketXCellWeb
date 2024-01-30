<?php
session_start(); 


class Auth{


    private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";
  
    public function AddUser($post){

      $db = new firebaseRDB(Auth::$databaseURL);
      $data = $db->retrieve("companyuser");
      $data = json_decode($data, 1);
      $email = $_POST[ 'email'];

      if(is_array($data)){
          foreach($data as $id => $user){
            if ($user['email'] == $email) {
              
              return "emailExists";
          }
          }
        }

        $name=trim(ucwords($_POST['name']));
        $email=$_POST[ 'email'];
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone=$_POST['number'];
        $usertype="inventoryStaff";
        $address=preg_replace('/\s+/', ' ', trim($_POST['address']));
        

        $insert=$db->insert("companyuser",[
          "name"=>$name,
          "email"=>$email,
          "password"=>$hashedPassword,
          "phone"=>$phone,
          "usertype"=>$usertype,
          "address"=>$address,
          "securityquestion"=>"",
          "answer"=>"",
          "photo"=>""
       ]);

       if($insert){
        return  "success";;
       }
       else{
        return "failed"; ;
       }
      }
          

    public function LogIn($post){

      $db = new firebaseRDB(Auth::$databaseURL);
      $data = $db->retrieve("companyuser");
      $data = json_decode($data, 1);

      $email=$_POST['email'];
      $password=$_POST['password'];

      if(is_array($data)){
          foreach($data as $id => $user){
            if($email == $user['email']){
             
              if(password_verify($password,$user['password'])){
                
              $_SESSION['email']=$user['email'];   //get email 
              $_SESSION['username']=$user['name']; //get user name
              $_SESSION['firebaseid']=$id;
              $_SESSION['profilepicture']=$user['photo'];

              $usertype=$user['usertype'];
              $_SESSION['usertype'] =  $usertype;

              if( $usertype == "administrator"){
                echo '<script>
            setTimeout(function() {
                window.location.href = "../admin/adminStaffList.php";
            }, 2000);
            </script>';

           return "validadmin";

              }
              elseif($usertype == "inventoryStaff"){
                echo '<script>
            setTimeout(function() {
                window.location.href = "../orders/inventoryorderlist.php";
            }, 2000);
            </script>';

          return "validstaff";

              }
              }
              else{
                return "passwordincorrect";
              }
            }
            
            }
            return "emailnotfound";
        }
      }

    public function logout(){
      session_unset();    
      session_destroy();
      header("Location: ../auth/login.php");
    }

    public function changePassword($post, $firebaseid){

      $db = new firebaseRDB(Auth::$databaseURL);
      $data = $db->retrieve("companyuser");
      $data = json_decode($data, 1);
      $loggeduser = $data[$firebaseid];

      $savedpassword= $loggeduser['password'];   //saved password

      $currentpassword = $_POST['currentpassword']; 

      if(password_verify($currentpassword,$savedpassword)){

        $newpassword = $_POST['newpassword'];
        $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

        $update=$db->update("companyuser",$firebaseid,[
          "password"=>$hashedPassword,
       ]);
        
       if($update){
         return "changed";
       }
       else{
        return "failed";
       }
      }else{
        return "incorrect";
      }
      
    }

    public function sumbitEmailToRecover($post)
    {
      $email=$_POST[ 'email'];

      $db = new firebaseRDB(Auth::$databaseURL);
      $data = $db->retrieve("companyuser");
      $data = json_decode($data, 1);

      if(is_array($data)){
        foreach($data as $id => $user){
          if($email == $user['email']){
           $_SESSION['idfromemailsubmit'] = $id;
           header("Location: ../auth/recoveryTwo.php");
           exit();
          }
        }
        return "false";
    }
    return "error";
  }

  public function verifyAccount($post,$id){

    $db = new firebaseRDB(Auth::$databaseURL);
    $data = $db->retrieve("companyuser");
    $data = json_decode($data, 1);

    $question=$_POST[ 'question'];

    $answer = $_POST['answer'];
    $answer= str_replace(' ','',$answer);    //removing spaces   

    if(is_array($data)){
      foreach($data as $id => $user){     
        $storedanswer = $user['answer'];
        $storedanswer= str_replace(' ','',$storedanswer);      //removing spaces     
         
        if($question == $user['securityquestion'] &&  strcasecmp($answer,$storedanswer)==0){   //ignoring case senitive
          header("Location: ../auth/recoveryThree.php");
        }
      }
      return "false";
  }
  return "error";
  }

  public function resetPassword($post,$id){
    $password = $_POST['password'];
    $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
    $db = new firebaseRDB(Auth::$databaseURL);

    $update=$db->update("companyuser",$id,[
      "password"=>$hashedPassword
    ]);

    session_unset();
    session_destroy();    //clrearing sessions when used to reseting

    if($update){

      echo '<script>
            setTimeout(function() {
                window.location.href = "../auth/login.php";
            }, 3000);
            </script>';

            return true;
    }
    else{
      echo '<script>
            setTimeout(function() {
                window.location.href = "../auth/login.php";
            }, 3000);
            </script>';
            
      return false;
    }
  }
} 
?>