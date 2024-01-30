<?php

require_once("firebaseRDB.php");

class Offer{

    private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

    public function insertData($post){

        $db = new firebaseRDB(Offer::$databaseURL);
        $insert=$db->insert("offer",[
          "couponid"=>$_POST['code'],
          "offername"=>$_POST['name'],
          "offerdescription"=>$_POST['description'],
          "totalsales"=>$_POST['totalsales'],
          "offervalue"=>$_POST['value']
       ]);

       if($insert){
        return true;
       }else{
        return false;
       }
    }

    public function editOffer($post,$EditOfferId){
        $db = new firebaseRDB(Offer::$databaseURL);
        $insert=$db->update("offer",$EditOfferId,[
          "couponid"=>$_POST['code'],
          "offername"=>$_POST['name'],
          "offerdescription"=>$_POST['description'],
          "totalsales"=>$_POST['totalsales'],
          "offervalue"=>$_POST['value']
       ]);

       if($insert){
        return true;
       }else{
        return false;
       }
    }

    public function displayData(){
        $db = new firebaseRDB(Offer::$databaseURL);
        $data = $db->retrieve("offer");
        $data = json_decode($data, 1);
        return $data;
        }

        public function DisplayEditData($uniqueID){
            $db = new firebaseRDB(Offer::$databaseURL);
            $data = $db->retrieve("offer/$uniqueID");
            $data = json_decode($data, 1);
            return $data;
        } 
    

    public function deleteOffer($uniqueID){
        $db = new firebaseRDB(Offer::$databaseURL);
        $delete= $db->delete("offer", $uniqueID);

        if($delete){
            return true;
        }else{
            return false;
        }

    }
}
?>