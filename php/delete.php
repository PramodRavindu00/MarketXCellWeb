<?php

include 'category.php';

if(isset($_GET['categoryid'])){
  $categoryobj = new Category();
   $delete = $categoryobj->deleteCategory($_GET['categoryid']);
   header("Location: ../category/inventorycategorylist.php");
}


?>