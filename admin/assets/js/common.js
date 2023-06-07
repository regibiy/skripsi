// show password starts
const passwordInput = document.getElementById("floatingPassword");
function showPassword() {
  if (passwordInput.type == "password") passwordInput.type = "text";
  else passwordInput.type = "password";
}
// show password ends
