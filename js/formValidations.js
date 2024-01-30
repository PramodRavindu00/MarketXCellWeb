function registerFormValidation() {
  let name = document.getElementById("name").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let confirmpassword = document.getElementById("confirmpassword").value;
  let number = document.getElementById("number").value;
  let address = document.getElementById("address").value;

  let nameError = document.getElementById("nameError");
  let emailError = document.getElementById("emailError");
  let passwordError = document.getElementById("passwordError");
  let confirmPasswordError = document.getElementById("confirmpasswordError");
  let numberError = document.getElementById("mobileError");
  let addressError = document.getElementById("addressError");

  if (name === "") {
    nameError.textContent = "Name is required";
  } else if (!/^[a-zA-Z]/.test(name)) {
    nameError.textContent = "Name should start with a letter";
  } else if (!/^[a-zA-Z\s]*$/.test(name)) {
    nameError.textContent = "Name should only contain letters";
  } else {
    nameError.textContent = "";
  }

  if (email === "") {
    emailError.textContent = "Email is required";
  } else if (/^\s/.test(email)) {
    emailError.textContent = "Email cannot start with a space";
  } else if (/\s$/.test(email)) {
    emailError.textContent = "Email cannot end with a space";
  } else if (/\s/.test(email)) {
    emailError.textContent = "Email cannot contain any space";
  } else if (!/\S+@\S+\.\S+/.test(email)) {
    emailError.textContent = "Enter a valid email address";
  } else {
    emailError.textContent = "";
  }

  if (password === "") {
    passwordError.textContent = "Password is required";
  } else if (/\s/.test(password)) {
    passwordError.textContent = "Password cannot contain any space";
  }else if (password.length < 8) {
    passwordError.textContent = "Password should be atleast 8 characters long";
  }  else {
    passwordError.textContent = "";
  }

  if (confirmpassword === "") {
    confirmPasswordError.textContent = "Password confirmation is required";
  } else if (/\s/.test(confirmpassword)) {
    confirmPasswordError.textContent = "Password cannot contain any space";
  } else if (confirmpassword != password) {
    passwordError.textContent = "Passwords do not match";
    confirmPasswordError.textContent = "Passwords do not match";
  } else {
    confirmPasswordError.textContent = "";
  }

  if (number === "") {
    numberError.textContent = "Mobile Number is required";
  } else if (/\s/.test(number)) {
    numberError.textContent = "Mobile Number cannot contain any space";
  } else if (!/^\d+$/.test(number)) {
    numberError.textContent =
      "Mobile number should only contain numerical values";
  } else if (!/^0/.test(number)) {
    numberError.textContent =
      "Mobile number should start with a zero ( Eg: 077 / 038 )";
  } else if (number.length !== 10) {
    numberError.textContent =
      "Mobile number should only contains 10 digits exactly";
  } else {
    numberError.textContent = "";
  }

  if (address == "") {
    addressError.textContent = "Address is required";
  } else {
    addressError.textContent = "";
  }

  if (
    nameError.textContent !== "" ||
    emailError.textContent !== "" ||
    passwordError.textContent !== "" ||
    confirmPasswordError.textContent !== "" ||
    numberError.textContent !== "" ||
    addressError.textContent !== ""
  ) {
    return false;
  } else {
    return true;
  }
}

function loginFormValidation(){
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  let emailError = document.getElementById("emailError");
  let passwordError = document.getElementById("passwordError");

  if (email === "") {
    emailError.textContent = "Email is required";
  } else if (/^\s/.test(email)) {
    emailError.textContent = "Email cannot start with a space";
  } else if (/\s$/.test(email)) {
    emailError.textContent = "Email cannot end with a space";
  } else if (/\s/.test(email)) {
    emailError.textContent = "Email cannot contain any space";
  } else if (!/\S+@\S+\.\S+/.test(email)) {
    emailError.textContent = "Enter a valid email address";
  } else {
    emailError.textContent = "";
  }

  if (password === "") {
    passwordError.textContent = "Password is required";
  }else if (/\s/.test(password)) {
    passwordError.textContent = "Password cannot contain any space";
  } else {
    passwordError.textContent = "";
  }

  if (emailError.textContent !== "" || passwordError.textContent !== "" ) 
  {
    return false;
  } else {
    return true;
  }
}

