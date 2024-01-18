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
