<?php
include("../php/firebaseRDB.php");
include ("../php/auth.php");

if (isset($_POST['back'])) {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
}

?>
<!DOCTYPE html>
<head>
    <title>Account Recovery</title>
    <link rel="stylesheet" href="../css/reocveryOne.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
</head>
<body>
    <div class="header">
        
        <img class="logo-img" src="../img/Frame 164.svg"alt="logo">
        

        <button class="backbtn" onclick="window.location.href='../auth/login.php'">
            <a href="../auth/login.php" class="backbtnlink">Back</a>
        </button>
    </div>
</div>



<div class="recov-container">

    
        <div>
            <p class="recovHeader" >Account Recovery</p>
        </div >
         <div class="subHeading">
            Answer the following to verify this account is yours.
         </div>

    <form action="#login.php" method="post" onsubmit="return recoverEmailValidation();">

        <div class="fieldHeader">
         Email
         </div>
     
        <div >     
        <span id="emailError" class="error"></span>          
             <input type="text" placeholder="Enter your email" class="txtField" name="email" id="email">                           
         </div>
         
    <div >
        <button type="submit" class="btn" name="submitemail">Next</button>
        </div>
     </form>
</div>

<div class="copyright">
        
    <p> Copyright © 2023 The MarketXcell

        <br>All Rights Reserved. </p>
</div>

<script src="../js/togglePassword.js"></script>
    <script src="../js/formValidations.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php

 $authobj = new Auth();

 if(isset($_POST['submitemail'])) {

  $result =  $authobj->sumbitEmailToRecover($_POST);

  if($result == "false"){
     echo '<script>swal("Invalid!", "Email not found!", "error");</script>';
  }
  elseif($result == "error"){
    echo '<script>swal("Failed!", "An error occured!", "error");</script>';
  }
 }
 
?>