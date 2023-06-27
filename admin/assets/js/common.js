const passwordInput = document.getElementById("floatingPassword");
const passwordInputPetugas = document.getElementById("password");
const alertP = document.getElementById("alert");
const alertModalP = document.getElementById("alertModal");

// show password starts
function showPassword() {
  if (passwordInput.type == "password") passwordInput.type = "text";
  else passwordInput.type = "password";
}
// show password ends

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

function alertErrorModal($message) {
  alertModalP.innerHTML = $message;
  alertModalP.style.display = "block";
}

// validasi form tambah dan edit petugas starts
const roleSelect = document.getElementById("role");
const usernameInput = document.getElementById("username");
const namaDepanInput = document.getElementById("namaDepan");
const namaBelakangInput = document.getElementById("namaBelakang");
if (roleSelect) {
  roleSelect.addEventListener("change", () => {
    let roleValue = roleSelect.value;
    if (roleValue.length > 0) passwordInputPetugas.value = roleValue + "123#";
    else passwordInputPetugas.value = "";
  });
}

function validasiFormTambahPetugas() {
  let valid = false;
  let role = roleSelect.value;
  let username = usernameInput.value.trim();
  let namaDepan = namaDepanInput.value.trim();
  let namaBelakang = namaBelakangInput.value.trim();

  if (username.length === 0 || namaDepan.length === 0 || namaBelakang.length === 0) alertError("Pastikan semua data terisi");
  else if (role.length < 1) alertError("Silakan pilih role petugas puskesmas");
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
//  validasi form tambah dan edit petugas ends

// enabled dan disabled kuota starts
const kuotaBtn = document.getElementById("kuotaBtn");
const kuotaBtnSimpan = document.getElementById("kuotaBtnSimpan");
function toggleReadonly() {
  const kuotaInput = document.getElementById("kuotaInput");
  if (kuotaInput.readOnly) {
    kuotaInput.readOnly = false;
    kuotaBtnSimpan.disabled = false;
  } else {
    kuotaInput.readOnly = true;
    kuotaBtnSimpan.disabled = true;
  }
}

if (kuotaBtn) {
  kuotaBtn.addEventListener("click", () => {
    toggleReadonly();
  });
}
// enabled dan disabled kuota ends

// validasi form tambah dan edit ruang poli starts
const namaRuangInput = document.getElementById("nama");
function validasiFormTambahRuang() {
  let valid = false;
  let namaRuang = namaRuangInput.value.trim();
  if (namaRuang.length === 0) alertError("Pastikan semua data terisi");
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
// validasi form tambah dan edit ruang poli ends

// validasi form tambah dan edit data dokter starts
const nama = document.getElementById("nama");
const spesialisasi = document.getElementById("spesialisasi");
const noHP = document.getElementById("noHp");
const alamat = document.getElementById("alamat");
const judul = document.getElementById("judul");
const deskripsi = document.getElementById("deskripsi");
function validasiFormDokter() {
  let valid = false;
  if (nama.value.trim().length === 0) alertErrorModal("Silakan isi nama dokter");
  else if (spesialisasi.value.trim().length === 0) alertErrorModal("Silakan isi spesialisasi dokter");
  else if (noHP.value.length === 0) alertErrorModal("Silakan isi nomor hp dokter");
  else if (alamat.value.trim().length === 0) alertErrorModal("Silakan isi alamat dokter");
  else valid = true;

  if (!valid) return false;
  else {
    let confirmMsg = "Pastikan TIDAK ada data yang keliru. Cek data sekali lagi?";
    if (confirm(confirmMsg) === true) {
      alertP.style.display = "none";
      scrollToTop();
      return false;
    } else {
      if (judul.value.trim().length > 0) localStorage.setItem("judul", judul.value);
      if (deskripsi.value.trim().length > 0) localStorage.setItem("deskripsi", deskripsi.value);
      return true;
    }
  }
}

if (localStorage.getItem("judul") !== null) judul.value = localStorage.getItem("judul");
if (localStorage.getItem("deskripsi") !== null) deskripsi.value = localStorage.getItem("deskripsi");
localStorage.clear();

function restartTambahDokter() {
  alertModalP.style.display = "none";
  nama.value = "";
  spesialisasi.value = "";
  noHP.value = "";
  alamat.value = "";
}
// validasi form tambah dan edit data dokter ends

// validasi form tambah informasi starts
const idDokterSelect = document.getElementById("dokter");
const jamSelesaiNot = document.getElementById("jamSelesaiNotknown");
const jamSelesai = document.getElementById("jamSelesai");
function disabledJamSelesai() {
  if (jamSelesaiNot.checked === true) {
    jamSelesai.disabled = true;
    jamSelesai.value = "";
  } else jamSelesai.disabled = false;
}

function validasiFormInformasi() {
  let valid = false;
  let dokter = idDokterSelect.value;
  if (dokter === "---" || dokter === "") alertError("Silakan pilih dokter");
  else if (jamSelesaiNot.checked === false && (jamSelesai.value === null || jamSelesai.value === "")) alertError("Silakan tentukan jam selesai kegiatan");
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
// validai form tambah informasi ends

// href edit dokter starts
const idDokterA = document.getElementById("idDokterEdit");
const idDokterHidden = document.getElementById("idDokter");
if (idDokterSelect) {
  idDokterSelect.addEventListener("change", () => {
    let idDokter, splitDokter;
    idDokter = idDokterSelect.value;
    splitDokter = idDokter.split(" ");
    idDokterA.href = `edit-doctor-registration.php?idDokter=${splitDokter[0]}`;
    idDokterHidden.value = splitDokter[1];
  });
}
// href edit dokter ends

// validasi ubah status starts
const editProses = document.querySelectorAll(".edit-proses");
const editTunda = document.querySelectorAll(".edit-tunda");
function validasiStatus() {
  // Memeriksa apakah semua elemen dengan kelas "edit-proses" memiliki properti checked sebagai false
  const isAllEditProsesUnchecked = Array.from(editProses).every((element) => !element.checked);
  const isAllEditTundaUnchecked = Array.from(editTunda).every((element) => !element.checked);
  if (isAllEditProsesUnchecked && isAllEditTundaUnchecked) {
    alert("Silakan pilih salah satu status pendaftaran");
    return false;
  } else return true;
}
// validasi ubah status ends

// validasi tanggal starts
const tanggalAwalInput = document.getElementById("tanggalAwal");
const tanggalAkhirInput = document.getElementById("tanggalAkhir");
function validasiSetTanggal() {
  let valid = false;
  if (tanggalAkhirInput.value < tanggalAwalInput.value) alertError("Tanggal awal harus lebih kecil dari tanggal akhir");
  else valid = true;

  if (!valid) return false;
  else return true;
}
// validasi tanggal ends
