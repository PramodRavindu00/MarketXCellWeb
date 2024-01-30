<?php
include("firebaseRDB.php");


class User{

  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  

  public function displayStaffData(){
      $db = new firebaseRDB(User::$databaseURL);
      $data = $db->retrieve("companyuser");
      $data = json_decode($data, 1);
      return $data;
		}

 

  public function deleteUser($uniqueID){
    $db = new firebaseRDB(User::$databaseURL);
    $delete = $db->delete("companyuser", $uniqueID);

    if($delete){
     return true;
    }
    else{
      return false;
    }

  }


  public function displayAgentData(){
    $db = new firebaseRDB(User::$databaseURL);
    $data = $db->retrieve("Users");
    $data = json_decode($data, 1);
    return $data;
      }

  

}

?>