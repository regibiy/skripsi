<?php
$title = "Dasbor Pendaftaran";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "daftar") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Detail Nomor Kepala Keluarga 7383091434760008</p>
        <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
            <div class="col-lg-6 col-12">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-4">No Indeks</td>
                        <td class="fw-medium">912345</td>
                    </tr>
                    <tr>
                        <td class="col-4">Email</td>
                        <td class="fw-medium">fachriandika@gmail.com</td>
                    </tr>
                    <tr>
                        <td class="col-4">Kata Sandi</td>
                        <td class="fw-medium">200112345</td>
                    </tr>
                    <tr>
                        <td class="col-4">Kartu Keluarga</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#kk">Lihat KK</button>
                        </td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="kk" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7">Kartu Keluarga</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="assets/patient_data/KK.jpg" class="img-fluid" width="800" alt="kk" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-12">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-4">Alamat</td>
                        <td class="fw-medium">Jalan Pangeran Nata Kusuma No. 76</td>
                    </tr>
                    <tr>
                        <td class="col-4">RT</td>
                        <td class="fw-medium">004</td>
                    </tr>
                    <tr>
                        <td class="col-4">RW</td>
                        <td class="fw-medium">023</td>
                    </tr>
                    <tr class="col-4">
                        <td>Kelurahan / Desa</td>
                        <td class="fw-medium">Sungai Bangkong</td>
                    </tr>
                    <tr class="col-4">
                        <td>Kecamatan</td>
                        <td class="fw-medium">Pontianak Kota</td>
                    </tr>
                </table>
            </div>
        </div>

        <p class="fs-6 p-0 mt-3 mb-2 fw-medium">Detail Anggota Keluarga</p>

        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>No. Rekmed</td>
                        <td>NIK</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Agama</td>
                        <td>Pekerjaan</td>
                        <td>Status Hubungan</td>
                        <td>Nomor HP</td>
                        <td>KTP</td>
                        <td>Status Pasien</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#rekmed">00912345</button>
                            <!-- Modal starts-->
                            <div class="modal fade" id="rekmed" tabindex="-1">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7">Detail Nomor Rekam Medis 00912345</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body fs-7">
                                            <p class="text-dark-emphasis mb-0">NIK</p>
                                            <p class="text-secondary">2151331605010002</p>
                                            <p class="text-dark-emphasis mb-0">Tanggal Masuk</p>
                                            <p class="text-secondary">02-01-2023</p>
                                            <p class="text-dark-emphasis mb-0">Riwayat Alergi Obat</p>
                                            <p class="text-secondary">Paracetamol, Amoxicillin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal ends -->
                        </td>
                        <td>2151331605010002</td>
                        <td>Fachri Andika Permana</td>
                        <td>Pontianak</td>
                        <td>16-10-2001</td>
                        <td>Laki-Laki</td>
                        <td>Islam</td>
                        <td>PNS Guru</td>
                        <td>Kepala Keluarga</td>
                        <td>6281378300210</td>
                        <td class="text-secondary"><button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#ktpSuami">Lihat KTP</button></td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="ktpSuami" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP x-6-x</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                        <td>Dalam KK</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#rekmed2">10912345</button>
                            <!-- Modal starts-->
                            <div class="modal fade" id="rekmed2" tabindex="-1">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7">Detail Nomor Rekam Medis 10912345</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body fs-7">
                                            <p class="text-dark-emphasis mb-0">NIK</p>
                                            <p class="text-secondary">2151051910010007</p>
                                            <p class="text-dark-emphasis mb-0">Tanggal Masuk</p>
                                            <p class="text-secondary">18-02-2023</p>
                                            <p class="text-dark-emphasis mb-0">Riwayat Alergi Obat</p>
                                            <p class="text-secondary">Tidak ada</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal ends -->
                        </td>
                        <td>2151051910010007</td>
                        <td>Dewi Sari Pramudita</td>
                        <td>Pontianak</td>
                        <td>24-12-2002</td>
                        <td>Perempuan</td>
                        <td>Islam</td>
                        <td>Dokter</td>
                        <td>Istri</td>
                        <td>6281433002103</td>
                        <td class="text-secondary"><button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#ktpSuami">Lihat KTP</button></td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="ktpSuami" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP x-6-x</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                        <td>Dalam KK</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("views/index-footer.php");
