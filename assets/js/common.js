$(document).ready(function () {
  $("#my-registration").DataTable({
    ordering: false,
  });
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
const alertModalP = document.getElementById("alertModal");
const inputKk = document.getElementById("noKk");
const inputJK = document.getElementById("jenisKelamin");
const inputAgama = document.getElementById("agama");
const inputNoHp = document.getElementById("noHp");
const inputRt = document.getElementById("rt");
const inputRw = document.getElementById("rw");

function scrollToTop() {
  window.scrollTo({
    top: 0,
  });
}

function alertErrorModal($message) {
  alertModalP.innerHTML = $message;
  alertModalP.style.display = "block";
}

function alertError($message) {
  alertP.innerHTML = $message;
  alertP.style.display = "block";
  scrollToTop();
}

function validasiFormDaftar() {
  let noKk;
  let valid = false;
  noKk = inputKk.value;
  noHp = inputNoHp.value;
  rt = inputRt.value;
  rw = inputRw.value;
  jk = inputJK.value;
  agama = inputAgama.value;

  if ((noKk.length >= 1 && noKk.length < 16) || noKk.length > 16) alertError("Sesuaikan Nomor KK Anda! Nomor KK memiliki panjang 16 angka");
  else if (jk === "---") alertError("Silakan pilih jenis kelamin Anda");
  else if (agama === "---") alertError("Silakan pilih agama Anda");
  else if (noHp.length > 15) alertError("Nomor HP hanya dapat menyimpan 15 angka");
  else if (rt.length > 5 || rw.length > 5) alertError("RT dan RW hanya dapat menyimpan 5 angka");
  else valid = true;

  if (!valid) return false;
  else {
    let confirmMsg = "Pastikan TIDAK ada data yang keliru. Nomor KK dan NIK TIDAK dapat diubah ketika data telah tersimpan ke dalam sistem. Cek data sekali lagi?";
    if (confirm(confirmMsg) === true) {
      alertP.style.display = "none";
      scrollToTop();
      return false;
    } else return true;
  }
}
// validasi form daftar ends

// membatasi tanggal ruang poly starts
const registerDateInput = document.getElementById("treatmentDate");
const minggu = document.getElementById("minggu");
const listPoly = document.getElementById("listPoly");
let descMinggu = "<div class='col-xl-6 col-12 text-xl-end text-center' data-aos='zoom-in-up'>";
descMinggu += "<img src='assets/images/close.jpg' alt='' class='img-fluid' width='500'></div>";
descMinggu += "<div class='col-xl-6 col-12 text-xl-start text-center' data-aos='zoom-in-up'><h3 class='fs-4'>Maaf...</h3>";
descMinggu += "<p class='fs-7 mb-2'>Puskesmas tidak melayani apapun pada hari Minggu.</p>";
descMinggu += "<p class='fs-7'>Silakan pilih tanggal berobat yang lain.</p></div>";
if (registerDateInput) {
  let dateLimit = new Date();
  let minYear = dateLimit.getFullYear();
  let minMonth = dateLimit.getMonth() + 1;
  let minDay = dateLimit.getDate();

  if (minMonth < 10) minMonth = "0" + minMonth;
  if (minDay < 10) minDay = "0" + minDay;

  dateLimit.setDate(dateLimit.getDate() + 7);
  let maxYear = dateLimit.getFullYear();
  let maxMonth = dateLimit.getMonth() + 1;
  let maxDay = dateLimit.getDate();

  if (maxMonth < 10) maxMonth = "0" + maxMonth;
  if (maxDay < 10) maxDay = "0" + maxDay;

  let minDate = `${minYear}-${minMonth}-${minDay}`;
  registerDateInput.min = minDate;
  let maxDate = `${maxYear}-${maxMonth}-${maxDay}`;
  registerDateInput.max = maxDate;
}

function validasiTanggalDaftar() {
  let valid = false;
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
  else if (selectedDay === 0) {
    alertP.style.display = "none";
    minggu.classList.remove("d-none");
    listPoly.classList.add("d-none");
    minggu.innerHTML = descMinggu;
  } else if (currentDate === selectedDate) {
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

// validasi form pendaftaran saya starts
const myNoRekmedInput = document.getElementById("noRekmed");
if (myNoRekmedInput) {
  function validasiFormRekmed() {
    let valid = false;
    let noRekMed = myNoRekmedInput.value;
    if (noRekMed === "---") alertError("Silakan pilih nomor rekam medis");
    else valid = true;

    if (!valid) return false;
    else return true;
  }
}
// validasi form pendaftaran saya ends

// validasi nik tambah anggota keluarga starts
const cekNikInput = document.getElementById("nikCheckDua");
function validasiNIK() {
  let valid = false;
  let nik = cekNikInput.value;
  if ((nik.length >= 1 && nik.length < 16) || nik.length > 16) alertErrorModal("Sesuaikan NIK Anda! NIK memiliki panjang 16 angka");
  else valid = true;

  if (!valid) return false;
  else return true;
}

function restartNIK() {
  if (alertP.style.display === "block") {
    cekNikInput.value = "";
    alertP.style.display = "none";
  }
}

const editEmail = document.getElementById("email");
const hiddenEmail = document.getElementById("hiddenEmail");
function restartEmail() {
  let email = hiddenEmail.value;
  editEmail.value = email;
}

const editAlamat = document.getElementById("alamat");
const hiddenAlamat = document.getElementById("hiddenAlamat");
const editRT = document.getElementById("rt");
const hiddenRT = document.getElementById("hiddenRT");
const editRW = document.getElementById("rw");
const hiddenRW = document.getElementById("hiddenRW");
const editKelDesa = document.getElementById("kel_desa");
const hiddenKelDesa = document.getElementById("hiddenKelDesa");
const editKecamatan = document.getElementById("kecamatan");
const hiddenKecamatan = document.getElementById("hiddenKecamatan");
function restartDomisili() {
  editAlamat.value = hiddenAlamat.value;
  editRT.value = hiddenRT.value;
  editRW.value = hiddenRW.value;
  editKelDesa.value = hiddenKelDesa.value;
  editKecamatan.value = hiddenKecamatan.value;
}
// validasi nik tambah anggota keluarga ends

// validasi tambah anggota starts
const statusHubunganInput = document.getElementById("statusHubungan");
const jenisKelaminInput = document.getElementById("jenisKelamin");
const agamaInput = document.getElementById("agama");
function validasiTambahAnggota() {
  let valid = false;
  let statusHubungan = statusHubunganInput.value;
  let jenisKelamin = jenisKelaminInput.value;
  let agama = agamaInput.value;
  if (jenisKelamin === "---") alertError("Silakan pilih jenis kelamin");
  else if (agama === "---") alertError("Silakan pilih agama");
  else if (statusHubungan === "---") alertError("Silakan pilih status hubungan pasien");
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
// validasi tambah anggota ends

// validasi edit anggota starts
function validasiEditAnggota() {
  let confirmMsg = "pastikan Tidak ada data yang keliru. Cek data sekali lagi?";
  if (confirm(confirmMsg) === true) {
    scrollToTop();
    return false;
  } else return true;
}
// validasi edit anggota ends
