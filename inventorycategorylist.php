<?php
include './php/category.php';

$categoryobj = new Category();
$categoryDaya = $categoryobj->displayData();


?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Category List </title>
    <link rel="stylesheet" href="css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
    <div class="header">
        <img class="logo-img" src="img/Frame 164.svg" alt="logo">
        <button class="menu-toggle">&#9776; Menu</button>
        <div class="navbar">
            <ul class="navbar-list">
                <li><a  href="index.html">Home</a></li>
                
                <li><a href="index.html#about">About Us</a></li>
                    
                <li><a href="inventoryDashboard.html#contact">Conact Us</a></li>
            </ul>
        </div>
        <button class="loginB">
            <a href="login.html" class="loginlink">Logout</a>
        </button>
    </div>



<div class="sub-navbar-container">
  
        <button class="menu-toggle">&#9776; Inventory Menu</button>
        <div class="sub-navbar">
            <ul class="sub-navbar-list">

               <li><img src="img/dashboard.svg" alt="Dashboard Icon"><a class="notActive" href="inventoryDashboard.html">Dashboard</a></li> 
               <li><img src="img/product.svg" alt="Product List Icon"><a class="notActive" href="inventoryProductList.html">Product List</a></li> 
               <li><img src="img/Category.svg" alt="Category List Icon"><a class="active" href="inventoryCategoryList.html">Category List</a></li> 
              <li> <img src="img/order.svg" alt="Order List Icon"><a class="notActive" href="inventoryOrderList.html">Order List</a></li> 
               <li><img src="img/report.svg" alt="Report Icon"><a class="notActive" href="inventoryReports.html">Reports</a></li> 

               
            </ul>
        </div>
     
        <a href="inventorySettings.html" class="profile-link">
            <div class="profile-container">
                <div class="profile-picture">
                    <img src="img/PicsArt_02-06-08.57.55 .jpg" alt="Profile Picture">
                </div>
                <div class="user-name">
                    Shehan, Good Morning!..
                    <div class="email">
                        linukaofficial4@gmail.com
                    </div>
                </div>
            </div>
        </a>

</div>

<div class="search-container">
<div class="search-bar">
    <form action="" method="get">
        <input type="text" placeholder="Search Categories..." name="search">
    </form>
    
</div>

<button class="addB">
    <a href="addcategory.php" class="addlink">Add Category</a>
</button>
</div>



<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            $no = 1;
            if(!isset($_GET['search'])|| $_GET['search']===""){
                if(is_array($categoryDaya )){
                    foreach($categoryDaya as $id => $category){
                        echo "<tr>
                        <td>".$no."</td>
                        <td>".$category['id']."</td>
                        <td>".$category['name']."</td>
                        <td>".$category['description']."</td>
                        ";
                        echo '
                        <td>
                            <a href="addcategory.php?editcategoryid='.$id.'"><img src="img/icon/editIcon.png" alt="">
                            </a>
                            <a href="php/delete.php?categoryid='.$id.'"><img src="img/icon/deleteIcon.png" alt=""></a>
                        </td>
                    </tr>';
                    $no++;
                    }
                }
            }else{
                if(is_array($categoryDaya )){
                    foreach($categoryDaya as $id => $category){
                        if((strpos($category['id'],$_GET['search'])!== false || 
                        strpos($category['name'],$_GET['search'])!== false ) ||
                        strpos($category['description'],$_GET['search'])!== false){
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$category['id']."</td>
                            <td>".$category['name']."</td>
                            <td>".$category['description']."</td>
                            ";
                            echo '
                            <td>
                                <a href="addcategory.php?editcategoryid='.$id.'"><img src="img/icon/editIcon.png" alt="">
                                </a>
                                <a href="php/delete.php?categoryid='.$id.'"><img src="img/icon/deleteIcon.png" alt=""></a>
                            </td>
                        </tr>';
                        $no++;
                        }
                    }
                }
            }

            ?>
            <!-- <tr>
                <td>01</td>
                <td>C001</td>
                <td>Bevarages</td>
                <td>Description</td>
                <td>
                    <img src="img/icon/eyeIcon.png" alt="">
                    <img src="img/icon/deleteIcon.png" alt="">
                    <img src="img/icon/editIcon.png" alt="">
                </td>
            </tr>
            <tr>
                <td>02</td>
                <td>C002</td>
                <td>Vegetables</td>
                <td>Description</td>
                <td>
                    <img src="img/icon/eyeIcon.png" alt="">
                    <img src="img/icon/deleteIcon.png" alt="">
                    <img src="img/icon/editIcon.png" alt="">
                </td>
            </tr> -->
            
        </tbody>

      
    </table>
</div>

<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>


</body>
 <script src="js/navigation.js">
   
    </script> 
</html>