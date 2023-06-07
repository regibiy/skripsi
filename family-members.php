<?php
$title = "Anggota Keluarga";
include("action.php");
include("views/header.php");

$agama = array("---", "Budha", "Islam", "Hindu", "Katolik", "Konghucu", "Kristen");
$status_hubungan = array("---", "Suami", "Istri", "Anak 1", "Anak 2", "Anak 3", "Anak 4", "Anak 5", "Anak 6", "Anak 7", "Anak 8", "Anak 9");
?>
<!-- body starts -->
<!-- read data starts -->
<div class="container my-mtb-body shadow-sm rounded border py-3" id="read">
    <h1 class="text-dark-emphasis fs-6 text-center mb-5">Data Anggota Keluarga</h1>
    <div class="d-flex justify-content-between col-12 flex-wrap">
        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
            <h2 class="text-dark-emphasis fs-7 mb-0">
                Daftar Anggota Keluarga
                <!-- <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#nik_check">Tambah</button> -->
                <button class="btn btn-sm btn-outline-success fs-7" id="addFamilyMember">Tambah</button>
                <!-- modal edit contact starts-->
                <!-- <form action="">
                    <div class="modal fade" id="nik_check" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">NIK</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 fs-7">
                                        <label for="nikCheck" class="form-label form-label-sm">NIK Anggota Keluarga <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="nikCheck" id="nikCheckDua" placeholder="2151331605010002" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-success" id="addFamilyMember">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> -->
                <!-- modal edit contact ends -->
            </h2>
            <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fs-7 text-dark-emphasis fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo">
                            Fachri Andika Permana (Suami)
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <table class="table table-borderless fs-7 mb-0">
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">NIK</td>
                                    <td class="text-secondary">2151331605010002</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Nama Lengkap</td>
                                    <td class="text-secondary">Fachri Andika Permana</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Tempat Lahir</td>
                                    <td class="text-secondary">Pontianak</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Tanggal Lahir</td>
                                    <td class="text-secondary">16-10-2001</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Jenis Kelamin</td>
                                    <td class="text-secondary">Laki-Laki</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Agama</td>
                                    <td class="text-secondary">Islam</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Pekerjaan</td>
                                    <td class="text-secondary">PNS Guru</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">No. HP</td>
                                    <td class="text-secondary">6281378300210</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">KTP</td>
                                    <td class="text-secondary"><button type="button" class="btn btn-sm btn-success fs-7" data-bs-toggle="modal" data-bs-target="#ktpSuami">Lihat KTP</button></td>
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
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Status Pasien</td>
                                    <td class="text-secondary">Dalam KK</td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-sm btn-outline-success editFamilyMember">Edit</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fs-7 text-dark-emphasis fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree">
                            Dewi Sari Pramudita (Istri)
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <table class="table table-borderless fs-7 mb-0">
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">NIK</td>
                                    <td class="text-secondary">6171051710010005</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Nama Lengkap</td>
                                    <td class="text-secondary">Dewi Sari Pramudita</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Tempat Lahir</td>
                                    <td class="text-secondary">Pontianak</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Tanggal Lahir</td>
                                    <td class="text-secondary">24-12-2004</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Jenis Kelamin</td>
                                    <td class="text-secondary">Perempuan</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Agama</td>
                                    <td class="text-secondary">Islam</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Pekerjaan</td>
                                    <td class="text-secondary">Freelancer</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">No. HP</td>
                                    <td class="text-secondary">6281398300260</td>
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">KTP</td>
                                    <td class="text-secondary"><button type="button" class="btn btn-sm btn-success fs-7" data-bs-toggle="modal" data-bs-target="#ktpIstri">Lihat KTP</button></td>
                                    <!-- Modal starts-->
                                    <div class="modal fade" id="ktpIstri" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-7" id="exampleModalLabel">KTP Istri</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal ends -->
                                </tr>
                                <tr>
                                    <td class="text-dark-emphasis fw-medium">Status Pasien</td>
                                    <td class="text-secondary">Dalam KK</td>
                                </tr>
                                <tr>
                                    <td><button class="btn btn-sm btn-outline-success editFamilyMember">Edit</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7 mb-0">
                Data Kontak Kepala Keluarga
                <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editContact">Edit</button>
                <!-- modal edit contact starts-->
                <form action="">
                    <div class="modal fade" id="editContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Kontak Kepala Keluarga</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 fs-7">
                                        <label for="email" class="form-label form-label-sm">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="fachriandikap@gmail.com" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- modal edit contact ends -->
            </h2>
            <div class="col-12 mb-2">
                <label for="email" class="form-label form-label-sm fs-7">Email <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">fachriandikap@gmail.com</p>
            </div>
            <h2 class="text-dark-emphasis fs-7 my-0">
                Data Pendukung
                <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editSupport">Edit</button>
                <!-- modal edit data support starts -->
                <div class="modal fade" id="editSupport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Pendukung</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 fs-7">
                                    <label for="editKk" class="form-label form-label-sm">Kartu Keluarga <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-sm" name="editKk" id="editKk" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                <a href="family-members.php" class="btn btn-sm btn-success">Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal edit data support ends -->
            </h2>
            <div class="col-12 fs-7">
                <label for="noKk" class="form-label form-label-sm">Nomor KK <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">7383091434760008</p>
            </div>
            <div class="col-12 mb-4">
                <label for="kk" class="form-label form-label-sm fs-7">Kartu Keluarga <span class="text-danger">*</span></label>
                <br />
                <button type="button" class="btn btn-sm btn-success fs-7" data-bs-toggle="modal" data-bs-target="#kk">Lihat KK</button></td>
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
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7 mb-0">Data Domisili
                <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editDomisili">Edit</button>
                <!-- modal edit data domisili starts -->
                <div class="modal fade" id="editDomisili" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Domisili</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body fs-7">
                                <div class="d-flex flex-column align-items-start col-12 gap-3">
                                    <div class="col-12">
                                        <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" placeholder="Jalan Pangeran Nata Kusuma No. 76" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="rt" class="form-label form-label-sm">RT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="rt" id="rt" placeholder="004" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="rw" class="form-label form-label-sm">RW <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="rw" id="rw" placeholder="023" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="kel_desa" class="form-label form-label-sm">Kelurahan / Desa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="kel_desa" id="kel_desa" placeholder="Sungai Bangkong" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="kecamatan" class="form-label form-label-sm">Kecamatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                <a href="family-members.php" class="btn btn-sm btn-success">Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal edit data domisili ends -->
            </h2>
            <div class="col-12">
                <label for="alamat" class="form-label form-label-sm fs-7">Alamat <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">Jalan Pangeran Nata Kusuma No. 76</p>
            </div>
            <div class="col-12">
                <label for="rt" class="form-label form-label-sm fs-7">RT <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">004</p>
            </div>
            <div class="col-12">
                <label for="rw" class="form-label form-label-sm fs-7">RW <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">023</p>
            </div>
            <div class="col-12">
                <label for="kel_desa" class="form-label form-label-sm fs-7">Kelurahan / Desa <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">Sungai Bangkong</p>
            </div>
            <div class="col-12">
                <label for="kecamatan" class="form-label form-label-sm fs-7">Kecamatan <span class="text-danger">*</span></label>
                <p class="text-secondary fs-7 mb-0">Pontianak Kota</p>
            </div>
        </div>
    </div>
