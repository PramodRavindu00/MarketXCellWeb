<?php

include("../php/firebaseRDB.php");
include ("../php/auth.php");

if(!isset($_SESSION['idfromemailsubmit'])){
    header("Location: ../auth/login.php");
}

?>

<!DOCTYPE html>

<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
</head>

<body>
    <div class="header">

        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">

        <button class="backbtn" onclick="window.location.href='../auth/recoveryTwo.php'">
            <a href="../auth/recoveryTwo.php" class="backbtnlink">Back</a>
        </button>
    </div>
    </div>



    <div class="login-container">


        <div>
            <p class="loginHeader">Create New Password</p>
        </div>
        <div class="subHeading">
            Your new password must be unique from those previously used.
        </div>


        <form action="#login.php" method="post" onsubmit="return resetPasswordvalidatin();">

            <div class="fieldHeader">Password</div>
            <div>
                <span id="passwordError" class="error"></span>
                <div class="passwordContainer">
                    <input type="password" id="password" class="password-input" name="password" placeholder="Enter user password">
                    <div id="eye" class="eye" onclick="togglePassword()">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="fieldHeader">Confirm Password</div>
            <div>
                <span id="confirmpasswordError" class="error"></span>
                <div class="passwordContainer">
                    <input type="password" id="confirmpassword" class="password-input" name="password" placeholder="Confirm the password">
                    <div id="eyeconfirm" class="eye" onclick="toggleConfirmPassword()">
                        <svg class="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                        </svg>
                    </div>
                </div>
            </div>
            <button class="btn" name="submit">Reset Password</button>

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

 $authobj = new Auth();

 if(isset($_POST['submit'])) {

  $result =  $authobj->resetPassword($_POST, $_SESSION['idfromemailsubmit']);

  if($result){
    echo'<script> swal({
        title: "Success!",
        text: "Password changed successfully! You have to login again",
        icon: "success",
        button: false
    });</script>';
  }
  else{
    echo'<script> swal({
        title: "Failed!",
        text: "An error occured while resetting the password. Ridirecting to login page",
        icon: "error",
        button: false
    });</script>';
  }
 }
 
?>