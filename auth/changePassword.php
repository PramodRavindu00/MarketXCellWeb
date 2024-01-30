<?php

include("../php/firebaseRDB.php");
include("../php/auth.php");
include("../php/settings.php");

$authobj = new Auth();

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}


if (isset($_POST['back'])) {

    $usertype= $_SESSION['usertype'];

    //checking user type of the logged user to redirect with their relevent settings pages
   if($usertype == "administrator"){
    echo '<script> window.location.href = "../admin/adminSettings.php"; </script>';
   }
   else if($usertype == "inventoryStaff"){
    echo '<script> window.location.href = "../inventorystaff/inventorySettings.php"; </script>';
   }
}

?>

<!DOCTYPE html>

<head>
    <title>Change password</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

</head>

<body>
    <div class="header">

        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">
       
        <form action="" method="post">
            <div class="backbtn">
                <input type="submit" id="back" name="back" value="Back to Settings" class="backbtn">
            </div>
        </form>


       
    </div>
  


    <div class="login-container">


        <div>
            <p class="loginHeader">Change Password</p>
        </div>

        <form action="" method="post" onsubmit="return passwordChangeValidation();">

            <div class="fieldHeader"> Current Password</div>
            <span id="currentPasswordError" class="error"></span>
            <div class="passwordContainer">
                <input type="password" id="currentpassword" name="currentpassword" class="password-input" placeholder="Enter your current password">
                <div id="eye" class="eye" onclick="toggleCurrentPassword()">

                    <svg class="eye-icon-current" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                        <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                    </svg>
                </div>
            </div>

            <div class="fieldHeader">New Password</div>
            <span id="NewPasswordError" class="error"></span>
            <div class="passwordContainer">
                <input type="password" id="password" name="newpassword" class="password-input" placeholder="Enter new password">
                <div id="eye" class="eye" onclick="togglePassword()">

                    <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                        <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                    </svg>
                </div>
            </div>

            <div class="fieldHeader">Confirm New Password</div>
            <span id="confirmPasswordError" class="error"></span>
            <div class="passwordContainer">
                <input type="password" id="confirmpassword" name="confirmpassword" class="password-input" placeholder="Confirm new password">
                <div id="eye" class="eye" onclick="toggleConfirmPassword()">

                    <svg class="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                        <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                    </svg>
                </div>
            </div>


            <div class="changebutton">
                <input type="submit" value="Change Password" name="change">
            </div>
        </form>
    </div>


    <div class="copyright">

        <p> Copyright © 2023 The MarketXcell

            <br>All Rights Reserved.
        </p>
    </div>

    <script src="../js/togglePassword.js"></script>
    <script src="../js/formValidations.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['change'])){
    $result = $authobj->changePassword($_POST, $_SESSION['firebaseid']);
    
    if($result == "changed"){

        echo'<script> swal({
            title: "Success!",
            text: "Password changed successfully! You have to login again",
            icon: "success",
            button: false
        });</script>';

        session_unset();    
      session_destroy();     //clearing all the sessions
      
      echo '<script>
      setTimeout(function() {
          window.location.href = "../auth/login.php";
      }, 2000);
      </script>';
        
    }
    elseif($result == "failed"){
        echo '<script>swal("Failed!", "Failed to change the password!", "error");</script>';
    }
    elseif($result == "incorrect"){
        echo '<script>swal("Incorrect!", "Current password is incorrect!", "error");</script>';
    }
}

?>