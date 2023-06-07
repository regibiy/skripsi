<?php
// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
date_default_timezone_set("Asia/Jakarta");
$today = date("d-m-Y H:i:s");

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
                <td width="33%"><span style="font-weight: bold;"> dd-mm-yyyy hh:mm:ss </span></td>
                <td width="33%" align="center" style="font-weight: bold;"> 99/99 </td>
                <td width="33%" style="text-align: right; font-weight: bold;">x-30-x</td>
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
        <p class="sub-title text-center">dd-mm-yyyy sampai dd-mm-yyyy</p>
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
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">dd-mm-yyyy</td>
                <td class="text-center">999 Pendaftaran</td>
                <td class="text-center">999 Sukses</td>
                <td class="text-center">99 Gagal</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">dd-mm-yyyy</td>
                <td class="text-center">999 Pendaftaran</td>
                <td class="text-center">999 Sukses</td>
                <td class="text-center">99 Gagal</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px">dd-mm-yyyy</td>
                <td class="text-center">999 Pendaftaran</td>
                <td class="text-center">999 Sukses</td>
                <td class="text-center">99 Gagal</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran Bulan Ini :</th>
                <th>9999 Pendaftaran</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran yang Sukses :</th>
                <th>9999 Sukses</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right" style="padding: 5px">Total Pendaftaran yang Gagal :</th>
                <th>999 Gagal</th>
            </tr>
        </table>
    </section>

</div>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
