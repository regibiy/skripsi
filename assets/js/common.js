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

// validasi form daftar starts
const alertP = document.getElementById("alert");
const inputKk = document.getElementById("noKk");
const inputNik = document.getElementById("nik");
const inputJK = document.getElementById("jenisKelamin");
const inputAgama = document.getElementById("agama");
const inputNoHp = document.getElementById("noHp");
const inputRt = document.getElementById("rt");
const inputRw = document.getElementById("rw");
alertP.style.display = "none";

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

function alertError($message) {
  alertP.innerHTML = $message;
  alertP.style.display = "block";
  scrollToTop();
}

function validasiForm() {
  let noKk, nik, valid;
  valid = false;
  noKk = inputKk.value;
  nik = inputNik.value;
  noHp = inputNoHp.value;
  rt = inputRt.value;
  rw = inputRw.value;
  jk = inputJK.value;
  agama = inputAgama.value;

  if ((noKk.length >= 1 && noKk.length < 16) || noKk.length > 16) {
    alertError("Sesuaikan Nomor KK Anda! Nomor KK memiliki panjang 16 angka");
  } else if ((nik.length >= 1 && nik.length < 16) || nik.length > 16) {
    alertError("Sesuaikan NIK Anda! NIK memiliki panjang 16 angka");
  } else if (jk === "---") {
    alertError("Silakan pilih jenis kelamin Anda");
  } else if (agama === "---") {
    alertError("Silakan pilih agama Anda");
  } else if (noHp.length > 15) {
    alertError("Nomor HP hanya dapat menyimpan 15 angka");
  } else if (rt.length > 5 || rw.length > 5) {
    alertError("RT dan RW hanya dapat menyimpan 5 angka");
  } else {
    valid = true;
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
