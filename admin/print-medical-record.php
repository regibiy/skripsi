<?php
include("action-admin.php");

if (isset($_GET['noRekmed']) && isset($_GET['noKk'])) {
    $enc_no_rekmed = $_GET['noRekmed'];
    $enc_no_kk = $_GET['noKk'];
    $dec_no_rekmed = decrypt($enc_no_rekmed);
    $dec_no_kk = decrypt($enc_no_kk);
} else header("Location: index.php");

// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
// date_default_timezone_set("Asia/Jakarta");

// Write some HTML code:
$html = '
<style media="print">
    @page {
        margin-top: 0.7cm;
        margin-bottom: 0.3cm;
        margin-left: 0.5cm;
        margin-right: 0.5cm;
    }
    header {
        border-bottom: 0.5px dashed black;
        font-family: chelvetica;
    }
    .logo {
        float: left;
        width: 15%;
    }
    .logo-two {
        width: 15%;
        text-align: right;
    }
    .header { 
        text-align: center;
        margin: 0;
        float: left;
        width: 69%;
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
        font-size: 12px;
    }
    article {
        font-family: chelvetica;
        font-style: italic;
        color: #6C757D;
    }
    .second-info {
        font-size: 14px;
        font-family: chelvetica;
        border-bottom: 0.5px dashed black;
    }
    .medical-record {
        border-collapse: collapse;
    }
    .border-all {
        border: 1px solid black;
    }
    .l-r {
        border-left: 1px solid black;
        border-right: 1px solid black;
    }
    .l-b-r {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
    }
    .r {
        border-right: 1px solid black;
    }
    .r-b {
        border-right: 1px solid black;
        border-bottom: 1px solid black;
    }
    .b {
        border-bottom: 1px solid black;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
</style>
<div>
    <header>
        <div class="logo">
            <img src="../assets/images/logo-upt.png" alt="" width="90" height="100" />
        </div>
        <div class="header">
        <p class="title">PEMERINTAH KOTA PONTIANAK</p>
        <p class="title">DINAS KESEHATAN</p>
        <p class="title">UPT PUSKESMAS ALIANYANG</p>
        <p class="sub-title">Jalan Pangeran Nata Kusuma</p>
            <p class="sub-title">Kel. Sungai Bangkong Kec. Pontianak Kota, Kota Pontianak</p>
            <p class="sub-title" style="margin-bottom: 12px;">Telp. 0561-8212307, Email: alianyang.pnkkota@gmail.com</p>
        </div>
        <div class="logo-two">
            <img src="../assets/images/logo.png" alt="" width="100" height="90" />
        </div>
    </header>';

$sql = "SELECT * FROM rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik WHERE rekam_medis.no_rekam_medis = '$dec_no_rekmed'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if ($data['riwayat_alergi_obat'] === NULL || $data['riwayat_alergi_obat'] === "") $riwayat = "Tidak ada";
else $riwayat = $data['riwayat_alergi_obat'];

$sql_kk = "SELECT * FROM pasien INNER JOIN akun ON pasien.no_kk = akun.no_kk WHERE pasien.no_kk = '$dec_no_kk' AND status_hubungan = 'Kepala Keluarga'";
$result_kk = $conn->query($sql_kk);
$data_kk = $result_kk->fetch_assoc();

$html .= '
    <section class="second-info">
        <p style="text-align: right; margin-bottom: 0;">No Rekam Medis : ' . $data['no_rekam_medis'] . '</p>
        <p style="margin:0;">LEMBAR REKAM MEDIS PASIEN</p>
    </section>
    <section class="patient-info">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>' . $data['nama_depan'] . ' ' . $data['nama_belakang'] . '</td>
                <td>Umum/BPJS</td>
                <td>:</td>
                <td width="340">Umum</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td width="230">' . format_date($data['tanggal_lahir']) . '</td>
                <td>No KTP</td>
                <td>:</td>
                <td>' . $data['nik'] . '</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td width="230">' . $data['jenis_kelamin'] . '</td>
                <td>Nama KK</td>
                <td>:</td>
                <td>' . $data_kk['nama_depan'] . ' ' . $data_kk['nama_belakang'] . '</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td width="230">' . $data['agama'] . '</td>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td>' . format_date($data['tanggal_masuk']) . '</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Pekerjaan</td>
                <td style="vertical-align: top;">:</td>
                <td width="230" style="vertical-align: top;">' . $data['pekerjaan'] . '</td>
                <td style="vertical-align: top;">Riwayat Alergi Obat</td>
                <td style="vertical-align: top;">:</td>
                <td>' . $riwayat . '</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td style="vertical-align: top;">:</td>
                <td width="230">' . $data_kk['alamat'] . '</td>
                <td style="vertical-align: top;">Telp/HP</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">' . $data['no_hp'] . '</td>
            </tr>
        </table>
    </section>
    <section>
        <table class="medical-record" style="width:100%;">
            <tr>
                <td class="border-all text-center" width="60">Tanggal</td>
                <td class="border-all text-center" width="150">Pemeriksaan Subjektif</td>
                <td colspan="2" class="border-all text-center" width="150">Pemeriksaan Objektif</td>
                <td class="border-all text-center" width="100">Diagnosa / Kode Diagnosa</td>
                <td colspan="3" class="border-all text-center">Tata Laksana</td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">Keluhan Utama :</td>
                <td>KU</td>
                <td class="r"></td>
                <td class="r"></td>
                <td>R/</td>
                <td class="r"></td>
                <td class="r" width="150">Asuhan</td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>Kes</td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Paramedis</td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>TTV</td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>TD :</td>
                <td class="r">RR :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPS :</td>
                <td>N :</td>
                <td class="r">T :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td class="r" colspan="2">Antropometri</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td style="vertical-align: top;" >BB :</td>
                <td class="r" style="height: 30px; vertical-align:top;">TB :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td class="r" colspan="2">Pemeriksaan Fisik</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPD :</td>
                <td></td>
                <td class="r"></td>
                <td class="r">ICD X :</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Rujukan</td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r-b"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Internal :</td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Diagnosa</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Keperawatan</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPK :</td>
                <td class="r" colspan="2">Pemeriksaan Penunjang :</td>
                <td class="r"></td>
                <td class="b"></td>
                <td class="r b"></td>
                <td class="r"></td>
                <td class=""></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="r text-center">Jenis Edukasi</td>
                <td class="r-b text-center">Paraf Pasien</td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="border-all">1.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">kebutuhan biologis</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="r-b">2.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">psikologis social</td>
                <td></td>
                <td class="r"></td>
                <td class="r">ICD IX</td>
                <td class="r-b">3.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">spiritual dan tata</td>
                <td></td>
                <td class="r"></td>
                <td class="r">(Kode CA)</td>
                <td class="r-b">4. ESO</td>
                <td class="r-b"></td>
                <td class="r-b"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r" style="vertical-align:top;">nilai</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td style="height: 50px; vertical-align:top;">Rujukan Eksternal</td>
                <td></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-b-r"></td>
                <td class="l-b-r"></td>
                <td class="b"></td>
                <td class="r-b"></td>
                <td class="r-b"></td>
                <td class="b"></td>
                <td class="b"></td>
                <td class="r-b text-right"><u>Paraf Petugas</u></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">Keluhan Utama :</td>
                <td>KU</td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r" width="150">Asuhan</td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>Kes</td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Paramedis</td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>TTV</td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td>TD :</td>
                <td class="r">RR :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPS :</td>
                <td>N :</td>
                <td class="r">T :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td class="r" colspan="2">Antropometri</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td style="vertical-align: top;" >BB :</td>
                <td class="r" style="height: 30px; vertical-align:top;">TB :</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            </tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td class="r" colspan="2">Pemeriksaan Fisik</td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPD :</td>
                <td></td>
                <td class="r"></td>
                <td class="r">ICD X :</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Rujukan</td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Internal :</td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Diagnosa</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r">Keperawatan</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">RPK :</td>
                <td class="r" colspan="2">Pemeriksaan Penunjang :</td>
                <td class="r"></td>
                <td class="b"></td>
                <td class="r b"></td>
                <td class="r"></td>
                <td class=""></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="r text-center">Jenis Edukasi</td>
                <td class="r-b text-center">Paraf Pasien</td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r"></td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="border-all">1.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">kebutuhan biologis</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td class="r-b">2.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">psikologis social</td>
                <td></td>
                <td class="r"></td>
                <td class="r">ICD IX</td>
                <td class="r-b">3.</td>
                <td class="r"></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r">spiritual dan tata</td>
                <td></td>
                <td class="r"></td>
                <td class="r">(Kode CA)</td>
                <td class="r-b">4. ESO</td>
                <td class="r-b"></td>
                <td class="r-b"></td>
            <tr>
            <tr>
                <td class="l-r"></td>
                <td class="l-r" style="vertical-align:top;">nilai</td>
                <td></td>
                <td class="r"></td>
                <td class="r"></td>
                <td style="height: 50px; vertical-align:top;">Rujukan Eksternal</td>
                <td></td>
                <td class="r"></td>
            <tr>
            <tr>
                <td class="l-b-r"></td>
                <td class="l-b-r"></td>
                <td class="b"></td>
                <td class="r-b"></td>
                <td class="r-b"></td>
                <td class="b"></td>
                <td class="b"></td>
                <td class="r-b text-right"><u>Paraf Petugas</u></td>
            <tr>
        </table>
    </section>
</div>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
