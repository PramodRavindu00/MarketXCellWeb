<?php
include("../php/auth.php");   // including neccessary backend scripts
include ("../php/offer.php");

if(!isset($_SESSION['email'])){     //ensure a valid login
    header("Location: ../auth/login.php");
}

$offerObj = new Offer();   //initializing object class

$couponid ="";
$offername ="";
$offerdescription ="";
$offervalue ="";
$totalsales= "";
$action ="submit";
$firebaseID = "";

if(isset($_GET['editofferid'])){
    $firebaseID = $_GET['editofferid'];
    $offerObj = new Offer();
    $offerEditdata = $offerObj->DisplayEditData($_GET['editofferid']);
            $couponid = $offerEditdata['couponid'];
            $offername = $offerEditdata['offername'];
            $offerdescription = $offerEditdata['offerdescription'];
            $offervalue = $offerEditdata['offervalue'];
            $totalsales = $offerEditdata['totalsales'];
            $action = "editsubmit";
        }
?>

<!DOCTYPE html>
<head>
    <title>Add Offer</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="header">
        
        <img class="logo-img" src="../img/Frame 164.svg"alt="logo">

        <button class="backbtn" onclick="window.location.href='../admin/adminOffers.php'">
            <a href="../admin/adminOffers.php" class="backbtnlink">Back</a>
        </button>
    </div>




<div class="login-container">

    
        <div>
            <p class="loginHeader" >Add Offer</p>
        </div >
         <div class="subHeading">
            Enter Discount Information
         </div>

    <form  action="addOffer.php"  method="post" onsubmit="return offerValidation();">

    <input type="hidden" id="custId" name="firebaseID" value="<?php echo $firebaseID; ?>">

        <div class="fieldHeader"> Coupon Code *</div>
        <div>   
        <span id="codeError" class="error"></span>            
             <input type="text" placeholder="Enter coupon code" class="txtField" id="code" name="code" value="<?php echo $couponid?>">
                                   
         </div>

         <div class="fieldHeader">Offer Name *</div>  

        <div>
        <span id="nameError" class="error"></span>             
            <input type="text" placeholder="Enter offer name" class="txtField" id="name" name="name" value="<?php echo $offername?>">             
         </div>

         <div class="fieldHeader">Offer Description *</div>  

         <div >
         <span id="descriptionError" class="error"></span>  
            <textarea placeholder="Enter offer description" class="txtArea" id="description" name="description" ><?php echo $offerdescription?></textarea>
        </div>

        <div class="fieldHeader"> Available For (By Total Sales)* <br> Rs. </div>
     
        <div>
        <span id="totalSalesError" class="error"></span>           
             <input type="text" placeholder="Enter total sales value" class="txtField" id="totalsales" name="totalsales" value="<?php echo $totalsales?>"><span id="salesError"></span>                           
         </div>
        <div class="fieldHeader"> Offer Value (%) *</div>
     
        <div> 
        <span id="valueError" class="error"></span>           
             <input type="text" placeholder="Enter offer value" class="txtField" id="value" name="value" value="<?php echo $offervalue?>"><span id="valueError"></span>                           
         </div>
       
         
    <div>
      <button class="btn" name="<?php echo $action?>">Add Offer</button>
    </div>
     </form>
</div>


<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>
<script src="../js/formValidations.js"></script>
</body>
</html>

<?php

if(isset($_POST['submit'])) {
    $resultinsert = $offerObj->insertData($_POST);
    
    if( $resultinsert){
        echo '<script>
                    swal("Success!", "Offer added successfully!", "success")
                      .then((value) => {
                          window.location.href = "adminOffers.php";
                      });
                  </script>';
       
      }else{
        echo '<script>
                    swal("Failed!", "Offer not added successfully!", "error")
                      .then((value) => {
                          window.location.href = "adminOffers.php";
                      });
                  </script>';
      }
}

if(isset($_POST['editsubmit'])) {
    
    $resultedit = $offerObj->editOffer($_POST,$_POST['firebaseID']);
    
    if($resultedit){
        echo '<script>
                    swal("Success!", "Offer details has been updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "adminOffers.php";
                      });
                  </script>';
       
    }else{
        echo '<script>
                    swal("Failed!", "An error occured while updating offer details !", "error")
                      .then((value) => {
                          window.location.href = "adminOffers.php";
                      });
                  </script>';
    }
}

?>