</div>
<!-- read data ends -->

<!-- add data starts -->
<div class="container my-mtb-body shadow-sm rounded border py-3" id="add">
    <h1 class="text-dark-emphasis fs-6 text-center mb-5">Tambah Anggota Keluarga</h1>
    <!-- <p class="bg-danger p-1 text-white fs-7 rounded">Pesan keberhasilan dan kegagalan</p> -->
    <div class="d-flex justify-content-between col-12 flex-wrap">
        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Identitas Anggota Keluarga</h2>
            <div class="col-12 fs-7">
                <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                <p class="text-dark-emphasis mb-0">2151331605010002</p>
                <!-- <input type="text" class="form-control form-control-sm text-dark-emphasis" name="nik" id="nik" placeholder="6171051710010005" required> -->
            </div>
            <div class="col-12">
                <label for="nama_depan" class="form-label form-label-sm fs-7">Nama Depan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="nama_depan" id="nama_depan" placeholder="Dewi Sari" required>
            </div>
            <div class="col-12">
                <label for="nama_belakang" class="form-label form-label-sm fs-7">Nama Belakang</label>
                <input type="text" class="form-control form-control-sm fs-7" name="nama_belakang" id="nama_belakang" placeholder="Pramudita">
            </div>
            <div class="col-12">
                <label for="tempat_lahir" class="form-label form-label-sm fs-7">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="tempat_lahir" id="tempat_lahir" placeholder="Pontianak" required>
            </div>
            <div class="col-12 my-gap-6">
                <label for="tanggal_lahir" class="form-label form-label-sm fs-7">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-sm fs-7" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
            <h2 class="text-dark-emphasis fs-7">Data Sosial Anggota Keluarga</h2>
            <div class="col-12">
                <label for="jenis_kelamin" class="form-label form-label-sm fs-7">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="" selected>---</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-12">
                <label for="agama" class="form-label form-label-sm fs-7">Agama <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="agama" id="agama" required>
                    <?php
                    foreach ($agama as $value) {
                        echo "<option value=" . $value . ">" . $value . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <label for="pekerjaan" class="form-label form-label-sm fs-7">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="pekerjaan" id="pekerjaan" placeholder="Dokter Umum" required>
            </div>
            <div class="col-12">
                <label for="status_hubungan" class="form-label form-label-sm fs-7">Status Hubungan <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="status_hubungan" id="status_hubungan" required>
                    <?php
                    foreach ($status_hubungan as $value) {
                        echo "<option value=" . $value . ">" . $value . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Kontak Anggota Keluarga</h2>
            <div class="col-12">
                <label for="no_hp" class="form-label form-label-sm fs-7">No. HP</label>
                <input type="text" class="form-control form-control-sm fs-7" name="no_hp" id="no_hp" placeholder="6285312987634" required>
            </div>
            <h2 class="text-dark-emphasis fs-7 mt-4">Data Pendukung</h2>
            <div class="col-12">
                <label for="ktp" class="form-label form-label-sm fs-7">Kartu Tanda Penduduk</label>
                <input type="file" class="form-control form-control-sm fs-7" name="ktp" id="ktp" required>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                <a href="family-members.php" class="btn btn-sm btn-outline-success d-block">Batal</a>
            </div>
        </div>
    </div>
</div>
<!-- add data ends -->

<!-- edit data starts -->
<div class="container my-mtb-body shadow-sm rounded border pt-3" id="edit">
    <h1 class="text-dark-emphasis fs-6 text-center mb-5">Edit Anggota Keluarga</h1>
    <!-- <p class="bg-danger p-1 text-white fs-7 rounded">Pesan keberhasilan dan kegagalan</p> -->
    <div class="d-flex justify-content-between col-12 flex-wrap">
        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Identitas Anggota Keluarga</h2>
            <div class="col-12 fs-7">
                <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK <span class="text-danger">*</span></label>
                <p class="text-dark-emphasis mb-0">2151331605010002</p>
            </div>
            <div class="col-12">
                <label for="nama_depan" class="form-label form-label-sm fs-7">Nama Depan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="nama_depan" id="nama_depan" placeholder="Regi Ridho" required>
            </div>
            <div class="col-12">
                <label for="nama_belakang" class="form-label form-label-sm fs-7">Nama Belakang</label>
                <input type="text" class="form-control form-control-sm fs-7" name="nama_belakang" id="nama_belakang" placeholder="Biyantomo">
            </div>
            <div class="col-12">
                <label for="tempat_lahir" class="form-label form-label-sm fs-7">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="tempat_lahir" id="tempat_lahir" placeholder="Pontianak" required>
            </div>
            <div class="col-12 my-gap-6">
                <label for="tanggal_lahir" class="form-label form-label-sm fs-7">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-sm fs-7" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 my-gap-6">
            <h2 class="text-dark-emphasis fs-7">Data Sosial Anggota Keluarga</h2>
            <div class="col-12">
                <label for="jenis_kelamin" class="form-label form-label-sm fs-7">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="" selected>---</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-12">
                <label for="agama" class="form-label form-label-sm fs-7">Agama <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="agama" id="agama" required>
                    <?php
                    foreach ($agama as $value) {
                        echo "<option value=" . $value . ">" . $value . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <label for="pekerjaan" class="form-label form-label-sm fs-7">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="pekerjaan" id="pekerjaan" placeholder="Pelajar/Mahasiswa" required>
            </div>
            <div class="col-12">
                <label for="status_hubungan" class="form-label form-label-sm fs-7">Status Hubungan <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="status_hubungan" id="status_hubungan" required>
                    <?php
                    foreach ($status_hubungan as $value) {
                        echo "<option value=" . $value . ">" . $value . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <label for="status_hubungan" class="form-label form-label-sm fs-7">Status Pasien <span class="text-danger">*</span></label>
                <select class="form-select form-select-sm fs-7" name="status_hubungan" id="status_hubungan" required>
                    <option value="Dalam KK">Dalam KK</option>
                    <option value="Luar KK">Luar KK</option>
                </select>
            </div>
        </div>

        <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
            <h2 class="text-dark-emphasis fs-7">Data Kontak Anggota Keluarga</h2>
            <div class="col-12">
                <label for="no_hp" class="form-label form-label-sm fs-7">No. HP <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm fs-7" name="no_hp" id="no_hp" placeholder="6281398300260" required>
            </div>
            <h2 class="text-dark-emphasis fs-7 mt-4">Data Pendukung</h2>
            <div class="col-12">
                <label for="ktp" class="form-label form-label-sm fs-7">Kartu Tanda Penduduk Anggota Keluarga</label>
                <input type="file" class="form-control form-control-sm fs-7" name="ktp" id="ktp" required>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                <a href="family-members.php" class="btn btn-sm btn-outline-success d-block">Batal</a>
            </div>
        </div>
    </div>
</div>
<!-- edit data ends -->
<!-- body ends -->


<?php
include("views/footer.php");
