// awal menampilkan tanggal di top info
const dateP = document.getElementById("tanggal");
const spanDate = dateP.querySelector(".tanggal");
const timerP = document.getElementById("timer");
const spanTimer = timerP.querySelector(".timer");
let today = new Date();

const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
let day = days[today.getDay()];
let date = today.getDate();
let month = months[today.getMonth()];
dateP.innerHTML += `${day}, ${date}-${month}`;

function completeDate(h, m) {
  let date = new Date(today.getFullYear(), today.getMonth(), today.getDate(), h, m);
  return date;
}

let dayOfWeek = today.getDay();
let openTime, closeTime;
if (dayOfWeek >= 1 && dayOfWeek <= 4) {
  openTime = completeDate(7, 15);
  closeTime = completeDate(12, 0);
  console.log(openTime);
} else if (dayOfWeek === 5 || dayOfWeek === 6) {
  openTime = completeDate(7, 15);
  closeTime = completeDate(11, 0);
} else {
  timerP.innerHTML += `Tutup`;
  setInterval(() => {
    timerP.innerHTML += `Tutup`;
  }, 1000);
}

if (openTime && closeTime) {
  let timeLeft = Math.floor((closeTime.getTime() - today.getTime()) / 1000);
  if (timeLeft <= 0) {
    timerP.innerHTML += `Tutup`;
  } else {
    let hoursLeft = Math.floor(timeLeft / 3600);
    let minutesLeft = Math.floor((timeLeft % 3600) / 60);
    let timeString = `Tutup dalam ${hoursLeft} jam ${minutesLeft} menit`;
    timerP.innerHTML += timeString;
    setInterval(() => {
      timeLeft--;
      if (timeLeft <= 0) {
        timerP.innerHTML += `Tutup`;
      } else {
        hoursLeft = Math.floor(timeLeft / 3600);
        minutesLeft = Math.floor((timeLeft % 3600) / 60);
        timeString = `Tutup dalam ${hoursLeft} jam ${minutesLeft} menit`;
        timerP.innerHTML += timeString;
      }
    }, 1000);
  }
}
// akhir menampilkan tanggal di top info
