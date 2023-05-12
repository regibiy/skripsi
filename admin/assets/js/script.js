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
  if (bg.textContent == "Pending") {
    bg.classList.add("bg-danger");
    bg.classList.add("text-white");
  } else if (bg.textContent == "Process") {
    bg.classList.add("bg-info");
  }
});
// status ends
