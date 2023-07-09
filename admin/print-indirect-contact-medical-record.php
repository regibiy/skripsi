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

// @page {
//     margin-top: 0.7cm;
//     margin-bottom: 0.3cm;
//     margin-left: 0.5cm;
//     margin-right: 0.5cm;
// }
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
    .poly-title {
        font-size: 12px;
        font-weight: bold;
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
        font-size: 12px;
    }
    .padding-td {
        padding: 5px;
    }
    .fs-12 {
        font-size: 12px;
    }
    .double-border-bott {
        border-bottom: double;
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
        <p class="title text-center">LAPORAN KONTAK TAK LANGSUNG PER POLI</p>
        <p class="sub-title text-center">' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . '</p>
    </section>
        
    <section style="margin-top:16px;">';

// query starts here
$result = get_data("ruang_poli");
while ($row = $result->fetch_assoc()) {
    $id_ruang_poli = $row['id_ruang_poli'];
    $html .= '
    <section class="double-border-bott">
    <p class="poly-title text-center">' . strtoupper($row['nama_ruang_poli']) . '</p>';
    $sql = "SELECT DISTINCT tanggal_berobat FROM pendaftaran WHERE id_ruang_poli = '$id_ruang_poli' AND status_pendaftaran = 'Sukses' AND
            (tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir') ORDER BY tanggal_berobat";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $tanggal_berobat = $row2['tanggal_berobat'];
            $html .= '
                <p class="poly-title" style="margin-bottom: 10px;">Tanggal : <b>' . format_date($tanggal_berobat) . '</b></p>
                <table class="data" border="1" style="width:100%; margin-bottom: 32px;">
                    <tr>
                        <th class="text-center padding-td" width="150px">Nomor Rekam Medis / NIK</th>
                        <th class="text-center padding-td" width="200px">Nama Pasien</th>
                        <th class="text-center padding-td" width="100px">Umur</th>
                        <th class="text-center padding-td" width="100px">Jenis Kelamin</th>
                        <th class="text-center padding-td" width="150px">Status Kunjungan Pasien</th>
                    </tr>';
            $sql2 = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik 
                WHERE tanggal_berobat = '$tanggal_berobat' AND id_ruang_poli = '$id_ruang_poli' AND status_pendaftaran = 'Sukses'";
            $result3 = $conn->query($sql2);
            while ($row3 = $result3->fetch_assoc()) {
                if ($row3['no_rekam_medis'] === NULL || $row3['no_rekam_medis'] === '') $kolom_satu = $row3['nik'];
                else $kolom_satu = $row3['no_rekam_medis'];
                $nama_lengkap = $row3['nama_depan'] . " " . $row3['nama_belakang'];
                $tanggal_lahir = $row3['tanggal_lahir'];
                $tanggal_berobat_umur = $row3['tanggal_berobat'];
                $selisih = date_diff(date_create($tanggal_lahir), date_create($tanggal_berobat_umur));
                $umur = $selisih->y;
                $sql3 = "SELECT COUNT(id_pendaftaran) as status_kunjungan FROM pendaftaran WHERE id_ruang_poli = '$id_ruang_poli' AND no_rekam_medis = '$kolom_satu' AND status_pendaftaran = 'Sukses'";
                $result4 = $conn->query($sql3);
                $data = $result4->fetch_assoc();
                if ($data['status_kunjungan'] > 1) $status_kunjungan = "Lama";
                else $status_kunjungan = "Baru";
                $html .= '
                    <tr>
                        <td class="padding-td">' . $kolom_satu . '</td>
                        <td class="padding-td">' . $nama_lengkap . '</td>
                        <td class="padding-td">' . $umur . ' Tahun</td>
                        <td class="padding-td">' . $row3['jenis_kelamin'] . '</td>
                        <td class="padding-td">' . $status_kunjungan . '</td>
                    </tr>';
            }
            $html .= '</table>';
        }
        $sql4 = "SELECT COUNT(id_pendaftaran) AS jumlah_kunjungan FROM pendaftaran WHERE tanggal_berobat BETWEEN '$dec_tanggal_awal' AND '$dec_tanggal_akhir' AND status_pendaftaran = 'Sukses' AND id_ruang_poli = '$id_ruang_poli'";
        $result5 = $conn->query($sql4);
        $data2 = $result5->fetch_assoc();
        $html .= '<p class="fs-12">Jumlah Kunjungan dari ' . format_date($dec_tanggal_awal) . ' sampai ' . format_date($dec_tanggal_akhir) . ' ' . $row['nama_ruang_poli'] . ' : <b>' . $data2['jumlah_kunjungan'] . ' Kunjungan</b></p>
                </section>';
    } else {
        $html .= '<p class="text-center fs-12">Tidak ada pasien yang melakukan pendaftaran ke ruang poli ini</p>
                </section>';
    }
}

$html .= '</section>';

$mpdf->WriteHTML($html);

$filename = "Laporan Kontak Tak Langsung Per Poli Periode " . format_date($dec_tanggal_awal) . " Sampai " . format_date($dec_tanggal_akhir) . ".pdf";
$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
