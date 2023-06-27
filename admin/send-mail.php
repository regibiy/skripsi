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

$sql = "SELECT * FROM pasien INNER JOIN akun ON pasien.no_kk = akun.no_kk WHERE nik = '$dec_nik'";
$result = $conn->query($sql);
if ($result) $data = $result->fetch_assoc();

if ($data['nama_belakang'] === NULL || $data['nama_belakang'] === "") $pasien = $data['nama_depan'];
else $pasien = $data['nama_depan'] . " " . $data['nama_belakang'];
$sender = $_SESSION['name'];
$role = $_SESSION['role'];
if ($role === "daftar") $show_role = "Pendaftaran";
$target = $data['email'];
$judul = "Pendaftaran Anda Telah Ditunda";
$konten = "Hai <b>" . $pasien . "</b>
        <br><br><br>
        Kami informasikan bahwa pendaftaran Anda telah dipanggil.
        <br><br>
        Silakan segera mendatangi UPT Puskesmas Alianyang menghadap loket pendaftaran dengan menunjukkan bukti pendaftaran untuk melakukan pendaftaran ulang.
        <br><br>
        Pembatalan dapat dilakukan dengan dengan mengunjungi puskesmasalianyangpnk.my.id pada menu Pendaftaran Saya.
        <br><br>
        Jika Anda tidak kunjung melakukan pendaftaran ulang, pendaftaran Anda akan <i>invalid</i> pada 30 menit sebelum jam pelayanan pendaftaran puskesmas berakhir.
        <br><br>
        Terima kasih.
        <br><br><br>
        Salam,<br>
        " . $sender . ", Petugas " . $show_role . " <b>UPT Puskesmas Alianyang</b><br>
        Jalan Pangeran Natakusuma, Pontianak Kota
        <br><br><br>
        <i>*pesan dikirim oleh sistem, harap Tidak membalas.</i>";

if (sendMail($target, $pasien, $judul, $konten)) {
    echo "<script>
    alert('Email pemberitahuan berhasil dikirimkan');
    window.location='index.php';
    </script>";
}
