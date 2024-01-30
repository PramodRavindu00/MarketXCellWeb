<?php
include("../php/auth.php");
include '../php/product.php';

if(!isset($_SESSION['email'])){
    header("Location: ../auth/login.php");
}

$authobj = new Auth();

if(isset($_POST['logout'])){
    $authobj->logout($_POST);
 }

$productobj = new Product();
$productData = $productobj->displayData();

$profilepicture = $_SESSION['profilepicture'];

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Products </title>
    <link rel="stylesheet" href="../css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="header">
        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">
        <button class="menu-toggle">&#9776; Menu</button>
        <div class="logoutbutton">
            <form action="" method="post" >
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>



<div class="sub-navbar-container">
  
        <button class="menu-toggle">&#9776; Inventory Menu</button>
        <div class="sub-navbar">
            <ul class="sub-navbar-list">
            <li> <img src="../img/order.svg" alt="Order List Icon"><a class="notActive" href="../orders/inventoryorderlist.php">Orders</a></li> 
            <li><img src="../img/product.svg" alt="Product List Icon"><a class="active" href="../product/inventoryProductList.php">Products</a></li> 
               <li><img src="../img/Category.svg" alt="Category List Icon"><a class="notActive" href="../category/inventorycategorylist.php">Categories</a></li> 
            </ul>
        </div>
     
        <a href="../inventorystaff/inventorySettings.php" class="profile-link">
      <div class="profile-container">
          <div class="profile-picture">
          <?php
                if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {
                    // If profile picture is set and not empty, display it
                    echo '<img src="' . $_SESSION['profilepicture'] . '" alt="Profile Picture">';
                } else {
                    // If profile picture is not set or empty, display default profile picture
                    echo '<img src="../img/defaultprofile.jpg" alt="Default Profile Picture">';
                }
                ?>
          </div>
          <div class="user-name">
                  <?php
                  $username = $_SESSION['username'];
                  echo "$username";
                  ?>
                    <div class="email">
                    <?php
                  $email = $_SESSION['email'];
                  echo "$email";
                  ?>
                    </div>
                </div>
      </div>
  </a>

</div>


<div class="search-container">

    <form action="" method="get">
    <div class="search-bar">
        <input type="text" placeholder="Search Products..." name="search">
    </form>
    
</div>
<button class="addB">
    <a href="../product/addproduct.php" class="addlink">Add Product</a>
</button>
</div>



<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category Name</th>
                <th>Commission<br>rate ( % )</th>
                <th>Stock </th>
                <th>Stock Level Status</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            if(!isset($_GET['search'])|| $_GET['search']===""){
                if(is_array($productData )){
                    foreach($productData as $id => $product){
                        $stockstatus = ($product['productquantity']>$product['minstocklevel']) ? "Good" : "Critical";
                        echo "<tr>
                        <td>".$no."</td>
                        <td>".$product['productid']."</td>
                        <td>".$product['productname']."</td>
                        <td>".'Rs. '.$product['productprice']."</td>
                        <td>".$product['categoryname']."</td>
                        <td>".$product['commissionRate']."%"."</td>
                        <td>".$product['productquantity']."</td>
                        <td>".$stockstatus."</td>
                        <td>".$product['featured']."</td>
                        ";
                        echo '
                        <td>
                        <a href="addproduct.php?Editproductid='.$id.'"><img src="../img/icon/editIcon.png" alt=""></a>
                        <a href="inventoryProductList.php?productid='.$id.'" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
                            </td>
                    </tr>';
                    $no++;
                    }
                }
            }else{
                if(is_array($productData )){
                    foreach($productData as $id => $product){
                        $stockstatus = ($product['productquantity']>$product['minstocklevel']) ? "Good" : "Critical";
                        if((
                        strpos($product['productid'],$_GET['search'])!== false || 
                        strpos($product['productname'],$_GET['search'])!== false ||
                        strpos($product['productprice'],$_GET['search'])!== false ||
                        strpos($product['categoryname'],$_GET['search'])!== false ||
                        strpos($stockstatus,$_GET['search'])!== false ||  
                        strpos($product['commissionRate'],$_GET['search'])!== false ) ||
                        strpos($product['productquantity'],$_GET['search'])!== false ||
                        strpos($product['featured'],$_GET['search'])!== false){
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$product['productid']."</td>
                            <td>".$product['productname']."</td>
                            <td>".'Rs. '.$product['productprice']."</td>
                            <td>".$product['categoryname']."</td>
                            <td>".$product['commissionRate']."%"."</td>
                            <td>".$product['productquantity']."</td>
                            <td>".$stockstatus."</td>
                            <td>".$product['featured']."</td>
                            ";
                            echo '
                        <td>
                        <a href="../product/addproduct.php?Editproductid='.$id.'"><img src="../img/icon/editIcon.png" alt=""></a>
                        <a href="../product/inventoryProductList.php?productid='.$id.'" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                        $no++;
                        }
                    }
                }
            }

            ?>          
        </tbody>
    </table>
</div>

<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>
<script src="../js/confirmdelete.js"></script>
<script src="js/navigation.js"> </script> 
</body>
</html>

<?php

if(isset($_GET['productid'])){
    
    $result = $productobj->deleteProduct($_GET['productid']);

    if( $result){
        echo '<script>
                    swal("Success!", "Product Deleted successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventoryProductList.php";
                      });
                  </script>';
       
      }else{
        echo '<script>
                    swal("Failed!", "An error occured while deleting the product!", "error")
                      .then((value) => {
                          window.location.href = "inventoryProductList.php";
                      });
                  </script>';
      }
 };
?>