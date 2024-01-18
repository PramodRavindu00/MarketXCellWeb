<?php
include("firebaseRDB.php");


class Category{

  private static $databaseURL = "https://marketxcell-a2edb-default-rtdb.firebaseio.com/";

  public function insertData($post){

      $db = new firebaseRDB(Category::$databaseURL);
      $insert=$db->insert("category",[
        "id"=>$_POST['id'],
        "name"=>$_POST['name'],
        "description"=>$_POST['description']
     ]);
		}

  public function editCategory($post,$EditCategoryId){
      $db = new firebaseRDB(Category::$databaseURL);
      $insert=$db->update("category",$EditCategoryId,[
        "id"=>$_POST['id'],
        "name"=>$_POST['name'],
        "description"=>$_POST['description']
     ]);
  }

  public function displayData(){
      $db = new firebaseRDB(Category::$databaseURL);
      $data = $db->retrieve("category");
      $data = json_decode($data, 1);
      return $data;
		}

  public function DisplayEditData($uniqueID){
      $db = new firebaseRDB(Category::$databaseURL);
      $data = $db->retrieve("category", $uniqueID);
      $data = json_decode($data, 1);
      return $data;
    }
  

  public function deleteCategory($uniqueID){
    $db = new firebaseRDB(Category::$databaseURL);
    $data = $db->delete("category", $uniqueID);
  }
    
}

?>