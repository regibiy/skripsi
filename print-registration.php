<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
date_default_timezone_set("Asia/Jakarta");

// Write some HTML code:
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
                <td>x-5-x</td>
            </tr>
            <tr>
                <td width="200">Nama</td>
                <td>x-60-x</td>
            </tr>
            <tr>
                <td width="200">Umur</td>
                <td>99 Tahun</td>
            </tr>
            <tr>
                <td width="200">Alamat</td>
                <td>x-150-x</td>
            </tr>
            <tr>
                <td width="200">Nomor HP</td>
                <td>x-15-x</td>
            </tr>
            <tr>
                <td width="200">Tanggal Daftar</td>
                <td>dd-mm-yyyy</td>
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
                <td>x-30-x</td>
            </tr>
            <tr>
                <td width="200">Tanggal Berobat</td>
                <td>dd-mm-yyyy</td>
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
$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
