<?php
include("../php/firebaseRDB.php");
include("../php/auth.php");
include("../php/settings.php");

$authobj = new Auth();
if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}


if (isset($_POST['back'])) {

    $usertype = $_SESSION['usertype'];

    if ($usertype == "administrator") {
        echo '<script> window.location.href = "../admin/adminSettings.php"; </script>';
    } else if ($usertype == "inventoryStaff") {
        echo '<script> window.location.href = "../inventorystaff/inventorySettings.php"; </script>';
    }
}

$settingsobj = new Settings();
$action = "upload";
$firebaseID = $_SESSION['firebaseid'];
$buttonText = "upload profile picture";

$profilepicture = $_SESSION['profilepicture'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture</title>
    <link rel="stylesheet" href="../css/settings.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...YOUR_INTEGRITY_HASH_HERE..." crossorigin="anonymous" />
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

    <div class="heading">Update your Profile Picture</div>

    <div class="formC">
        <div class="profile-conteiner-a">
            <div class="profile-picture img">
                <?php
                if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {
                    
                    echo '<img src="' . $_SESSION['profilepicture'] . '?t=' . time() . '" alt="Profile Picture">';
                } else {
                   
                    echo '<img src="../img/defaultprofile.jpg" alt="Default Profile Picture">';
                }
                ?>
            </div>

            <form action="" method="POST">

                <input type="hidden" id="custId" name="firebaseID" value="<?php echo  $_SESSION['firebaseid']; ?>">
                <!-- Firebase store image URL -->
                <input type="hidden" id="imgURL" name="imgURL" value="">

                <div class="fieldHeader"> Profile Picture</div>

                <span id="imageError" class="error"></span>

                <div id="fileNameDisplay" class="fileNameDisplay">Upload profile picture</div>
                

                <div class="passwordContainer">
                    <input type="file" id="file" name="file" class="fileInput" hidden onchange="uploadProfilePicture(event)" accept="image/png, image/jpeg" id="productimage">
                    <label for="file" id="eye" class="eye">
                        <img class="eye-icon" src="../img/icon/image.svg" alt="add image">
                    </label>  
                </div>

                <div>
                    <div class="" id="submitbtn">
                        <button class="submitBtn" name="<?php echo $action ?>"><?php echo $buttonText ?> </button>
                    </div>
                </div>
                    
                
                <div>
                    <button type="submit" class="deleteBtn" name="remove">Remove</button>
                </div>
                 <div class="hidden" id="loadingIMG">
                        <img src="../img/loading.gif" width="80" height="80">
                    </div> 
            </form>
        </div>
    </div>
    


    <div class="copyright">

        <p> Copyright © 2023 The MarketXcell

            <br>All Rights Reserved.
        </p>
    </div>

        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
        <script src="../js/imgUpload.js"></script>
        <script src="../js/formValidations.js"></script>

</body>

</html>

<?php

$firebaseID =  $_SESSION['firebaseid'];

if (isset($_POST['upload'])) {
    $resultupload = $settingsobj->updateProfilePicture($_POST, $firebaseID);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['remove'])) {
    $remove = $settingsobj->removeProfilePicture($_POST, $firebaseID);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>