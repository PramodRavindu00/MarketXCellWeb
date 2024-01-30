<?php
include("firebaseRDB.php");


class Category{

  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  public function insertData($post){

      $db = new firebaseRDB(Category::$databaseURL);
      $insert=$db->insert("category",[
        "id"=>$_POST['id'],
        "name"=>$_POST['name'],
        "description"=>$_POST['description'],
        "categoryImg"=>$_POST['imgURL']
     ]);
     
     if($insert){
      return true;
         }
         else{
          return false;
         }
		}

  public function editCategory($post,$EditCategoryId){
      $db = new firebaseRDB(Category::$databaseURL);
      $update=$db->update("category",$EditCategoryId,[
        "id"=>$_POST['id'],
        "name"=>$_POST['name'],
        "description"=>$_POST['description'],
        "categoryImg"=>$_POST['imgURL']
     ]);

     if($update){
      return true;
         }
         else{
          return false;
         }
  }

  public function displayData(){
      $db = new firebaseRDB(Category::$databaseURL);
      $data = $db->retrieve("category");
      $data = json_decode($data, 1);
      return $data;
		}

  public function DisplayEditData($uniqueID){
      $db = new firebaseRDB(Category::$databaseURL);
      $data = $db->retrieve("category/$uniqueID");
      $data = json_decode($data, 1);
      return $data;
    }
  

  public function deleteCategory($uniqueID){
    $db = new firebaseRDB(Category::$databaseURL);
    $delete = $db->delete("category", $uniqueID);

    if($delete){
      return true;
         }
         else{
          return false;
         }
  }

  public function generateUniqueID(){
    $db = new firebaseRDB(Category::$databaseURL);
    $data = $db->retrieve("category");
    $data = json_decode($data, 1);
    $uniqueId;
    $latestnum=0;
   if($data!== null){
    foreach($data as $id => $product){
      $uniqueId = $product['id'];
      $name = explode("-",$uniqueId);
      if($name[1]>$latestnum){
        $latestnum=$name[1];
      }
    }
   }
    $latestnum++;
    $uniqueId = "Category-00".$latestnum;
    return $uniqueId;
  }

}

?>