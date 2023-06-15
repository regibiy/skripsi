<?php
include_once("action.php");

if (!isset($_SESSION['no_kk'])) header("Location: index.php");

$no_kk = $_SESSION['no_kk'];

$sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk WHERE akun.no_kk = '$no_kk'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $nama_lengkap = $row['nama_depan'] . " " . $row['nama_belakang'];
}

$title = "Pendaftaran Berhasil";
$content = "Hai, <b>" . $nama_lengkap . "</b>
        <br><br><br>
        Pendaftaran Anda telah diterima dan akan dikonfirmasi oleh petugas kami secepat mungkin. 
        Petugas kami akan mengirimkan <i>email</i> kembali kepada Anda yang berisi nomor berobat dan kata sandi untuk <i>log in</i>.
        <br><br>
        Terima kasih telah melakukan pendaftaran akun pada website kami.
        <br><br><br>
        Salam,
        <br><br>
        <b>UPT Puskesmas Alianyang</b>
        <br>
        Jl. Pangeran Natakusuma, Pontianak Kota";

sendMail($email, $nama_lengkap, $title, $content);
unset($_SESSION['no_kk']);
