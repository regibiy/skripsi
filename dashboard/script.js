// menu-button starts

// toggle class active, toggle = jika sebelumnya tidak ada jadi ada, jiak sebelumnya ada jadi tidak ada
const menu = document.querySelector("#menu");
// ketika humberger menu diklik
document.querySelector("#menu-button").onclick = () => {
  menu.classList.toggle("active");
};

// klik di luar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#menu-button");

document.addEventListener("click", function (event) {
  if (!hamburger.contains(event.target) && !menu.contains(event.target)) {
    menu.classList.remove("active");
  }
});

// menu button ends
