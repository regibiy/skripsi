$(document).ready(function () {
  $("#my-registration").DataTable();
});

// show password starts
const passwordInput = document.getElementById("floatingPassword");
function showPassword() {
  if (passwordInput.type == "password") passwordInput.type = "text";
  else passwordInput.type = "password";
}
// show password ends

// dinamis form data keluarga starts
const readData = document.getElementById("read");
const editData = document.getElementById("edit");
const addData = document.getElementById("add");
const btnaddData = document.getElementById("addFamilyMember");
const btnEditData = document.querySelectorAll(".editFamilyMember");

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

addData.style.display = "none";
editData.style.display = "none";

btnaddData.addEventListener("click", () => {
  addData.style.display = "block";
  readData.style.display = "none";
});

btnEditData.forEach((button) => {
  button.addEventListener("click", () => {
    editData.style.display = "block";
    readData.style.display = "none";
    scrollToTop();
  });
});
// dinamis form data keluarga ends
