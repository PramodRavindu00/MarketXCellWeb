<?php
include("../php/auth.php");
include("../php/user.php");

if(!isset($_SESSION['email'])){
    header("Location: ../auth/login.php");
}

if(isset($_POST['logout'])){
    $authobj->logout($_POST);
 }


$authobj = new Auth();
$userobj = new User();


 $agentData = $userobj->displayAgentData();
 $profilepicture = $_SESSION['profilepicture'];  

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Agent List </title>
    <link rel="stylesheet" href="../css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...YOUR_INTEGRITY_HASH_HERE..." crossorigin="anonymous" />
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
         <li><img src="../img/product.svg" alt="Product List Icon"><a class="notActive" href="../admin/adminStaffList.php">Staff User Details</a></li> 
         <li><img src="../img/Category.svg" alt="Category List Icon"><a class="active" href="../admin/adminAgentList.php">Agents</a></li> 
         <li><img src="../img/report.svg" alt="Report Icon"><a class="notActive" href="../admin/adminOffers.php">Offers</a></li>  
      </ul>
  </div>

  <a href="../admin/adminSettings.php" class="profile-link">
      <div class="profile-container">
          <div class="profile-picture">
          <?php
                if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {
                    // displaying profile picture
                    echo '<img src="' . $_SESSION['profilepicture'] . '" alt="Profile Picture">';
                } else {
                    // displaying default profile picture if session variable is not set or empty
                    echo '<img src="../img/defaultprofile.jpg" alt="Default Profile Picture">';
                }
                ?>
          </div>
          <div class="user-name">
                  <?php
                  $username = $_SESSION['username'];  //displaying logged user name
                  echo "$username";
                  ?>
                    <div class="email">
                    <?php
                  $email = $_SESSION['email'];   //displaying logged email
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
    <input type="text" placeholder="Search Agents..." name="search">
</div>
</form>
</div>

<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Agent Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Total Sales</th>
                 
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            if(!isset($_GET['search'])|| $_GET['search']===""){  //display all the details if search bar is empty
                if(is_array($agentData )){
                    foreach($agentData as $id => $agent){
                        echo "<tr>
                        <td>".$no."</td>
                        <td>".$agent['name']."</td>
                        <td>".$agent['email']."</td>
                        <td>".$agent['phone']."</td>
                        <td>".$agent['address']."</td>
                        <td>".'Rs. '.$agent['sales']."</td>
                        ";
                    $no++;
                    }
                }
            }else{
                if(is_array($agentData )){
                    foreach($agentData as $id => $agent){
                        if((
                        strpos($agent['name'],$_GET['search'])!== false || 
                        strpos($agent['email'],$_GET['search'])!== false ||
                        strpos($agent['phone'],$_GET['search'])!== false ||
                        strpos($agent['address'],$_GET['search'])!== false ||
                        strpos($agent['sales'],$_GET['search'])!== false)){
                            echo "<tr>
                            <td>".$no."</td>
                            <td>".$agent['name']."</td>
                            <td>".$agent['email']."</td>
                            <td>".$agent['phone']."</td>
                            <td>".$agent['address']."</td>
                            <td> ".'Rs. '.$agent['sales']."</td>
                            ";
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
</body>

</html>