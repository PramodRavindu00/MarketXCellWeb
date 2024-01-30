<?php

include("../php/firebaseRDB.php");
include("../php/auth.php");
include("../php/offer.php");

$authobj = new Auth(); //initialaizing Auth class

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}

if (isset($_POST['logout'])) {
    $authobj->logout($_POST);
}


$offerobj = new Offer();   //initialaizing Offer class
$offerData = $offerobj->displayData();

$profilepicture = $_SESSION['profilepicture'];

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Offers</title>

    <link rel="stylesheet" href="../css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...YOUR_INTEGRITY_HASH_HERE..." crossorigin="anonymous" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div class="header">
        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">

        <div class="logoutbutton">
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>



    <div class="sub-navbar-container">

        <button class="menu-toggle">&#9776; Admin Menu</button>
        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li><img src="../img/product.svg" alt="Product List Icon"><a class="notActive" href="../admin/adminStaffList.php">Staff User Details</a></li>
                <li><img src="../img/Category.svg" alt="Category List Icon"><a class="notActive" href="../admin/adminAgentList.php">Agents</a></li>
                <li><img src="../img/report.svg" alt="Report Icon"><a class="active" href="../admin/adminOffers.php">Offers</a></li>
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
                <input type="text" placeholder="Search Offers..." name="search">
            </div>
        </form>
        <button class="addB" onclick="window.location.href='addOffer.php'">
            <a href="addOffer.php" class="addlink">Create Offer</a>
        </button>
    </div>



    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Coupon Code</th>
                    <th>Offer Name</th>
                    <th>Offer Description</th>
                    <th>Available For<br>(By Total Sales)</th>
                    <th>Offer Value (%)</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                if (!isset($_GET['search']) || $_GET['search'] === "") {
                    if (is_array($offerData)) {
                        foreach ($offerData as $id => $offer) {
                            echo "<tr>
                        <td>" . $no . "</td>
                        <td>" . $offer['couponid'] . "</td>
                        <td>" . $offer['offername'] . "</td>
                        <td>" . $offer['offerdescription'] . "</td>
                        <td>" . 'Rs. ' . $offer['totalsales'] . "</td>
                        <td>" . $offer['offervalue'] . '%' . "</td>
                        ";
                            echo '
                        <td>
                        <a href="../admin/addOffer.php?editofferid=' . $id . '" class="editlink"><img src="../img/icon/editIcon.png" alt="edit"></a>
                        <a href="../admin/adminOffers.php?offerid=' . $id . '" class="deleteLink"><img src="../img/icon/deleteIcon.png"  alt="delete"></a>
                    </td>
                    </tr>';
                            $no++;
                        }
                    }
                } else {
                    if (is_array($offerData)) {
                        foreach ($offerData as $id => $offer) {
                            if ((strpos($offer['couponid'], $_GET['search']) !== false ||
                                    strpos($offer['offername'], $_GET['search']) !== false) ||
                                strpos($offer['offerdescription'], $_GET['search']) !== false
                            ) {
                                echo "<tr>
                        <td>" . $no . "</td>
                        <td>" . $offer['couponid'] . "</td>
                        <td>" . $offer['offername'] . "</td>
                        <td>" . $offer['offerdescription'] . "</td>
                        <td>" . 'Rs. ' . $offer['totalsales'] . "</td>
                        <td>" . $offer['offervalue'] . '%' . "</td>
                        ";
                                echo '
                        <td>
                            <a href="../admin/addOffer.php?editofferid=' . $id . '" class="editlink"><img src="../img/icon/editIcon.png" alt="edit"></a>
                            <a href="../admin/adminOffers.php?offerid=' . $id . '" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt="delete"></a>
                        </td>
                    </tr>';
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

            <br>All Rights Reserved.
        </p>
    </div>

    <script src="../js/navigation.js"></script>
    <script src="../js/confirmdelete.js"></script>
</body>

</html>


<?php

$offerObj = new Offer();
if (isset($_GET['offerid'])) {

    $delete = $offerObj->deleteOffer($_GET['offerid']);

    if ($delete) {
        echo '<script>
                    swal("Success!", "Offer deleted successfully!", "success")
                      .then((value) => {
                          window.location.href = "../admin/adminOffers.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while deleting the offer!", "error")
                      .then((value) => {
                          window.location.href = "../admin/adminOffers.php";
                      });
                  </script>';
    }
}

?>