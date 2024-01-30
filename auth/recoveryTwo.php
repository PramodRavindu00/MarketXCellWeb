<?php

include("../php/firebaseRDB.php");
include ("../php/auth.php");

if(!isset($_SESSION['idfromemailsubmit'])){
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
        

        <button class="backbtn" onclick="window.location.href='../auth/recoveryOne.php'">
            <a href="../auth/recoveryOne.php" class="backbtnlink">Back</a>
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

    <form action="" class="formR" method="post" onsubmit="return accountVerifyValidation();">

        <div class="fieldHeader-e">Select Your Security Question *</div>
        <span id="questionError" class="error"></span> 
                <div class="spinner-container">
                    <select class="user-type-select" name="question" id="questionselect">
                        <option value="" selected disabled>Select your security Question</option>
                        <option value="question1">What was the name of your first childhood friend?</option>
                        <option value="question2">What was the name of your first school teacher?</option>
                        <option value="question3">In which area of the city is your place of work located?</option>
                        <option value="question4">In what city did you meet your spouse/significant other?</option>
                        <option value="question5">In what city or town did your mother and father meet?</option>
                        
                    </select>
                </div>

                <div class="fieldHeader-e">Answer *</div>  

                <div >    
                <span id="answerError" class="error"></span>            
                    <input type="text" placeholder="Answer for security question" class="txtField-e" name="answer" id="answer">               
                </div>
     
                <div >
                    <button type="submit" class="btn-e" name="verify">Next</button>
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

 if(isset($_POST['verify'])) {

  $result =  $authobj->verifyAccount($_POST, $_SESSION['idfromemailsubmit']);

  if($result == "false"){
     echo '<script>swal("Verification Failed!", "Cannot verify its you!", "error");</script>';
  }
  elseif($result == "error"){
    echo '<script>swal("Failed!", "An error occured!", "error");</script>';
  }
 }

?>