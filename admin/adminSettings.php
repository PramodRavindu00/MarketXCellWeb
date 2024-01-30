<?php
include("../php/firebaseRDB.php");
include("../php/auth.php");
include("../php/settings.php");

$authobj = new Auth();

if (isset($_POST['logout'])) {
    $authobj->logout($_POST);
}

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
} else {

    $settingsobj = new Settings();
    $currentprofiledetails = $settingsobj->displayProfile($_SESSION['firebaseid']);
    $name = $currentprofiledetails['name'];
    $email = $currentprofiledetails['email'];
    $phone = $currentprofiledetails['phone'];
    $address = $currentprofiledetails['address'];
    $question = $currentprofiledetails['securityquestion'];
    $answer = $currentprofiledetails['answer'];
}

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>

    <link rel="stylesheet" href="../css/settings.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <div class="sub-navbar-container">
        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><img src="../img/product.svg" alt="Product List Icon"><a class="notActive" href="../admin/adminStaffList.php">Staff User Details</a></li>
                <li><img src="../img/Category.svg" alt="Category List Icon"><a class="notActive" href="../admin/adminAgentList.php">Agents</a></li>
                <li><img src="../img/report.svg" alt="Report Icon"><a class="notActive" href="../admin/adminOffers.php">Offers</a></li>
            </ul>
        </div>
        <div class="logoutbutton">
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>



    <div>
        <button class="btnPWChange" onclick="window.location.href='../auth/changePassword.php'">
            <a class="btnlink" href="../auth/changePassword.php">Change Password</a>
        </button>
    </div>

    <div class="heading">Update your Profile</div>




    <div class="dd">
        <div class="profile-conteiner">
            <div class="profile-picture img">

                <?php
                if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {

                    echo '<img src="' . $_SESSION['profilepicture'] . '" alt="Profile Picture">';
                } else {

                    echo '<img src="../img/defaultprofile.jpg" alt="Default Profile Picture">';
                }
                ?>



            </div>
            <button class="btnP" onclick="window.location.href='../settings/changeProfilePicture.php'">
                <a class="btnlink" href="../settings/changeProfilePicture.php">Edit Profile Picture</a>
            </button>
        </div>

        <form action="" method="post" onsubmit="return updateProfileValidation();">
            <div class="aa-conteiner">
                <div class="vv-conteiner">
                    <div class="field-conteiner">
                        <input type="hidden" id="firebaseid" name="firebaseID" value="<?php echo $_SESSION['firebaseid'] ?>">

                        <div class="fieldHeader"> Name </div>

                        <div>
                            <span id="nameError" class="error"></span>
                            <input type="text" class="txtField" name="name" id="name" value="<?php echo $name ?>">
                        </div>

                        <div class="fieldHeader">Address
                        </div>

                        <div>
                            <span id="addressError" class="error"></span>
                            <input type="text" class="txtField" name="address" id="address" value="<?php echo $address ?>">
                        </div>

                    </div>

                    <div class="field-conteiner">
                        <div class="fieldHeader"> Email </div>

                        <div>
                            <span id="emailError" class="error"></span>
                            <input type="text" class="txtField" name="email" id="email" value="<?php echo $email ?>">
                        </div>

                        <div class="fieldHeader">Mobile Number</div>

                        <div>
                            <span id="numberError" class="error"></span>
                            <input type="text" class="txtField" name="mobile" id="mobile" value="<?php echo $phone ?>">
                        </div>

                    </div>
                </div>
            </div>

            <div class="fieldHeader-e">Select Security Question</div>
            <span id="questionError" class="error"></span>
            <div class="spinner-container">

                <select class="questionselect" name="question" id="questionselect">
                    <?php

                    $securityQuestions = [   //displaying security questions as an array
                        "" => "Select a security question from below list",
                        "question1" => "What was the name of your first childhood friend?",
                        "question2" => "What was the name of your first school teacher?",
                        "question3" => "In which area of the city is your place of work located?",
                        "question4" => "In what city did you meet your spouse/significant other?",
                        "question5" => "In what city or town did your mother and father meet?",
                    ];

                    foreach ($securityQuestions as $key => $value) {
                        $selected = ($key == $question) ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="fieldHeader-e">Answer</div>

            <div>
                <span id="answerError" class="error"></span>
                <input type="text" placeholder="Answer for security question" class="txtField-e" name="answer" id="answer" value="<?php echo $answer ?>">
            </div>

            <div class="updatebutton">

                <input type="submit" name="updateprofile" id="updateprofile" value="Update Profile">
            </div>
        </form>
    </div>


    <div class="copyright">

        <p> Copyright © 2023 The MarketXcell

            <br>All Rights Reserved.
        </p>
    </div>
    <script src="../js/formValidations.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

<?php

if (isset($_POST['updateprofile'])) {

    $result = $settingsobj->updateProfile($_POST, $_SESSION['firebaseid']);  //calling update function

    if ($result) {
        echo '<script>swal("Success!", "Profile details updated successfully!", "success");</script>';
        echo "<meta http-equiv='refresh' content='2'>";
    } else {
        echo '<script>swal("Failed!", "Updating profile details has been failed!", "error");</script>';
    }
}

?>