function updateProfileValidation() {

  let name = document.getElementById("name").value;
  let email = document.getElementById("email").value;
  let address = document.getElementById("address").value;
  let number = document.getElementById("mobile").value;
  let question = document.getElementById("questionselect").value;
  let answer = document.getElementById("answer").value;

  let nameError = document.getElementById("nameError");
  let emailError = document.getElementById("emailError");
  let addressError = document.getElementById("addressError");
  let numberError = document.getElementById("numberError");
  let questionError = document.getElementById("questionError");
  let answerError = document.getElementById("answerError");

  if (name === "") {
    nameError.textContent = "Name is required";
  } else if (!/^[a-zA-Z]/.test(name)) {
    nameError.textContent = "Name should start with a letter";
  } else if (!/^[a-zA-Z\s]*$/.test(name)) {
    nameError.textContent = "Name should only contain letters";
  } else {
    nameError.textContent = "";
  }

  if (email === "") {
    emailError.textContent = "Email is required";
  } else if (/^\s/.test(email)) {
    emailError.textContent = "Email cannot start with a space";
  } else if (/\s$/.test(email)) {
    emailError.textContent = "Email cannot end with a space";
  } else if (/\s/.test(email)) {
    emailError.textContent = "Email cannot contain any space";
  } else if (!/\S+@\S+\.\S+/.test(email)) {
    emailError.textContent = "Enter a valid email address";
  } else {
    emailError.textContent = "";
  }

  if (address === "") {
    addressError.textContent = "Address is required";
  } else {
    addressError.textContent = "";
  }

  if (number === "") {
    numberError.textContent = "Mobile Number is required";
  } else if (/\s/.test(number)) {
    numberError.textContent = "Mobile Number cannot contain any space";
  } else if (!/^\d+$/.test(number)) {
    numberError.textContent =
      "Mobile number should only contain numerical values";
  } else if (!/^0/.test(number)) {
    numberError.textContent =
      "Mobile number should start with a zero ( Eg: 077 / 038 )";
  } else if (number.length !== 10) {
    numberError.textContent =
      "Mobile number should only contain 10 digits exactly";
  } else {
    numberError.textContent = "";
  }

  if (question === "") {
    questionError.textContent = "Security Question must be selected";
  } else {
    questionError.textContent = "";
  }

  if (answer === "") {
    answerError.textContent = "Answer is required";
  } else {
    answerError.textContent = "";
  }

  if (
    nameError.textContent !== "" ||
    emailError.textContent !== "" ||
    addressError.textContent !== "" ||
    numberError.textContent !== "" ||
    questionError.textContent !== "" ||
    answerError.textContent !== ""
  ) {
    return false;
  } else {
    return true;
  }
}


function passwordChangeValidation() {
  let currentpassword = document.getElementById("currentpassword").value;
  let newPassword = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirmpassword").value;

  let currentPasswordError = document.getElementById("currentPasswordError");
  let newPasswordError = document.getElementById("NewPasswordError");
  let confirmPasswordError = document.getElementById("confirmPasswordError");

  if (currentpassword === "") {
    currentPasswordError.textContent = "Password is required";
  } else if (/\s/.test(currentpassword)) {
    currentPasswordError.textContent = "Password cannot contain any space";
  } else {
    currentPasswordError.textContent = "";
  }

  if (newPassword === "") {
    newPasswordError.textContent = "Password is required";
  } else if (/\s/.test(newPassword)) {
    newPasswordError.textContent = "Password cannot contain any space";
  }  else if (newPassword.length < 8) {
    newPasswordError.textContent = "Password should be at least 8 characters long";
  }else if (currentpassword === newPassword) {
    newPasswordError.textContent = "New Password cannot be the same as the current password";
  } else {
    newPasswordError.textContent = "";
  }

  if (confirmPassword === "") {
    confirmPasswordError.textContent = "Password confirmation is required";
  } else if (/\s/.test(confirmPassword)) {
    confirmPasswordError.textContent = "Password cannot contain any space";
  } else if (confirmPassword !== newPassword) {
    newPasswordError.textContent = "Passwords do not match";
    confirmPasswordError.textContent = "Passwords do not match";
  } else {
    confirmPasswordError.textContent = "";
  }

  if (currentPasswordError.textContent !== "" || newPasswordError.textContent !== "" || confirmPasswordError.textContent !== "") {
    return false;
  } else {
    return true;
  }
}

