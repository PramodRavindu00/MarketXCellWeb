<?php
  // Include database file
  include './php/product.php';
  $productobj = new Product();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $productobj->insertData($_POST);
  }
?>

<!DOCTYPE html>
<head>
    <title>Add Product</title>
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
            <p class="loginHeader" >Add Product</p>
        </div >
         <div class="subHeading">
            Enter Product Details
         </div>

    <form action="addproduct.php" method="POST">

        <div class="fieldHeader"> Product ID </div>
     
        <div >               
             <input type="text" placeholder="Enter product Id" class="txtField" name="id"required>                           
         </div>

         <div class="fieldHeader">Product Name</div>  

        <div >               
            <input type="text" placeholder="Enter category name" class="txtField" name="name"required>               
         </div>
         <div class="fieldHeader">Product Description</div>  

         <div >
            <textarea placeholder="Enter category description" class="txtArea" name="description" required></textarea>
        </div>
        <div class="fieldHeader"> Price </div>
     
        <div >               
             <input type="text" placeholder="Enter price" class="txtField" name="price"required>                           
         </div>
         <div class="fieldHeader"> Quantity </div>
     
         <div >               
              <input type="text" placeholder="Enter quantity Id" class="txtField" name="quantity"required>                           
          </div>
 
         
    <div >
        <button class="btn" name="submit">Add Product</button>
        </div>
     </form>
</div>


<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>

</body>
</html>