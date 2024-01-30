<?php
include("firebaseRDB.php");

class Product{

  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  public function insertData($post){
    $db = new firebaseRDB(Product::$databaseURL); //Step 1

    $featured = isset($_POST['featured']) && $_POST['featured'] == 'on' ? 'Yes' : 'No';
    $insert=$db->insert("product",[
      "productid"=>$_POST['id'],
      "productname"=>$_POST['name'],
      "productdescription"=>$_POST['description'],
      "productprice"=>$_POST['price'],
      "categoryname"=>$_POST['categoryname'],
      "commissionRate"=>$_POST['commission'],
      "productquantity"=>$_POST['quantity'],
      "minstocklevel"=>$_POST['minstock'],
      "productIMG"=>$_POST['imgURL'],
      "featured"=>$featured
   ]);

   if($insert){
return true;
   }
   else{
    return false;
   }
  }

  public function displayData(){
    $db = new firebaseRDB(Product::$databaseURL);
    $data = $db->retrieve("product");
    $data = json_decode($data, 1);
    return $data;
  }

  public function editProduct($post,$Editproductid){
    $featured = isset($_POST['featured']) && $_POST['featured'] == 'on' ? 'Yes' : 'No';
    $db = new firebaseRDB(Product::$databaseURL);
    $update = $db->update("product", $Editproductid, [
      "productid" => $_POST['id'],
      "productname" => $_POST['name'],
      "productdescription" => $_POST['description'],
      "productprice" => $_POST['price'],
      "categoryname" => $_POST['categoryname'],
      "commissionRate"=>$_POST['commission'],
      "productquantity" => $_POST['quantity'],
      "minstocklevel"=>$_POST['minstock'],
      "featured"=>$featured
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

 public function deleteProduct($uniqueID){
  $db = new firebaseRDB(Product::$databaseURL);
  $delete = $db->delete("product", $uniqueID);

  if($delete){
    return true;
       }
       else{
        return false;
       }
      
}

public function returnCategoryNames(){
  $db = new firebaseRDB(Product::$databaseURL);
  $categoryList=array();
  $data = $db->retrieve("category");
  $data = json_decode($data, 1);
  if(is_array($data)){
    foreach($data as $id => $category){
      array_push($categoryList,$category['name']);
    }
  }
  return $categoryList;
}

public function generateUniqueID(){
  $db = new firebaseRDB(Product::$databaseURL);
  $data = $db->retrieve("product");
  $data = json_decode($data, 1);
  $uniqueId;
  $latestnum=0;
  if($data!== null){
    foreach($data as $id => $product){
      $uniqueId = $product['productid'];
      $name = explode("-00",$uniqueId);
      if($name[1]>$latestnum){
        $latestnum=$name[1];
      }
    }
  }
  $latestnum++;
  $uniqueId = "Product-00".$latestnum;
  return $uniqueId;
}

}


?>