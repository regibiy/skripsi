// awal menampilkan tanggal di top info
const dateP = document.getElementById("tanggal");
const timeP = document.getElementById("timer");

const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

setInterval(() => {
  let today = new Date();
  // awal tanggal
  let day = days[today.getDay()];
  let date = today.getDate();
  let month = months[today.getMonth()];
  dateP.innerHTML = `${day}, ${date}-${month}`;
  // akhir tanggal

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
        if ((a[i].getDate() === today.getDate() && a[i].getMonth() === today.getMonth() && a[i].getFullYear() === today.getFullYear()) || a[i].getDay() === 0) {
          time = `Tutup Memperingati `;
          time += data[i].holiday_name;
          break;
        } else if (dayOfWeek >= 1 && dayOfWeek <= 4) {
          if (hours < 7 || (hours == 7 && minutes < 15) || hours >= 12) {
            time = "Tutup a";
          } else {
            time = "07:15 - 12:00";
          }
        } else if (dayOfWeek == 5 || dayOfWeek == 6) {
          if (hours < 7 || (hours == 7 && minutes < 15) || hours >= 11) {
            time = "Tutup b";
          } else {
            time = "07:15 - 11:00";
          }
        } else if (dayOfWeek == 0) {
          time = "Tutup c";
        }
      }
      timeP.innerHTML = time;
    });
  // akhir jam operasional
}, 1000);

// akhir menampilkan tanggal di top info
