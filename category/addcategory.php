<?php

 include("../php/auth.php");
include ("../php/category.php");
 
$authobj = new Auth();

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}

if (isset($_POST['logout'])) {
    $authobj->logout($_POST);
}
  $categoryobj = new Category();

  $Description ="";
  $id =$categoryobj->generateUniqueID();
  $name ="";
  $action="submit";
  $firebaseID = "";
  $categoryIMG = "";
  $buttonText = "Add New Category";
  
  if(isset($_GET['editcategoryid'])){
    $firebaseID = $_GET['editcategoryid'];
    $categoryobj = new Category();
    $categoryEditdata = $categoryobj->DisplayEditData($_GET['editcategoryid']);
    $id =$categoryEditdata['id'];
    $name =$categoryEditdata['name'];
    $Description =$categoryEditdata['description'];
    $categoryIMG = $categoryEditdata['categoryImg'];
    $action="editsubmit";
    $buttonText = "Update Category";
    }

?>

<!DOCTYPE html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="header">
        
    <img class="logo-img" src="../img/Frame 164.svg"alt="logo">
        
    <button class="backbtn" onclick="window.location.href='../category/inventoryCategoryList.php'">
        <a href="../category/inventoryCategoryList.php" class="backbtnlink">Back</a>
    </button>
</div>


<div class="login-container">

    
    <div>
        <p class="loginHeader" >Add Category</p>
    </div >

    <div class="subHeading">
        Enter Category Details
    </div>

    <form action="addcategory.php" method="POST" onsubmit="return categoryValidation();">

     
        <input type="hidden" id="custId" name="firebaseID" value="<?php echo $firebaseID ?>">
    
        <input type="hidden" id="imgURL" name="imgURL" value="<?php echo $categoryIMG ?>">

            <div class="fieldHeader"> Category ID </div>

            <div >               
                <input type="text" placeholder="Enter category Id" class="txtField" name="id" value="<?php echo $id?>" required readonly/>                           
            </div>

            <div class="fieldHeader">Category Name</div> 

            <div >
            <span id="nameError" class="error"></span>        
                <input type="text" placeholder="Enter category name" class="txtField" name="name" value="<?php echo $name?>" id="categoryname">               
            </div>

            <div class="fieldHeader">Category Description</div> 

            <div >
            <span id="descriptionError" class="error"></span>
                <textarea placeholder="Enter category description" name="description" class="txtArea" id="categorydescription"><?php echo $Description?></textarea>
            </div>

            <div class="fieldHeader"> Cateogry Image </div>

            <span id="imageError" class="error"></span>
            
            <div class="passwordContainer">
                <input type="file" id="file" name="file" class="fileInput" hidden onchange="uploadCategoryImage(event)" accept="image/png, image/jpeg">
                    <label for="file" id="file" class="eye">
                        <img class="eye-icon" src="../img/icon/image.svg" alt="add image">
                    </label>
                <div id="fileNameDisplay" class="fileNameDisplay">Upload image</div>
            </div> 

            <div>
                <div class="" id="submitbtn">
                    <button class="btn" name="<?php echo $action?>"><?php echo $buttonText?></button>       
                </div>

                <div class="hidden" id="loadingIMG">
                    <img src="../img/loading.gif" width="80" height="80" >           
                </div>
            </div>
        
    </form>
</div>


<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  <script src="../js/imgUpload.js"></script>
  <script src="../js/formValidations.js"></script>
 
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $resultinsert = $categoryobj->insertData($_POST);
    if( $resultinsert){
        echo '<script>
                    swal("Success!", "New Category added successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventorycategoryList.php";
                      });
                  </script>';
       
      }else{
        echo '<script>
                    swal("Failed!", "Category not added successfully!", "error")
                      .then((value) => {
                          window.location.href = "addcategory.php";
                      });
                  </script>';
      }
  }

  if(isset($_POST['editsubmit'])) {
    $resultupdate = $categoryobj->editCategory($_POST,$_POST['firebaseID']);
    if($resultupdate){
        echo '<script>
                    swal("Success!", "Category details has been updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventorycategoryList.php";
                      });
                  </script>';
       
    }else{
        echo '<script>
                    swal("Failed!", "An error occured while updating category details !", "error")
                      .then((value) => {
                          window.location.href = "inventorycategoryList.php";
                      });
                  </script>';
    }
  }

?>