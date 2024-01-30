<?php
include("../php/auth.php");
include("../php/orders.php"); 

if(!isset($_SESSION['email'])){
    header("Location: ../auth/login.php");
}

$authobj = new Auth();
if(isset($_POST['logout'])){
    $authobj->logout($_POST);
 }


$orderobj = new Orders();
$orderdata = $orderobj->displayData();



$profilepicture = $_SESSION['profilepicture'];

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Order List </title>
    <link rel="stylesheet" href="../css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...YOUR_INTEGRITY_HASH_HERE..." crossorigin="anonymous" />
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
            <li> <img src="../img/order.svg" alt="Order List Icon"><a class="active" href="../orders/inventoryorderlist.php">Orders</a></li> 
            <li><img src="../img/product.svg" alt="Product List Icon"><a class="notActive" href="../product/inventoryProductList.php">Products</a></li> 
               <li><img src="../img/Category.svg" alt="Category List Icon"><a class="notActive" href="../category/inventorycategorylist.php">Categories</a></li> 
            </ul>
        </div>
     
        <a href="../inventorystaff/inventorySettings.php" class="profile-link">
      <div class="profile-container">
          <div class="profile-picture">
          <?php
                if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {
                   
                    echo '<img src="' . $_SESSION['profilepicture'] . '" alt="Profile Picture">';
                } else {
               
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
    <input type="text" placeholder="Search Orders..." name="search">
</div> 
</form>
</div>



<div class="table">
    <table class="table">
        <thead>
            <tr>
               <th>No</th>
                <th>Order ID</th>
                <th>Agent ID</th>
                <th>Address</th>
                <th>Order Value</th>
                <th>Status</th>
                <th>Action</th>  
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            if(!isset($_GET['search'])|| $_GET['search']===""){
                if(is_array($orderdata )){
                    foreach($orderdata as $id => $order){
                        echo "<tr>
                        <td>".$no."</td>
                        <td>".$order['orderId']."</td>
                        <td>".$order['agentId']."</td>
                        <td>".$order['clientAddress']."</td>
                        <td>".'Rs. '.$order['orderValue']."</td>
                        <td>".$order['orderStatus']."</td>
                        ";
                        echo '
                        <td>
                            <a href="printproductlist.php?orderid='.$id.'"><img src="../img/icon/eyeIcon.png" alt=""></a>';
                        if(!($order['orderStatus']=="Delivered")){
                            echo '
                            <a href="printshippinglabel.php?orderid='.$id.'"><img src="../img/icon/pritntIcon.png" alt=""></a>
                            <a href="inventoryorderlist.php?deliveryStatus='.$id.'" class="updateLink"><img src="../img/icon/DeliverIcon.png" alt=""></a>
                        </td>
                    </tr>';
                        }    
                    $no++;
                    }
                }
            }else{
                if(is_array($orderdata )){
                    foreach($orderdata as $id => $order){
                        if((strpos($order['orderId'],$_GET['search'])!== false || 
                        (strpos($order['agentId'],$_GET['search'])!== false ) ||
                        (strpos($order['clientAddress'],$_GET['search'])!== false ) ||
                        strpos($order['orderValue'],$_GET['search'])!== false ) ||
                        strpos($order['orderStatus'],$_GET['search'])!== false){
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$order['orderId']."</td>
                            <td>".$order['agentId']."</td>
                            <td>".$order['clientAddress']."</td>
                            <td>".'Rs. '.$order['orderValue']."</td>
                            <td>".$order['orderStatus']."</td>
                            ";
                            echo '
                            <td>
                            <a href="printproductlist.php?orderid='.$id.'"><img src="../img/icon/eyeIcon.png" alt=""></a>';
                            if(!($order['orderStatus']=="Delivered")){
                                echo '
                                <a href="printshippinglabel.php?orderid='.$id.'"><img src="../img/icon/pritntIcon.png" alt=""></a>
                                <a href="inventoryorderlist.php?deliveryStatus='.$id.'" class="updateLink"><img src="../img/icon/DeliverIcon.png" alt=""></a>
                            </td>
                        </tr>';
                            }
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
<script src="../js/confirmorder.js"></script> 
<script src="../js/navigation.js"></script> 
</body>
</html>

<?php
if(isset($_GET['deliveryStatus'])){
    $result =   $orderobj->updateOrderStatus($_GET['deliveryStatus']);
    if( $result){
        echo '<script>
                    swal("Success!", "Order status updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventoryorderlist.php";
                      });
                  </script>';
       
      }else{
        echo '<script>
                    swal("Failed!", "An error occured while updating the order status!", "error")
                      .then((value) => {
                          window.location.href = "inventoryorderlist.php";
                      });
                  </script>';
      }
}
?>