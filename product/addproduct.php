<?php
// Include database file
include("../php/auth.php");
include '../php/product.php';


if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
}



$productobj = new Product();

$productdescription = "";
$productid = $productobj->generateUniqueID();
$productname = "";
$productprice = "";
$productquantity = "";
$productcategory = "";
$commission = "";
$minquantity = "";
$featured = "";
$action = "submit";
$firebaseID = "";
$buttonText = "Add New Product";

if (isset($_GET['Editproductid'])) {

    $firebaseID = $_GET['Editproductid'];
    $productobjnew = new Product();
    $productEditdata = $productobjnew->DisplayEditData($firebaseID);
    $productid = $productEditdata['productid'];
    $productname = $productEditdata['productname'];
    $productdescription = $productEditdata['productdescription'];
    $productprice = $productEditdata['productprice'];
    $productquantity = $productEditdata['productquantity'];
    $minquantity = $productEditdata['minstocklevel'];
    $productcategory = $productEditdata['categoryname'];
    $commission = $productEditdata['commissionRate'];
    $featured = $productEditdata['featured'];
    $action = "editsubmit";
    $buttonText = "Edit Product";
}

//GET Category List
$categoryList = $productobj->returnCategoryNames();

?>

<!DOCTYPE html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="header">

        <img class="logo-img" src="../img/Frame 164.svg" alt="logo">

        <button class="backbtn" onclick="window.location.href='../product/inventoryProductList.php'">
            <a href="../product/inventoryProductList.php" class="backbtnlink">Back</a>
        </button>
    </div>



    <div class="login-container">


        <div>
            <p class="loginHeader">Add Product</p>
        </div>
        <div class="subHeading">
            Enter Product Details
        </div>

        <form action="" method="POST" onsubmit="return productValidation();">

            <!-- Firebase ID -->
            <input type="hidden" id="custId" name="firebaseID" value="<?php echo $firebaseID ?>">
            <!-- Firebase store image URL -->
            <input type="hidden" id="imgURL" name="imgURL" value="">

            <div class="fieldHeader"> Product ID </div>

            <div>
                <input type="text" placeholder="Enter product Id" class="txtField" value="<?php echo $productid ?>" name="id" readonly>

            </div>

            <div class="fieldHeader">Product Name *</div>
            

            <div>
            <span id="nameError" class="error"></span>
                <input type="text" placeholder="Enter Product name" class="txtField" value="<?php echo $productname ?>" name="name" id="productname">

            </div>

            <div class="fieldHeader">Product Description *</div>
            
            <div>
            <span id="descriptionError" class="error"></span>
            <textarea placeholder="Enter Product description" class="txtArea"  id="productdescription" name="description"><?php echo $productdescription;?></textarea>
            </div>
 
            <div class="fieldHeader"> Product Image *</div>

            <span id="imageError" class="error"></span>
            <div class="passwordContainer">
                <input type="file" id="file" name="file" class="fileInput" hidden onchange="uploadProductImage(event)" accept="image/png, image/jpeg" id="productimage">
                <label for="file" id="eye" class="eye">
                    <img class="eye-icon" src="../img/icon/image.svg" alt="add image">
                </label>
                <div id="fileNameDisplay" class="fileNameDisplay">Upload product image</div>
            </div>
          

                <div class="fieldHeader"> Price (Rs.)*</div>
                <span id="priceError" class="error"></span>
                <div>
                    <input type="text" placeholder="Enter price" class="txtField" value="<?php echo $productprice ?>" name="price" id="price">
                </div>

                <div class="fieldHeader">Category Name *</div>
                <span id="categoryError" class="error"></span>

                <div class="spinner-container">
                    <select type="spinner" class="user-type-select" id="categoryselect" name="categoryname">
                        <option value="" disabled selected>Select Category Name</option>
                        <?php
                        if (!$_GET['Editproductid']) {
                            foreach ($categoryList as $x) {
                                echo '<option value="' . $x . '" >' . $x . '</option>';
                            }
                        } else {
                            foreach ($categoryList as $x) {
                                if ($productcategory == $x) {
                                    echo '<option value="' . $x . '" selected>' . $x . '</option>';
                                } else {
                                    echo '<option value="' . $x . '" >' . $x . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="fieldHeader"> Commission ( % ) *</div>
                <span id="commissionError" class="error"></span>
                <div>
                    <input type="text" placeholder="Enter commision rate ( % )" class="txtField" value="<?php echo $commission ?>" name="commission" id="commission">
                </div>
               
                <div class="fieldHeader"> Stock *</div>
                <span id="stockError" class="error"></span>
                <div>
                    <input type="text" placeholder="Enter Stock count" class="txtField" value="<?php echo $productquantity ?>" name="quantity" id="stock">
                </div>

                <div class="fieldHeader"> Minimum stock level *</div>
                <span id="minStockError" class="error"></span>
                <div>
                    <input type="text" placeholder="Enter Minimum stock level" class="txtField" value="<?php echo $minquantity ?>" name="minstock" id="minstock">
                    
                </div>
                <div class="fieldHeader-tick"> Mark as featured: <input type="checkbox" name="featured" <?php echo $featured == 'Yes' ? 'checked' : ''; ?>></div>
           
                <div>

                    <div class="" id="submitbtn">
                        <button class="btn" name="<?php echo $action ?>"><?php echo $buttonText ?></button>
                    </div>
                    <div class="hidden" id="loadingIMG">
                        <img src="../img/loading.gif" width="80" height="80">
                    </div>
                </div>
        </form>
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
if (isset($_POST['submit'])) {

    $resultinsert = $productobj->insertData($_POST);

    if ($resultinsert) {
        echo '<script> swal("Success!", "New Product added successfully!", "success")
                    .then((value) => {
                        window.location.href = "inventoryProductList.php";
                    });
              </script>';
    } else {
        echo '<script>swal("Failed!", "An error occurred while adding the new product!", "error")
                    .then((value) => {
                        window.location.href = "addproduct.php";
                    });
              </script>';
    }
}

// Similar modifications for the 'editsubmit' block.


if (isset($_POST['editsubmit'])) {

    $resultupdate = $productobj->editProduct($_POST, $_POST['firebaseID']);

    if( $resultupdate){
        echo '<script>
                    swal("Success!", "Product details updated successfully!", "success")
                      .then((value) => {
                          window.location.href = "inventoryProductList.php";
                      });
                  </script>';
       
      }else{
        echo '<script>
                    swal("Failed!", "An error occured while updating product details!", "error")
                      .then((value) => {
                          window.location.href = "addproduct.php";
                      });
                  </script>';
      }
}

?>