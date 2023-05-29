// Account Password Eye
const old_pass_tog = document.querySelector("#toggleoldPassword");
const old_pass = document.querySelector("#old_pass");

old_pass_tog.addEventListener("click", function (e) {
  const type =
    old_pass.getAttribute("type") === "password" ? "text" : "password";
  old_pass.setAttribute("type", type);
  this.classList.toggle("fa-eye");
});

// Account New Password Eye
const togglenewPassword = document.querySelector("#togglenewPassword");
const new_password = document.querySelector("#new_password");

togglenewPassword.addEventListener("click", function (e) {
  const type =
    new_password.getAttribute("type") === "password" ? "text" : "password";
  new_password.setAttribute("type", type);
  this.classList.toggle("fa-eye");
});

// account end
