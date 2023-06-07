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
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Detail NIK 2151331605010002</p>
        <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
            <div class="col-lg-6 col-12">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-4">
                            <label for="nik" class="form-label form-label-sm">NIK</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="nik" id="nik" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="namaDepan" class="form-label form-label-sm">Nama Depan</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="nama_depan" id="namaDepan" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="namaBelakang" class="form-label form-label-sm">Nama Belakang</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="nama_belakang" id="namaBelakang">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="tempatLahir" class="form-label form-label-sm">Tempat Lahir</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="tempatLahir" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="tanggalLahir" class="form-label form-label-sm">Tanggal Lahir</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="date" class="form-control form-control-sm text-dark-emphasis" name="tanggal_lahir" id="tanggalLahir" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="jenisKelamin" class="form-label form-label-sm">Jenis Kelamin</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <select class="form-select form-select-sm text-dark-emphasis" name="jenis_kelamin" id="jenisKelamin">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </td>
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
                                <input type="number" class="form-control form-control-sm" name="rt" id="rt" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="rw" class="form-label form-label-sm">RW</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="number" class="form-control form-control-sm" name="rw" id="rw" required>
                            </div>
                        </td>
                    </tr>
                    <tr class="col-4">
                        <td>
                            <label for="kelurahanDesa" class="form-label form-label-sm">Kelurahan / Desa</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="kelurahan_desa" id="kelurahanDesa" required>
                            </div>
                        </td>
                    </tr>
                    <tr class="col-4">
                        <td>
                            <label for="kecamatan" class="form-label form-label-sm">Kecamatan</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" required>
                            </div>
                        </td>
                    </tr>
                    <tr class="col-4">
                        <td>
                            <label for="ktp" class="form-label form-label-sm">KTP</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <button type="button" class="btn btn-sm btn-primary fs-7" data-bs-toggle="modal" data-bs-target="#ktpSuami">Lihat KTP</button>
                                <!-- Modal starts-->
                                <div class="modal fade" id="ktpSuami" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-7" id="exampleModalLabel">KTP</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal ends -->
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
    </div>
</div>

<?php
include("views/index-footer.php");
