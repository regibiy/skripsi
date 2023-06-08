$(document).ready(function () {
  $("#my-registration").DataTable();
});

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

// show password starts
const passwordInput = document.getElementById("floatingPassword");
function showPassword() {
  if (passwordInput.type == "password") passwordInput.type = "text";
  else passwordInput.type = "password";
}
// show password ends

// validasi form daftar starts
const alertP = document.getElementById("alert");
alertP.style.display = "none";

function validasiForm() {
  const btnDaftar = document.getElementById("daftar");
  const inputKk = document.getElementById("noKk");
  let noKk, nik, valid;
  valid = false;
  noKk = inputKk.value.trim();
  if ((noKk.length >= 1 && noKk.length <= 16) || noKk.length >= 16) {
    alertP.innerHTML = "Sesuaikan nomor KK Anda! nomor KK memiliki panjang 16 angka";
    alertP.style.display = "block";
    scrollToTop();
    valid = false;
  } else if (nik.length <= 16 || nik.length >= 16) {
    alertP.innerHTML = "Sesuaikan NIK Anda! NIK memiliki panjang 16 angka";
  }

  if (valid === false) {
    return false;
  } else {
    return true;
  }
}
// validasi form daftar ends

// dinamis form data keluarga starts SCRIPT DIBAWAH SEMENTARA
// const readData = document.getElementById("read");
// const editData = document.getElementById("edit");
// const addData = document.getElementById("add");
// const btnaddData = document.getElementById("addFamilyMember");
// const btnEditData = document.querySelectorAll(".editFamilyMember");

// addData.style.display = "none";
// editData.style.display = "none";

// btnaddData.addEventListener("click", () => {
//   addData.style.display = "block";
//   readData.style.display = "none";
// });

// btnEditData.forEach((button) => {
//   button.addEventListener("click", () => {
//     editData.style.display = "block";
//     readData.style.display = "none";
//     scrollToTop();
//   });
// });
// dinamis form data keluarga ends
