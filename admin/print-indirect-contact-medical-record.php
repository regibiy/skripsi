<?php
// Require composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal-L']);
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
        <p class="title text-center">LAPORAN KONTAK TAK LANGSUNG PER POLI</p>
        <p class="sub-title text-center">dd-mm-yyyy sampai dd-mm-yyyy</p>
    </section>

    <section style="margin-top:16px;">
        <table class="data" border="1" style="width:100%;">
            <tr>
                <th rowspan="2" class="text-center">Tanggal Berobat</th>
                <th colspan="10" class="text-center">Ruang Poli</th>
                <th colspan="3" class="text-center">Status</th>
            </tr>
            <tr>
                <th class="text-center" style="padding: 0 5px; width:80;">Fisioterapi</th>
                <th class="text-center" style="padding: 0 5px; width:80;">Gizi</th>
                <th class="text-center" style="padding: 0 5px; width:80;">IMS</th>
                <th class="text-center" style="padding: 0 5px; width:80;">Imunisasi</th>
                <th class="text-center" style="padding: 0 5px; width:120;">Kesehatan Gigi dan Mulut</th>
                <th class="text-center" style="padding: 0 5px; width:80;">KIA KB</th>
                <th class="text-center" style="padding: 0 5px; width:80;">Kesling</th>
                <th class="text-center" style="padding: 0 5px; width:80;">Laktasi</th>
                <th class="text-center" style="padding: 0 5px; width:120;">Pemeriksaan Umum</th>
                <th class="text-center" style="padding: 0 5px; width:120;">Tindakan Umum</th>
                <th class="text-center" style="padding: 0 5px;">Jumlah</th>
                <th class="text-center" style="padding: 0 5px;">Sukses</th>
                <th class="text-center" style="padding: 0 5px;">Gagal</th>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px 0">dd-mm-yyyy</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
                <td class="text-center">9999</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px 0">02-06-2023</td>
                <td class="text-center">12</td>
                <td class="text-center">18</td>
                <td class="text-center">25</td>
                <td class="text-center">29</td>
                <td class="text-center">8</td>
                <td class="text-center">14</td>
                <td class="text-center">21</td>
                <td class="text-center">27</td>
                <td class="text-center">10</td>
                <td class="text-center">16</td>
                <td class="text-center">180</td>
                <td class="text-center">180</td>
                <td class="text-center">0</td>
            </tr>
            <tr>
                <td class="text-center" style="padding: 5px 0">03-06-2023</td>
                <td class="text-center">28</td>
                <td class="text-center">16</td>
                <td class="text-center">24</td>
                <td class="text-center">11</td>
                <td class="text-center">19</td>
                <td class="text-center">27</td>
                <td class="text-center">8</td>
                <td class="text-center">15</td>
                <td class="text-center">22</td>
                <td class="text-center">13</td>
                <td class="text-center">183</td>
                <td class="text-center">177</td>
                <td class="text-center">6</td>
            </tr>
            <tr>
                <th colspan="11" class="text-right" style="padding: 5px 0">Jumlah Kunjungan Bulan Ini : </th>
                <th colspan="3">709</th>
            </tr>
            <tr>
                <th colspan="11" class="text-right" style="padding: 5px 0">Jumlah Pendaftaran yang Sukses :</th>
                <th colspan="3">700</th>
            </tr>
            <tr>
                <th colspan="11" class="text-right" style="padding: 5px 0">Jumlah Pendaftaran yang Gagal :</th>
                <th colspan="3">9</th>
            </tr>
        </table>
    </section>

</div>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
