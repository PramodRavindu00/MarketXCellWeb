function togglePassword() {
    const password = document.getElementById("password");
    const eyeIcon = document.querySelector(".eye-icon");

    if (password.type === "password") {
        password.type = "text";
        eyeIcon.classList.add("active");
        eyeIcon.classList.remove("inactive");
    } else {
        password.type = "password";
        eyeIcon.classList.remove("active");
        eyeIcon.classList.add("inactive");
    }
}

function toggleConfirmPassword() {
    const confirmpassword = document.getElementById("confirmpassword");
    const eyeIcon = document.querySelector(".eye-icon-confirm");

    if (confirmpassword.type === "password") {
        confirmpassword.type = "text";
        eyeIcon.classList.add("active");
        eyeIcon.classList.remove("inactive");
    } else {
        confirmpassword.type = "password";
        eyeIcon.classList.remove("active");
        eyeIcon.classList.add("inactive");
    }
}

function toggleCurrentPassword() {
    const confirmpassword = document.getElementById("currentpassword");
    const eyeIcon = document.querySelector(".eye-icon-current");

    if (confirmpassword.type === "password") {
        confirmpassword.type = "text";
        eyeIcon.classList.add("active");
        eyeIcon.classList.remove("inactive");
    } else {
        confirmpassword.type = "password";
        eyeIcon.classList.remove("active");
        eyeIcon.classList.add("inactive");
    }
}
