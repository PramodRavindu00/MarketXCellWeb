<?php

include("../php/auth.php");
include ("../php/category.php");

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}

$authobj = new Auth();

if (isset($_POST['logout'])) {
    $authobj->logout($_POST);
}

$categoryobj = new Category();
$categoryDaya = $categoryobj->displayData();

$profilepicture = $_SESSION['profilepicture'];

?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Category List </title>
    <link rel="stylesheet" href="../css/otherCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="header">
        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">
        <button class="menu-toggle">&#9776; Menu</button>
        <div class="logoutbutton">
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>



    <div class="sub-navbar-container">

        <button class="menu-toggle">&#9776; Inventory Menu</button>
        <div class="sub-navbar">
            <ul class="sub-navbar-list">
                <li> <img src="../img/order.svg" alt="Order List Icon"><a class="notActive" href="../orders/inventoryorderlist.php">Orders</a></li>
                <li><img src="../img/product.svg" alt="Product List Icon"><a class="notActive" href="../product/inventoryProductList.php">Products</a></li>
                <li><img src="../img/Category.svg" alt="Category List Icon"><a class="active" href="../category/inventorycategorylist.php">Categories</a></li>
            </ul>
        </div>

        <a href="../inventorystaff/inventorySettings.php" class="profile-link">
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
                <input type="text" placeholder="Search Categories..." name="search">
            </form>

        </div>

        <button class="addB">
            <a href="addcategory.php" class="addlink">Add Category</a>
        </button>
    </div>



    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $no = 1;
                if (!isset($_GET['search']) || $_GET['search'] === "") {
                    if (is_array($categoryDaya)) {
                        foreach ($categoryDaya as $id => $category) {
                            echo "<tr>
                        <td>" . $no . "</td>
                        <td>" . $category['id'] . "</td>
                        <td>" . $category['name'] . "</td>
                        <td>" . $category['description'] . "</td>
                        ";
                            echo '
                        <td>
                        <a href="addcategory.php?editcategoryid=' . $id . '"><img src="../img/icon/editIcon.png" alt=""></a>
                        <a href="inventorycategoryList.php?categoryid=' . $id . '" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
                        </td>
                    </tr>';
                            $no++;
                        }
                    }
                } else {
                    if (is_array($categoryDaya)) {
                        foreach ($categoryDaya as $id => $category) {
                            if ((strpos($category['id'], $_GET['search']) !== false ||
                                    strpos($category['name'], $_GET['search']) !== false) ||
                                strpos($category['description'], $_GET['search']) !== false
                            ) {
                                echo "<tr>
                            <td>" . $no . "</td>
                            <td>" . $category['id'] . "</td>
                            <td>" . $category['name'] . "</td>
                            <td>" . $category['description'] . "</td>
                            ";
                                echo '
                            <td>
                                <a href="addcategory.php?editcategoryid=' . $id . '"><img src="../img/icon/editIcon.png" alt=""></a>
                                <a href="inventorycategoryList.php?categoryid=' . $id . '" class="deleteLink"><img src="../img/icon/deleteIcon.png" alt=""></a>
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
    <script src="../js/confirmdelete.js"></script>
    <script src="../js/navigation.js"></script>
</body>
</html>

<?php

if (isset($_GET['categoryid'])) {

    $result = $categoryobj->deleteCategory($_GET['categoryid']);

    if ($result) {
        echo '<script>
                    swal("Success!", "Category Deleted successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventorycategoryList.php";
                      });
                  </script>';
    } else {
        echo '<script>
                    swal("Failed!", "An error occured while deleting the category!", "error")
                      .then((value) => {
                          window.location.href = "inventorycategoryList.php";
                      });
                  </script>';
    }
};

?>