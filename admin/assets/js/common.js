const passwordInput = document.getElementById("floatingPassword");
const passwordInputPetugas = document.getElementById("password");
const alertP = document.getElementById("alert");

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
