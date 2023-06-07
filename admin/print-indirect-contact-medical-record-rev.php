<?php
// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
date_default_timezone_set("Asia/Jakarta");
$today = date("d-m-Y H:i:s");

// Write some HTML code: {PAGENO}/{nbpg}
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
</style>
<div>
    <htmlpagefooter name="MyFooter1">
        <table width="100%">
            <tr>
                <td width="33%"><span style="font-weight: bold;"> 13-06-2023 08:00:12 </span></td>
                <td width="33%" align="center" style="font-weight: bold;"> 1/1 </td>
                <td width="33%" style="text-align: right; font-weight: bold;">Regi123</td>
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
        <p class="sub-title text-center">01-06-2023 sampai 06-07-2023</p>
    </section>
        
    <section style="margin-top:16px;">
        <p class="poly-title text-center">RUANG FISIOTERAPI</p>
        <table class="data" border="1" style="width:100%;">
            <tr>
                <th rowspan="2" class="text-center">Tanggal Berobat</th>
                <th rowspan="2" class="text-center">Jumlah Kunjungan</th>
                <th colspan="2" class="text-center">Status</th>
            </tr>
            <tr>
                <th class="text-center">Sukses</th>
                <th class="text-center">Gagal</th>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">01-06-2023</td>
                <td class="text-center">14 Kunjungan</td>
                <td class="text-center">14 Sukses</td>
                <td class="text-center">0 Gagal</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">02-06-2023</td>
                <td class="text-center">6 Kunjungan</td>
                <td class="text-center">2 Sukses</td>
                <td class="text-center">4 Gagal</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">03-06-2023</td>
                <td class="text-center">10 Kunjungan</td>
                <td class="text-center">10 Sukses</td>
                <td class="text-center">0 Gagal</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Kunjungan Bulan Ini :</th>
                <th>30 Kunjungan</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Kunjungan yang Sukses :</th>
                <th>26 Sukses</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Kunjungan yang Gagal :</th>
                <th>4 Gagal</th>
            </tr>
        </table>
    </section>

</div>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
