<?php
include("action-admin.php");

if (isset($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir'])) {
    $enc_tanggal_awal = $_GET['tanggalAwal'];
    $enc_tanggal_akhir = $_GET['tanggalAkhir'];
    $dec_tanggal_awal = decrypt($enc_tanggal_awal);
    $dec_tanggal_akhir = decrypt($enc_tanggal_akhir);
} else header("Location: index.php");

$tanggal_cetak = date("d-m-Y H:i:s");
$pencetak = $_SESSION['name'];

// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

// Write some HTML code: {PAGENO}/{nbpg}
$html = '
<style media="print">
    header {
        border-bottom: 0.5px dashed black;
        font-family: chelvetica;
    }
    section {
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
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    .data {
        border-collapse: collapse;
    }
    table, tr, td, th {
        font-family: chelvetica;
        font-size: 14px;
    }
</style>
<div>
    <htmlpagefooter name="MyFooter1">
        <table width="100%">
            <tr>
                <td width="33%"><span style="font-weight: bold;"> ' . $tanggal_cetak . ' </span></td>
                <td width="33%" align="center" style="font-weight: bold;"> {PAGENO}/{nbpg} </td>
                <td width="33%" style="text-align: right; font-weight: bold;">' . $pencetak . '</td>
            </tr>
        </table>
    </htmlpagefooter>

    <sethtmlpagefooter name="MyFooter1" value="on" />

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
    </header>

    <section style="margin-top:16px;">
        <p class="title text-center">LAPORAN KONTAK TAK LANGSUNG</p>
        <p class="sub-title text-center">' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . '</p>
    </section>

    <section style="margin-top:16px;">
        <table class="data" border="1" style="width:100%;">
            <tr>
                <th rowspan="2" class="text-center">Tanggal Daftar</th>
                <th rowspan="2" class="text-center">Jumlah Pendaftaran</th>
                <th colspan="2" class="text-center">Status</th>
            </tr>
            <tr>
                <th class="text-center">Sukses</th>
                <th class="text-center">Gagal</th>
            </tr>';
$sql = "SELECT tanggal_daftar, COUNT(id_pendaftaran) AS jumlah_pendaftaran, SUM(CASE WHEN status_pendaftaran = 'Gagal' THEN 1 ELSE 0 END) AS jumlah_gagal,
        SUM(CASE WHEN status_pendaftaran = 'Sukses' THEN 1 ELSE 0 END) AS jumlah_sukses FROM pendaftaran 
        WHERE (status_pendaftaran = 'Sukses' OR status_pendaftaran = 'Gagal') AND (tanggal_daftar BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir')
        GROUP BY tanggal_daftar, status_pendaftaran ORDER BY tanggal_daftar ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td class="text-center" style="padding: 5px">' . format_date($row['tanggal_daftar']) . '</td>
                <td class="text-center" style="padding: 5px">' . $row['jumlah_pendaftaran'] . ' Pendaftaran</td>
                <td class="text-center" style="padding: 5px">' . $row['jumlah_sukses'] . ' Sukses</td>
                <td class="text-center" style="padding: 5px">' . $row['jumlah_gagal'] . ' Gagal</td>
            </tr>';
}
$sql = "SELECT COUNT(id_pendaftaran) as total_pendaftaran FROM pendaftaran 
        WHERE (status_pendaftaran = 'Sukses' OR status_pendaftaran = 'Gagal') AND (tanggal_daftar BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir')";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$html .= '  <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran Bulan Ini :</th>
                <th>' . $data['total_pendaftaran'] . ' Pendaftaran</th>
            </tr>';
$sql = "SELECT COUNT(id_pendaftaran) as total_sukses FROM pendaftaran 
        WHERE status_pendaftaran = 'Sukses' AND (tanggal_daftar BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir')";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$html .= '  <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran yang Sukses :</th>
                <th>' . $data['total_sukses'] . ' Sukses</th>
            </tr>';
$sql = "SELECT COUNT(id_pendaftaran) as total_gagal FROM pendaftaran 
        WHERE status_pendaftaran = 'Gagal' AND (tanggal_daftar BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir')";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$html .= '  <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran yang Gagal :</th>
                <th>' . $data['total_gagal'] . ' Gagal</th>
            </tr>
        </table>
    </section>
</div>';

$mpdf->WriteHTML($html);

$filename = "Laporan Kontak Tak Langsung Periode " . format_date($dec_tanggal_awal) . " sampai " . format_date($dec_tanggal_akhir) . ".pdf";
// Output a PDF file directly to the browser
$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