function offerValidation() {
  let code = document.getElementById("code").value;
  let name = document.getElementById("name").value;
  let description = document.getElementById("description").value;
  let totalsales = document.getElementById("totalsales").value;
  let value = document.getElementById("value").value;

  let codeError = document.getElementById("codeError");
  let nameError = document.getElementById("nameError");
  let descriptionError = document.getElementById("descriptionError");
  let totalSalesError = document.getElementById("totalSalesError");
  let valueError = document.getElementById("valueError");  // Fix the variable name here

  if (code === "") {
      codeError.textContent = "Coupon code is required";
  } else if (/\s/.test(code)) {
      codeError.textContent = "Coupon code cannot contain any space";
  } else {
      codeError.textContent = "";
  }

  if (name === "") {
      nameError.textContent = "Offer name is required";
  } else {
      nameError.textContent = "";
  }

  if (description === "") {
      descriptionError.textContent = "Offer description is required";
  } else {
      descriptionError.textContent = "";
  }

  if (totalsales === "") {
      totalSalesError.textContent = "Total sales value is required";
  } else if (/\s/.test(totalsales)) {
      totalSalesError.textContent = "Total sales value cannot contain any space";
  } else if (!/^\d+$/.test(totalsales)) {
      totalSalesError.textContent = "Total sales value should only contain numerical values";
  } else {
      totalSalesError.textContent = "";
  }

  if (value === "") {
      valueError.textContent = "Offer value is required";
  } else if (/\s/.test(value)) {
      valueError.textContent = "Offer value cannot contain any space";
  } else if (!/^\d+$/.test(value)) {
      valueError.textContent = "Offer value should only contain numerical values";
  } else {
      valueError.textContent = "";
  }

  if (
      codeError.textContent !== "" ||
      nameError.textContent !== "" ||
      descriptionError.textContent !== "" ||
      totalSalesError.textContent !== "" ||
      valueError.textContent !== ""
  ) {
      return false;
  } else {
      return true;
  }
}

function recoverEmailValidation(){
  let email = document.getElementById("email").value;
  let emailError = document.getElementById("emailError");

  if (email === "") {
    emailError.textContent = "Email is required";
  } else if (/^\s/.test(email)) {
    emailError.textContent = "Email cannot start with a space";
  } else if (/\s$/.test(email)) {
    emailError.textContent = "Email cannot end with a space";
  } else if (/\s/.test(email)) {
    emailError.textContent = "Email cannot contain any space";
  } else if (!/\S+@\S+\.\S+/.test(email)) {
    emailError.textContent = "Enter a valid email address";
  } else {
    emailError.textContent = "";
  }

  if (emailError.textContent !== ""){
    return false;
  }
  else{
    return true;
  }

}



function accountVerifyValidation(){
  let question = document.getElementById("questionselect").value;
  let answer = document.getElementById("answer").value;


  let questionError = document.getElementById("questionError");
  let answerError = document.getElementById("answerError");

  if (question === "") {
    questionError.textContent = "Security Question must be selected";
  } else {
    questionError.textContent = "";
  }

  if (answer === "") {
    answerError.textContent = "Answer is required";
  } else {
    answerError.textContent = "";
  }

  if (questionError.textContent !== "" || answerError.textContent !== "" ){
    return false;
  }
  else{
    return true;
  }

}

function resetPasswordvalidatin(){
  let password = document.getElementById("password").value;
  let confirmpassword = document.getElementById("confirmpassword").value;


  let passwordError = document.getElementById("passwordError");
  let confirmPasswordError = document.getElementById("confirmpasswordError");

  if (password === "") {
    passwordError.textContent = "Password is required";
  }
  else if (/\s/.test(password)) {
    passwordError.textContent = "Password cannot contain any space";
  } else if (password.length < 8) {
    passwordError.textContent = "Password should be atleast 8 characters long";
  }  else {
    passwordError.textContent = "";
  }

  if (confirmpassword === "") {
    confirmPasswordError.textContent = "Password confirmation is required";
  } else if (/\s/.test(confirmpassword)) {
    confirmPasswordError.textContent = "Password cannot contain any space";
  } else if (confirmpassword != password) {
    passwordError.textContent = "Passwords do not match";
    confirmPasswordError.textContent = "Passwords do not match";
  } else {
    confirmPasswordError.textContent = "";
  }

  if (passwordError.textContent !== "" || confirmPasswordError.textContent !== "" ){
    return false;
  }
  else{
    return true;
  }
}

