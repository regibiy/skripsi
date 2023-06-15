<?php
$title = "Dasbor Rekam Medis";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "rekmed") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Detail Nomor Kepala Keluarga 7383091434760008</p>
        <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
            <div class="col-lg-6 col-12">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="col-4">
                            <label for="noKk" class="form-label form-label-sm">Nomor KK</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="no_kk" id="noKk" placeholder="7383091434760008" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="noIndeks" class="form-label form-label-sm">Nomor Indeks</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="no_indeks" id="noIndeks" placeholder="912345" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="noIndeks" class="form-label form-label-sm">Email</label>
                        </td>
                        <td class="fw-semibold text-secondary">fachriandika@gmail.com</td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="password" class="form-label form-label-sm">Kata Sandi</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="password" id="password" placeholder="200112345" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="Kk" class="form-label form-label-sm">Kartu Keluarga</label>
                        </td>
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
                        <td class="col-4">
                            <label for="alamat" class="form-label form-label-sm">Alamat</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <textarea class="form-control form-control-sm text-dark-emphasis" name="alamat" id="alamat" rows="3" placeholder="Jalan Pangeran Nata Kusuma No. 76" required></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="rt" class="form-label form-label-sm">RT</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="rt" id="rt" placeholder="004" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="rw" class="form-label form-label-sm">RW</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="rw" id="rw" placeholder="023" required>
                            </div>
                        </td>
                    </tr>
                    <tr class="col-4">
                        <td>
                            <label for="kelurahanDesa" class="form-label form-label-sm">Kelurahan / Desa</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="kelurahan_desa" id="kelurahanDesa" placeholder="Sungai Bangkong" required>
                            </div>
                        </td>
                    </tr>
                    <tr class="col-4">
                        <td>
                            <label for="kecamatan" class="form-label form-label-sm">Kecamatan</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" required>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="d-flex justify-content-center col-12 mb-2 gap-3">
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-outline-primary">Simpan</button>
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
                            <div class="modal fade" id="rekmed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7">Detail Nomor Rekam Medis 00912345</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body fs-7">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="fs-7">
                                                    <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK</label>
                                                    <p class="text-secondary mb-0">2151331605010002</p>
                                                </div>
                                                <div class="fs-7">
                                                    <label for="tanggalMasuk" class="form-label form-label-sm text-dark-emphasis">Tanggal Masuk</label>
                                                    <input type="date" class="form-control form-control-sm text-secondary" name="tanggal_masuk" required>
                                                </div>
                                                <div class="fs-7">
                                                    <label for="riwayatAlergiObat" class="form-label form-label-sm text-dark-emphasis">Riwayat Alergi Obat</label>
                                                    <textarea class="form-control form-control-sm" name="riwayat_alergi_obat" id="riwayatAlergiObat" rows="3"></textarea>
                                                </div>
                                                <div class="fs-7">
                                                    <button class="btn btn-sm btn-primary">Edit</button>
                                                    <button class="btn btn-sm btn-outline-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal ends -->
                        </td>
                        <td><a href="edit-patient-medical-record.php" class="text-decoration-none">2151331605010002</a></td>
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
                        <td><a href="edit-patient-medical-record.php" class="text-decoration-none">2151051910010007</a></td>
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
