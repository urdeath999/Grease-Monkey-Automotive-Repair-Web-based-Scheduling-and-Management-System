const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const passwordToggles = document.querySelectorAll('.password-toggle');

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });
  
  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });

  
passwordToggles.forEach(toggle => {
    toggle.addEventListener('click', function () {
        const passwordField = this.previousElementSibling;

        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.querySelector('i').classList.remove("fa-eye");
            this.querySelector('i').classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            this.querySelector('i').classList.remove("fa-eye-slash");
            this.querySelector('i').classList.add("fa-eye");
        }
    });
});
