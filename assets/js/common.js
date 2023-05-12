// awal menampilkan password
const passwordInput = document.getElementById("floatingPassword");
console.log("test");
function showPassword() {
  if (passwordInput.type == "password") passwordInput.type = "text";
  else passwordInput.type = "password";
}
// akhir menampilkan password
