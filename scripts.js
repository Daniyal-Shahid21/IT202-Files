document.addEventListener("DOMContentLoaded", function() {
  var passwordInput = document.getElementById("pass");

  passwordInput.addEventListener("click", function() {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordInput.classList.add("text-input-style");
    } 
    else {
      passwordInput.type = "password";
      passwordInput.classList.remove("text-input-style");
    }
    });
  });