function productValidation(){
  let productname = document.getElementById("productname").value;
  let productdescription = document.getElementById("productdescription").value;
  //let productimage = document.getElementById("productimage").value;
  let price = document.getElementById("price").value;
  let categoryselect = document.getElementById("categoryselect").value;
  let commission = document.getElementById("commission").value;
  let stock = document.getElementById("stock").value;
  let minstock = document.getElementById("minstock").value;

  let nameError = document.getElementById("nameError");
  let descriptionError = document.getElementById("descriptionError");
  //let imageError = document.getElementById("imageError");
  let priceError = document.getElementById("priceError");
  let categoryError = document.getElementById("categoryError");
  let commissionError = document.getElementById("commissionError");
  let stockError = document.getElementById("stockError");
  let minStockError = document.getElementById("minStockError");

  if (productname === "") {
    nameError.textContent = "Product name is required";
  } else if (/^\s/.test(productname)) {
    nameError.textContent = "Product name cannot start with a space";
  } else if (/\s$/.test(productname)) {
    nameError.textContent = "Product name cannot end with a space";
  }
  else{
    nameError.textContent = "";
  }

  if (productdescription === "") {
    descriptionError.textContent = "Product description is required";
  } else if (/^\s/.test(productdescription)) {
    descriptionError.textContent = "Product description cannot start with a space";
  } else if (/\s$/.test(productdescription)) {
    descriptionError.textContent = "Product description cannot end with a space";
  }
  else{
    descriptionError.textContent = "";
  }

  // if (productimage === "") {
  //   imageError.textContent = "Product image is required";
  // }
  // else{
  //   imageError.textContent = "";
  // }

if (price === "") {
    priceError.textContent = "Price is required";
} else if (/\s/.test(price)) {
  priceError.textContent = "Price cannot contain any space";
} else if (!/^\d+(\.\d+)?$/.test(price)) {
  priceError.textContent = "Price should be a number ( Eg: 150 / 150.99 )";
} else {
  priceError.textContent = "";
}

if (categoryselect === "") {
  categoryError.textContent = "Category should be selected";
}
else{
  categoryError.textContent = "";
}

if (commission === "") {
  commissionError.textContent = "Commision rate is required";
} else if (/\s/.test(commission)) {
  commissionError.textContent = "Commision rate cannot contain any space";
} else if (!/^\d+(\.\d+)?$/.test(commission)) {
  commissionError.textContent = "Commision rate should be a number";
} else {
  commissionError.textContent = "";
}

if (stock === "") {
  stockError.textContent = "Quantity is required";
} else if (/\s/.test(stock)) {
  stockError.textContent = "Quantity cannot contain any space";
} else if (!/^\d+$/.test(stock)) {
  stockError.textContent = "Quantity should be a number";
} else {
  stockError.textContent = "";
}

if (minstock === "") {
  minStockError.textContent = "Minimum stock value is required";
} else if (/\s/.test(minstock)) {
  minStockError.textContent = "Minimum stock value cannot contain any space";
} else if (!/^\d+$/.test(minstock)) {
  minStockError.textContent = "Minimum stock value should be a number";
} else if(parseInt(stock) < parseInt(minstock)){
  minStockError.textContent = "Minimum stock value must be less than the current stock";
}
else {
  minStockError.textContent = "";
}

if (
  nameError.textContent !== "" ||
  descriptionError.textContent !== "" ||
  //imageError.textContent !== "" ||
  priceError.textContent !== "" ||
  categoryError.textContent !== "" ||
  commissionError.textContent !== "" ||
  stockError.textContent !== "" ||
  minStockError.textContent !== "" 
) {
  return false;
} else {
  return true;
}
}

function categoryValidation(){
  let categoryname = document.getElementById("categoryname").value;
  let categorydescription = document.getElementById("categorydescription").value;


  let nameError = document.getElementById("nameError");
  let descriptionError = document.getElementById("descriptionError");

  if (categoryname === "") {
    nameError.textContent = "Category name is required";
  } else if (/^\s/.test(categoryname)) {
    nameError.textContent = "Category name cannot start with a space";
  } else if (/\s$/.test(categoryname)) {
    nameError.textContent = "Category name cannot end with a space";
  }
  else{
    nameError.textContent = "";
  }
  if (categorydescription === "") {
    descriptionError.textContent = "Category description is required";
  } else if (/^\s/.test(categorydescription)) {
    descriptionError.textContent = "Category description cannot start with a space";
  } else if (/\s$/.test(categorydescription)) {
    descriptionError.textContent = "Category description cannot end with a space";
  }
  else{
    descriptionError.textContent = "";
  }

  if (nameError.textContent !== "" || descriptionError.textContent !== "" ){
    return false;
  }
  else{
    return true;
  }

}


