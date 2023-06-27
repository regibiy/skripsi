<?php
$title = "Kirim WA";
include("action-admin.php");

if (isset($_GET['nik'])) {
    $enc_nik = $_GET['nik'];
    $dec_nik = decrypt($enc_nik);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/login-header.php");

$sql = "SELECT * FROM pasien WHERE nik = '$dec_nik'";
$result = $conn->query($sql);
if ($result) $data = $result->fetch_assoc();

if ($data['nama_belakang'] === NULL || $data['nama_belakang'] === "") $pasien = $data['nama_depan'];
else $pasien = $data['nama_depan'] . " " . $data['nama_belakang'];
$sender = $_SESSION['name'];
$role = $_SESSION['role'];
if ($role === "daftar") $show_role = "Pendaftaran";
$pesan = "Hai, *" . $pasien . "*


Kami informasikan bahwa pendaftaran Anda telah dipanggil.

Silakan segera mendatangi UPT Puskesmas Alianyang menghadap loket pendaftaran dengan menunjukkan bukti pendaftaran untuk melakukan pendaftaran ulang.

Pembatalan pendaftaran dapat dilakukan dengan mengunjungi web puskesmasalianyangpnk.my.id pada menu Pendaftaran Saya.

Jika Anda tidak kunjung melakukan pendaftaran ulang, pendaftaran Anda akan _invalid_ pada 30 menit sebelum jam pelayanan pendaftaran puskesmas berakhir.

Terima kasih.


Salam,
" . $sender . ", Petugas " . $show_role . " *UPT Puskesmas Alianyang*
Jalan Pangeran Natakusuma, Pontianak Kota

_*pesan dikirim oleh sistem, harap TIDAK membalas._";
$target = $data['no_hp'];
// $target = "6285555555585";
$res_validate = validate_wa($target);
$arr_res_validate = json_decode($res_validate, true);
if ($arr_res_validate['status'] === true) {
    if (empty($arr_res_validate['not_registered'])) {
        $res_send = send_wa($target, $pesan);
        $arr_res_send = json_decode($res_send, true);
        if ($arr_res_send['status'] === false) {
            if ($arr_res_send['reason'] === "insufficient quota") {
                echo "<script>
                alert('Pesan tidak dapat terkirim karena kuota pengiriman pesan telah habis! Cek di fonnte.com');
                window.location='index-registration.php';
                </script>";
            }
        } else if ($arr_res_send['process'] === "sent" || $arr_res_send['process'] === "processing") {
            echo "<script>
            alert('Pesan berhasil dikirim! Kontrol semua pesan dengan mengunjungi link fonnte.com');
            window.location='index-registration.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Nomor HP pasien tidak terdaftar WhatsApp. Silakan gunakan email untuk mengirim pemberitahuan pasien');
        window.location='index-registration.php';
        </script>";
    }
} else {
    if ($arr_res_validate['reason'] === "device disconnected") {
?>
        <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
            <img src="../assets/images/cant_be_done.jpg" alt="cant be done" class="img-fluid" width="500">
            <h1 class="fs-4">Sesuatu telah terjadi...</h1>
            <p class="fs-7 mb-2">Validasi nomor WhatsApp tidak dapat dilakukan karena perangkat tidak terhubung.</p>
            <p class="fs-7 mb-2">Silakan hubungkan WhatsApp yang terhubung dengan sistem di <a target="_blank" href="https://fonnte.com/" class="text-decoration-none">sini</a>.</p>
            <p class="fs-7">Setelah berhasil terhubung, silakan <a href="index-registration.php" class="text-decoration-none fs-7">kembali ke dashboard</a> dan mencoba mengirim pesan kembali.</p>
        </div>
<?php
    }
}
