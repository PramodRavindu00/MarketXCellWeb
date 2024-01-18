<?php

  include './php/category.php';
  $categoryobj = new Category();

  $Description ="";
  $id ="";
  $name ="";
  $action="submit";
  $firebaseID = "";
  
  if(isset($_POST['submit'])) {
    $categoryobj->insertData($_POST);
    header("Location: inventorycategorylist.php");
  }

  if(isset($_POST['editsubmit'])) {
    $categoryobj->editCategory($_POST,$_POST['firebaseID']);
    header("Location: inventorycategorylist.php");
  }

  if(isset($_GET['editcategoryid'])){
    $firebaseID = $_GET['editcategoryid'];
    $categoryobj = new Category();
    $categoryEditdata = $categoryobj->DisplayEditData($_GET['editcategoryid']);
    if(is_array($categoryEditdata )){
        foreach($categoryEditdata as $id => $category){
            $id = $category['id'];
            $name = $category['name'];
            $Description = $category['description'];
            $action="editsubmit";
            }
        }
    }

?>

<!DOCTYPE html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
</head>
<body>
    <div class="header">
        
        <img class="logo-img" src="img/Frame 164.svg"alt="logo">
        

        <div class="navbar">
            <ul>
                <li><a class="active" href="index.html">Home</a></li>
                
                <li><a class="active" href="index.html#about">About Us</a></li>
                    
                <li><a class="active" href="inventoryDashboard.html#contact">Conact Us</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="login-container">

    
        <div>
            <p class="loginHeader" >Add Category</p>
        </div >
         <div class="subHeading">
            Enter Category Details
         </div>

    <form action="addcategory.php" method="POST">

    <input type="hidden" id="custId" name="firebaseID" value="<?php echo $firebaseID ?>">

        <div class="fieldHeader"> Category ID </div>
        <div >               
             <input type="text" placeholder="Enter category Id" class="txtField" name="id" value="<?php echo $id?>" required />                           
         </div>
         <div class="fieldHeader">Category Name</div>  
        <div >               
            <input type="text" placeholder="Enter category name" class="txtField" name="name" value="<?php echo $name?>"  required>               
         </div>
         <div class="fieldHeader">Category Description</div>  
         <div >
            <textarea placeholder="Enter category description" name="description" class="txtArea" required ><?php echo $Description?></textarea>
        </div>
        <div >
            <button class="btn" name="<?php echo $action?>">Add Category
            </button>
            </div>
        
        </div>
    </form>


<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>

</body>
</html>