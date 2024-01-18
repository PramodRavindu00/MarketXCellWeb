<?php
include("firebaseRDB.php");


class Product{

  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  public function insertData($post){
    $db = new firebaseRDB(Product::$databaseURL); //Step 1
    $insert=$db->insert("product",[
      "productid"=>$_POST['id'],
      "productname"=>$_POST['name'],
      "productdescription"=>$_POST['description'],
      "productprice"=>$_POST['price'],
      "productquantity"=>$_POST['quantity']
   ]);
  }

  public function displayData(){
    $db = new firebaseRDB(Product::$databaseURL);
    $data = $db->retrieve("product");
    $data = json_decode($data, 1);
    return $data;
  }
    

}


?>