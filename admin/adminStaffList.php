<?php

include("../php/auth.php");
include("../php/user.php");

if(!isset($_SESSION['email'])){
    header("Location: ../auth/login.php");
}

$authobj = new Auth();

if(isset($_POST['logout'])){
    $authobj->logout($_POST);
 }

 $userobj = new User();
 $userData = $userobj->displayStaffData();
 
 
 $profilepicture = $_SESSION['profilepicture'];

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Staff List </title>
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
  
        <button class="menu-toggle">&#9776; Admin Menu</button>
        <div class="sub-navbar">
            <ul class="sub-navbar-list">
               <li><img src="../img/product.svg" alt="Product List Icon"><a class="active" href="../admin/adminStaffList.php">Staff User Details</a></li> 
               <li><img src="../img/Category.svg" alt="Category List Icon"><a class="notActive" href="../admin/adminAgentList.php">Agents</a></li> 
               <li><img src="../img/report.svg" alt="Report Icon"><a class="notActive" href="../admin/adminOffers.php">Offers</a></li>  
            </ul>
        </div>
     
        <a href="../admin/adminSettings.php" class="profile-link">
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
    <input type="text" placeholder="Search Staff..." name="search">
</div>
</form>
<button class="addB" onclick="window.location.href='../admin/addUser.php'">
    <a href="../admin/addUser.php" class="addlink">Add Staff</a>
</button>
</div>

<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>User Type</th>
                <th>Address</th>
                <th>Action</th>
                 
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            if(!isset($_GET['search'])|| $_GET['search']===""){
                if(is_array($userData )){
                    foreach($userData as $id => $user){
                        echo "<tr>
                        <td>".$no."</td>
                        <td>".$user['name']."</td>
                        <td>".$user['email']."</td>
                        <td>".$user['phone']."</td>
                        <td>".$user['usertype']."</td>
                        <td>".$user['address']."</td>
                        ";
                        if($user['usertype'] === "inventoryStaff"){
                            echo '
                            <td>
                            <a href="../admin/adminStaffList.php?userid='.$id.'" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
                                </td>';
                        }else{
                            echo '<td>Denied</td>';
                        }
                    echo'</tr>';
                    $no++;
                    }
                }
            }else{
                if(is_array($userData )){
                    foreach($userData as $id => $user){
                        if((
                        strpos($user['name'],$_GET['search'])!== false || 
                        strpos($user['email'],$_GET['search'])!== false ||
                        strpos($user['phone'],$_GET['search'])!== false ||
                        strpos($user['usertype'],$_GET['search'])!== false ||
                        strpos($user['address'],$_GET['search'])!== false)){
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$user['name']."</td>
                            <td>".$user['email']."</td>
                            <td>".$user['phone']."</td>
                            <td>".$user['usertype']."</td>
                            <td>".$user['address']."</td>
                            ";
                            if($user['usertype'] === "inventoryStaff"){
                                echo '
                                <td>
                                <a href="../admin/adminStaffList.php?userid='.$id.'" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
                                    </td>';
                            }else{
                                echo '<td>Denied</td>';
                            }
                           
                        echo'</tr>';
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
<script src="../js/navigation.js"></script> 
<script src="../js/confirmdelete.js"></script>
</body>
</html>

<?php

 if(isset($_GET['userid'])){
    $result = $userobj->deleteUser($_GET['userid']);
   
    if($result){
        echo '<script>
                    swal("Success!", "Staff user account deactivated successfully!", "success")
                      .then((value) => {
                          window.location.href = "../admin/adminStaffList.php";
                      });
                  </script>';
       
    }else{
        echo '<script>
                    swal("Failed!", "An error occured while deactivating the user account!", "error")
                      .then((value) => {
                          window.location.href = "../admin/adminStaffList.php";
                      });
                  </script>';
    }
 };
 
?>

