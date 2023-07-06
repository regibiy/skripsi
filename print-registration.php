<?php
include("action.php");

if (isset($_GET['nik']) && isset($_GET['iddaftar'])) {
    $enc_nik = $_GET['nik'];
    $dec_nik = decrypt($enc_nik);
    $id_daftar = $_GET['iddaftar'];
} else header("Location: index.php");

$sql = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik 
    INNER JOIN akun ON pasien.no_kk = akun.no_kk INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli WHERE pendaftaran.id_pendaftaran = '$id_daftar'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $nomor_antrian = $row['nomor_antrian'];
    $no_rekmed = $row['no_rekam_medis'];
    $nama_lengkap = $row['nama_depan'] . " " . $row['nama_belakang'];
    $tanggal_lahir = $row['tanggal_lahir'];
    $tanggal_berobat = $row['tanggal_berobat'];
    $selisih = date_diff(date_create($tanggal_lahir), date_create($tanggal_berobat));
    $umur = $selisih->y;
    $alamat = $row['alamat'];
    $no_hp = $row['no_hp'];
    $tanggal_daftar = format_date($row['tanggal_daftar']);
    $ruang_poli = $row['nama_ruang_poli'];
    $tanggal_berobat = format_date($row['tanggal_berobat']);
}

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
date_default_timezone_set("Asia/Jakarta");

$html = '
<style media="print">
    header, section {
        border-bottom: 1px dashed black;
        font-family: chelvetica;
    }
    .logo {
        float: left;
        width: 15%;
    }
    .header { 
        text-align: center;
        margin: 0;
    }
    .title {
        font-weight: bold;
        margin: 0;
        font-size: 16px;
    }
    .sub-title {
        font-size: 14px;
        margin: 0;
        color: #6C757D;
    }
    .table, tr, td {
        font-family: chelvetica;
    }
    article {
        font-family: chelvetica;
        font-style: italic;
        color: #6C757D;
    }
</style>
<div>
    <header>
        <div class="logo">
            <img src="assets/images/logo-upt.png" alt="" width="80" height="90" />
        </div>
        <div class="header">
            <p class="title">UPT PUSKESMAS ALIANYANG</p>
            <p class="sub-title">Jalan Pangeran Nata Kusuma</p>
            <p class="sub-title">Kel. Sungai Bangkong Kec. Pontianak Kota, Kota Pontianak</p>
            <p class="sub-title">Telp. 0561-8212307</p>
            <p class="sub-title" style="margin-bottom: 12px;">Email: alianyang.pnkkota@gmail.com</p>
        </div>
    </header>
    <br>
    <br>
    <section style="margin-bottom: 40px;">
        <table>
            <tr>
                <td width="200">Nomor Antrian</td>
                <td>' . $nomor_antrian . '</td>
            </tr>
            <tr>
                <td width="200">Nomor Rekam Medis</td>
                <td>' . $no_rekmed . '</td>
            </tr>
            <tr>
                <td width="200">Nama</td>
                <td>' . $nama_lengkap . '</td>
            </tr>
            <tr>
                <td width="200">Umur</td>
                <td>' . $umur . ' Tahun</td>
            </tr>
            <tr>
                <td width="200">Alamat</td>
                <td>' . $alamat . '</td>
            </tr>
            <tr>
                <td width="200">Nomor HP</td>
                <td>' . $no_hp . '</td>
            </tr>
            <tr>
                <td width="200">Tanggal Daftar</td>
                <td>' . $tanggal_daftar . '</td>
            </tr>
        </table>
    </section>

    <section>
        <table>
            <tr>
                <td style="padding-bottom:30px;">INFORMASI PENDAFTARAN</td>
            </tr>
            <tr>
                <td width="200">Tujuan Ruang Poli</td>
                <td>' . $ruang_poli . '</td>
            </tr>
            <tr>
                <td width="200">Tanggal Berobat</td>
                <td>' . $tanggal_berobat . '</td>
            </tr>
        </table>
    </section>
    <article>
        <p>*Pendaftaran akan dikenai biaya administrasi sebesar Rp.3000,00</p>
        <p>*Harap sudah berada di puskesmas 15 menit sebelum poli dibuka pukul 07:15</p>
        <p>*Jika telah menerima notifikasi melalui Whatsapp atau Email, silakan langsung menghadap loket pendaftaran untuk informasi lebih lanjut.</p>
    </article>
</div>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$filename = $no_rekmed . ' ' .  $ruang_poli . '.pdf';
$mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
