<?php
include("firebaseRDB.php");

class Orders{


  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  public function displayData(){
    $db = new firebaseRDB(Orders::$databaseURL);
    $data = $db->retrieve("Orders");
    $data = json_decode($data, 1);
    return $data;
  }


  public function insertData(){

    $db = new firebaseRDB(Orders::$databaseURL);
    $insert=$db->insert("Orders",[
      "orderId"=>"3",
      "agentId"=>"3",
      "OrderValue"=>"3",
      "orderStatus"=>"Not Delivered",
      "orderProducts" => ["productid1"=>"product1","productid2"=>"product3"],
      "Aaddress"=>"3"
   ]);
  }

  public function displayProductList(){
    $db = new firebaseRDB(Orders::$databaseURL);
  }

  
  function updateOrderStatus($EditCategoryId){
    $db = new firebaseRDB(Orders::$databaseURL);
    $update=$db->update("Orders",$EditCategoryId,[
      "orderStatus"=>'Delivered'
   ]);

   if($update){
return true;
   }
   else{
    return false;
   }
  
}

public function DisplayEditData($uniqueID){
  $db = new firebaseRDB(Product::$databaseURL);
 $data = $db->retrieve("product/$uniqueID");
 $data = json_decode($data, 1);
 return $data;
}

}


?>