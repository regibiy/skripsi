// awal menampilkan tanggal di top info
const dateP = document.getElementById("tanggal");
const timeP = document.getElementById("timer");
const greetingH1 = document.querySelector(".greeting");

const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

let today = new Date();
// awal tanggal
let day = days[today.getDay()];
let date = today.getDate();
let month = months[today.getMonth()];
dateP.innerHTML = `${day}, ${date}-${month}`;
// akhir tanggal

function dinamisTopInfo() {
  // awal jam operasional
  let time;
  let hours = today.getHours();
  let minutes = today.getMinutes();
  let dayOfWeek = today.getDay();
  let monthNumber = today.getMonth() + 1;
  let url = `https://api-harilibur.vercel.app/api?month=${monthNumber}`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      let a = [];
      for (let i = 0; i <= data.length - 1; i++) {
        a[i] = new Date(data[i].holiday_date);
        if (a[i].getDate() === today.getDate() && a[i].getMonth() === today.getMonth() && a[i].getFullYear() === today.getFullYear()) {
          time = `Tutup Memperingati `;
          time += data[i].holiday_name;
          break;
        } else if (dayOfWeek >= 1 && dayOfWeek <= 4) {
          if (hours < 7 || (hours == 7 && minutes < 15) || hours >= 12) time = "Tutup";
          else time = "07:15 - 12:00";
        } else if (dayOfWeek == 5 || dayOfWeek == 6) {
          if (hours < 7 || (hours == 7 && minutes < 15) || hours >= 10) time = "Tutup";
          else time = "07:15 - 10:00";
        } else if (dayOfWeek == 0) time = "Tutup";
      }
      timeP.innerHTML = time;
    });
  // akhir jam operasional

  // awal greeting
  if (hours >= 6 && hours <= 9 && minutes <= 59) greetingH1.innerHTML = "Selamat pagi...";
  else if (hours >= 10 && hours <= 14 && minutes <= 59) greetingH1.innerHTML = "Selamat siang...";
  else if (hours >= 15 && hours <= 18 && minutes <= 59) greetingH1.innerHTML = "Selamat sore...";
  else greetingH1.innerHTML = "Selamat malam...";
  // akhir greeting
}

dinamisTopInfo();

setInterval(() => {
  dinamisTopInfo();
}, 3600000);

// akhir menampilkan tanggal di top info
