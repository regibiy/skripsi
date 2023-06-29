$(document).ready(function () {
  $("#admin-registration").DataTable();
});

$(document).ready(function () {
  $("#rekmed-registration").DataTable({
    ordering: false,
  });
});

$(document).ready(function () {
  $("#medical-records").DataTable();
});

$(document).ready(function () {
  $("#patient-medical-record").DataTable();
});

// menu-button starts
// toggle class active, toggle = jika sebelumnya tidak ada jadi ada, jika sebelumnya ada jadi tidak ada
const menu = document.querySelector("#wrapper");
const sidebar = document.querySelector("#sidebar-wrapper");
// ketika humberger menu diklik
document.querySelector("#menu-toggle").onclick = () => {
  menu.classList.toggle("toggled");
};

// klik di luar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#menu-toggle");
document.addEventListener("click", function (event) {
  if (!hamburger.contains(event.target) && !sidebar.contains(event.target)) {
    menu.classList.remove("toggled");
  }
});
// menu button ends

// status starts
const queueStatus = document.querySelectorAll(".status");
queueStatus.forEach((bg) => {
  if (bg.textContent == "Menunggu") bg.classList.add("bg-info");
  else if (bg.textContent == "Diproses") bg.classList.add("bg-warning-subtle");
  else if (bg.textContent == "Ditunda") bg.classList.add("bg-warning");
  else if (bg.textContent == "Selesai") {
    bg.classList.add("bg-success");
    bg.classList.add("text-white");
  } else if (bg.textContent == "Invalid") bg.classList.add("bg-danger-subtle");
  else if (bg.textContent == "Dibatalkan") {
    bg.classList.add("bg-secondary");
    bg.classList.add("text-white");
  } else if (bg.textContent == "Gagal") {
    bg.classList.add("bg-danger");
    bg.classList.add("text-white");
  } else if (bg.textContent == "Sukses") bg.classList.add("bg-success-subtle");
});
// status ends

// tidak ada no indeks starts
// const tdIndeks = document.querySelectorAll(".indeks");
// tdIndeks.forEach((bg) => {
//   if (bg.textContent == "" || bg.textContent == null) bg.classList.add("table-danger");
// });
// tidak ada no indeks ends

// readonly toggle edit kk rekmed starts
const editKk = document.querySelectorAll(".edit-kk-rekmed");
const simpanEditKk = document.getElementById("simpanEditKk");
function editKkReadonly() {
  editKk.forEach((value) => {
    if (value.readOnly === true) value.readOnly = false;
    else value.readOnly = true;
  });

  if (simpanEditKk.disabled === true) simpanEditKk.disabled = false;
  else simpanEditKk.disabled = true;
}
// readonly toggle edit kk rekmed ends

// readonly toggle edit rekam medis starts
const editRekMed = document.querySelectorAll(".edit-rekam-medis");
const simpanEditRekmed = document.querySelectorAll(".simpan-edit-rekmed");
function editRekMedReadonly() {
  editRekMed.forEach((value) => {
    if (value.readOnly === true) value.readOnly = false;
    else value.readOnly = true;
  });

  simpanEditRekmed.forEach((value) => {
    if (value.disabled === true) value.disabled = false;
    else value.disabled = true;
  });
}
// readonly toogle edit rekam medis ends

// readonly toogle edit nik starts
const editNikRekmed = document.querySelectorAll(".edit-nik-rekmed");
const simpanEditNik = document.getElementById("simpanEditNik");
function editNikDisabled() {
  editNikRekmed.forEach((value) => {
    if (value.disabled === true) value.disabled = false;
    else value.disabled = true;
  });

  if (simpanEditNik.disabled === true) simpanEditNik.disabled = false;
  else simpanEditNik.disabled = true;
}
// readonly toogle edit nik ends
