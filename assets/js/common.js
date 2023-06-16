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

function validasiFormDaftar() {
  let noKk, nik, valid;
  valid = false;
  noKk = inputKk.value;
  nik = inputNik.value;
  noHp = inputNoHp.value;
  rt = inputRt.value;
  rw = inputRw.value;
  jk = inputJK.value;
  agama = inputAgama.value;

  if ((noKk.length >= 1 && noKk.length < 16) || noKk.length > 16) alertError("Sesuaikan Nomor KK Anda! Nomor KK memiliki panjang 16 angka");
  else if ((nik.length >= 1 && nik.length < 16) || nik.length > 16) alertError("Sesuaikan NIK Anda! NIK memiliki panjang 16 angka");
  else if (jk === "---") alertError("Silakan pilih jenis kelamin Anda");
  else if (agama === "---") alertError("Silakan pilih agama Anda");
  else if (noHp.length > 15) alertError("Nomor HP hanya dapat menyimpan 15 angka");
  else if (rt.length > 5 || rw.length > 5) alertError("RT dan RW hanya dapat menyimpan 5 angka");
  else valid = true;

  if (!valid) return false;
  else {
    let confirmMsg = "Pastikan TIDAK ada data yang keliru. Cek data sekali lagi?";
    if (confirm(confirmMsg) === true) {
      alertP.style.display = "none";
      scrollToTop();
      return false;
    } else return true;
  }
}
// validasi form daftar ends

// membatasi tanggal ruang poly starts
const registerDateInput = document.getElementById("registerDate");

function addDays(date, days) {
  let result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
}

if (registerDateInput) {
  let maxDate = addDays(new Date(), 7).toISOString().split("T")[0];
  registerDateInput.setAttribute("min", new Date().toISOString().split("T")[0]);
  registerDateInput.setAttribute("max", maxDate);
}

function validasiTanggalDaftar() {
  let valid;
  valid = false;
  let dateValue = registerDateInput.value;
  let dayRegisterUser = new Date(dateValue);
  let selectedDay = dayRegisterUser.getDay();
  let selectedDate = dayRegisterUser.getDate();
  let dayRegister = new Date();
  let currentDay = dayRegister.getDay();
  let currentDate = dayRegister.getDate();
  let currentTime = dayRegister.getTime();

  if (currentDay >= 1 && currentDay <= 4) limitTime = dayRegister.setHours(11, 30, 0);
  else if (currentDay == 5 || currentDay == 6) limitTime = dayRegister.setHours(9, 30, 0);

  if (dateValue === "") alertError("Silakan pilih tanggal pendaftaran Anda");
  else if (selectedDay === 0) alertError("Puskesmas tidak melayani apapun pada hari Minggu");
  else if (currentDate === selectedDate) {
    if (currentTime >= limitTime) alertError("Tanggal tidak dapat diterapkan karena jam pelayanan! Silakan pilih hari lain");
    else valid = true;
  } else valid = true;

  if (!valid) return false;
  else return true;
}
// membatasi tanggal ruang poly ends

// memilih pasien starts
const patient = document.getElementById("patient");
const patientName = document.getElementById("patientName");
const phoneNumberInput = document.getElementById("no_hp");
const noRekMedInput = document.getElementById("noRekMed");
if (patient && patientName && phoneNumberInput && noRekMedInput) {
  patient.addEventListener("change", () => {
    let selectedPatient = patient.value;
    let splitValue = selectedPatient.split(" ");
    function checkPhoneNumber(PhoneNumber) {
      if (PhoneNumber.substring(0, 3) === "628") return PhoneNumber;
    }
    phoneNumberInput.value = splitValue.find(checkPhoneNumber);

    let showFullName = splitValue.slice(1, -1).join(" ");
    patientName.innerHTML = showFullName;

    let noRekMed = splitValue.slice(0, 1);
    noRekMedInput.value = noRekMed;
  });
}
// memilih pasien ends

// validasi form pendaftaran starts
if (patient) {
  let valid = false;
  function validasiPendaftaran() {
    valuePatient = patient.value;
    if (valuePatient === "---") alertError("Silakan pilih pasien yang akan berobat");
    else valid = true;

    if (!valid) return false;
    else {
      let confirmMsg = "Pastikan TIDAK ada data yang keliru. Cek data sekali lagi?";
      if (confirm(confirmMsg) === true) {
        alertP.style.display = "none";
        scrollToTop();
        return false;
      } else return true;
    }
  }
}
// validasi form pendaftaran ends

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
