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
    .padding-td {
        padding: 5px;
    }
    .margin-bott-zero {
        margin-bottom: 0px;
    }
    .margin-zero {
        margin: 0px;
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
    </section>';
$sql = "SELECT DISTINCT tanggal_berobat FROM pendaftaran WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir' ORDER BY tanggal_berobat";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $tanggal_berobat = $row['tanggal_berobat'];
    $html .= '
        <section style="margin-top:16px;">
            <p style="margin-bottom: 10px;">Tanggal : <b>' . format_date($tanggal_berobat) . '</b></p>
            <table class="data" border="1" style="width:100%;">
                <tr>
                    <th class="text-center padding-td" width="200px">Nomor Rekam Medis / NIK</th>
                    <th class="text-center padding-td" width="200px">Nama Pasien</th>
                    <th class="text-center padding-td" width="100px">Umur</th>
                    <th class="text-center padding-td" width="100px">Jenis Kelamin</th>
                    <th class="text-center padding-td" width="100px">Status</th>
                </tr>';
    $sql2 = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis
    INNER JOIN pasien ON rekam_medis.nik = pasien.nik WHERE tanggal_berobat = '$tanggal_berobat' 
    AND (status_pendaftaran = 'Sukses' OR status_pendaftaran = 'Gagal')";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            if ($row2['no_rekam_medis'] === NULL || $row2['no_rekam_medis'] === '') $kolom_satu = $row2['nik'];
            else $kolom_satu = $row2['no_rekam_medis'];
            $nama_lengkap = $row2['nama_depan'] . " " . $row2['nama_belakang'];
            $tanggal_lahir = $row2['tanggal_lahir'];
            $tanggal_berobat_umur = $row2['tanggal_berobat'];
            $selisih = date_diff(date_create($tanggal_lahir), date_create($tanggal_berobat_umur));
            $umur = $selisih->y;
            $html .= '
                <tr>
                    <td class="padding-td">' . $kolom_satu . '</td>
                    <td class="padding-td">' . $nama_lengkap . '</td>
                    <td class="padding-td">' . $umur . ' Tahun</td>
                    <td class="padding-td">' . $row2['jenis_kelamin'] . '</td>
                    <td class="padding-td">' . $row2['status_pendaftaran'] . '</td>
                </tr>';
        }

        $sql3 = "SELECT COUNT(id_pendaftaran) AS jumlah_kunjungan FROM pendaftaran WHERE tanggal_berobat = '$tanggal_berobat' AND (status_pendaftaran = 'Sukses' OR status_pendaftaran = 'Gagal')";
        $result3 = $conn->query($sql3);
        $data = $result3->fetch_assoc();
        $html .= '
                <tr>
                    <th colspan="3" class="padding-td text-right">Jumlah Kunjungan : </th>
                    <th colspan="2">' . $data['jumlah_kunjungan'] . ' Kunjungan</th>
                </tr>';
        $sql4 = "SELECT COUNT(id_pendaftaran) AS jumlah_sukses FROM pendaftaran WHERE tanggal_berobat = '$tanggal_berobat' AND status_pendaftaran = 'Sukses'";
        $result4 = $conn->query($sql4);
        $data2 = $result4->fetch_assoc();
        $html .= '
                <tr>
                    <th colspan="3" class="padding-td text-right">Jumlah Kunjungan yang Sukses : </th>
                    <th colspan="2">' . $data2['jumlah_sukses'] . ' Kunjungan Sukses</th>
                </tr>';
        $sql5 = "SELECT COUNT(id_pendaftaran) AS jumlah_gagal FROM pendaftaran WHERE tanggal_berobat = '$tanggal_berobat' AND status_pendaftaran = 'Gagal'";
        $result5 = $conn->query($sql5);
        $data3 = $result5->fetch_assoc();
        $html .= '
                <tr>
                    <th colspan="3" class="padding-td text-right">Jumlah Kunjungan yang Gagal : </th>
                    <th colspan="2">' . $data3['jumlah_gagal'] . ' Kunjungan Gagal</th>
                </tr>
            </table>
        </section>';
    } else {
        $html .= '<tr>
                    <td colspan="5" class="text-center">Data pendaftaran tidak dapat ditampilkan karena status pendaftaran Invalid atau Dibatalkan</td>
                </tr>
                </table>
                </section>';
    }
}
$sql6 = "SELECT COUNT(id_pendaftaran) AS total_kunjungan FROM pendaftaran WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir' AND (status_pendaftaran = 'Sukses' OR status_pendaftaran = 'Gagal')";
$result6 = $conn->query($sql6);
$data4 = $result6->fetch_assoc();
$sql7 = "SELECT COUNT(id_pendaftaran) AS total_sukses FROM pendaftaran WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir' AND status_pendaftaran = 'Sukses'";
$result7 = $conn->query($sql7);
$data5 = $result7->fetch_assoc();
$sql8 = "SELECT COUNT(id_pendaftaran) AS total_gagal FROM pendaftaran WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir' AND status_pendaftaran = 'Gagal'";
$result8 = $conn->query($sql8);
$data6 = $result8->fetch_assoc();
$html .= '
        <section style="margin-top:16px;">
        <p class="margin-bott-zero">Total Kunjungan dari ' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . ' : </p>
        <p class="margin-zero"><b>' . $data4['total_kunjungan'] . ' Kunjungan</b></p>
        </section>
        <section style="margin-top:16px;">
        <p class="margin-bott-zero">Total Kunjungan yang Sukses dari ' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . ' : </p>
        <p class="margin-zero"><b>' . $data5['total_sukses'] . ' Kunjungan Sukses</b></p>
        </section>
        <section style="margin-top:16px;">
        <p class="margin-bott-zero">Total Kunjungan yang Gagal dari ' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . ' : </p>
        <p class="margin-zero"><b>' . $data6['total_gagal'] . ' Kunjungan Gagal</b></p>
        </section>';

$mpdf->WriteHTML($html);

$filename = "Laporan Kontak Tak Langsung Periode " . format_date($dec_tanggal_awal) . " sampai " . format_date($dec_tanggal_akhir) . ".pdf";
// Output a PDF file directly to the browser
$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
