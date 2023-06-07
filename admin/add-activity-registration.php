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
    <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Tambah Informasi Kegiatan</p>
        <div class="d-flex justify-content-between align-items-start col-12 px-0 flex-wrap">
            <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                <div class="col-12 fs-7">
                    <label for="judul" class="form-label form-label-sm">Judul</label>
                    <input type="text" class="form-control form-control-sm" id="judul" name="judul" maxlength="50" placeholder="Pemeriksaan Buah Hati" required>
                </div>
                <div class="col-12 fs-7">
                    <label for="deskripsi" class="form-label form-label-sm">Deskripsi</label>
                    <textarea class="form-control form-control-sm" name="deskripsi" id="deskripsi" cols="30" rows="3" maxlength="255" placeholder="Konsultasikan buah hati anda..." required></textarea>
                </div>
                <div class="col-12 fs-7">
                    <label for="gambar" class="form-label form-label-sm">Gambar</label>
                    <input type="file" class="form-control form-control-sm" id="gambar" name="gambar" required>
                </div>
                <div class="col-12 fs-7">
                    <label for="dokter" class="form-label form-label-sm">
                        Dokter
                        <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#tambahDokter">Tambah</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#editDokter">Edit</button>
                        <!-- modal tambah dokter starts -->
                        <div class="modal fade" id="tambahDokter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Tambah Data Dokter</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body fs-7">
                                        <div class="d-flex flex-column align-items-start col-12 gap-3">
                                            <div class="col-12">
                                                <label for="nama" class="form-label form-label-sm">Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="drg. Regi Ridho Biyantomo" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="spesialisasi" class="form-label form-label-sm">Spesialisasi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="spesialisasi" id="spesialisasi" placeholder="Gigi" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="noHp" class="form-label form-label-sm">Nomor HP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="noHp" id="noHp" placeholder="628991332811" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" placeholder="Jalan HM. Suwignyo" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                                        <a href="family-members.php" class="btn btn-sm btn-primary">Simpan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal tambah dokter ends -->
                        <!-- modal edit dokter starts -->
                        <div class="modal fade" id="editDokter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Dokter</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body fs-7">
                                        <div class="d-flex flex-column align-items-start col-12 gap-3">
                                            <div class="col-12">
                                                <label for="editNama" class="form-label form-label-sm">Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="editNama" id="editNama" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="editSpesialisasi" class="form-label form-label-sm">Spesialisasi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="editSpesialisasi" id="editSpesialisasi" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="editNoHp" class="form-label form-label-sm">Nomor HP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="editNoHp" id="editNoHp" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="editAlamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                                                <textarea class="form-control form-control-sm" name="editAlamat" id="editAlamat" rows="3" required></textarea>
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
                        <!-- modal edit dokter ends -->
                    </label>
                    <select class="form-select form-select-sm" name="dokter" id="dokter">
                        <option value="1">dr. Rosyadi Akbari, M.Sc., Sp.A.</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                <div class="col-12 fs-7">
                    <label for="tanggal" class="form-label form-label-sm">Tanggal</label>
                    <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" required>
                </div>
                <div class="col-12 fs-7">
                    <label for="jam_mulai" class="form-label form-label-sm">Jam Mulai</label>
                    <input type="time" class="form-control form-control-sm" name="jam_mulai" id="jam_mulai" required>
                </div>
                <div class="col-12 fs-7">
                    <label for="jam_selesai" class="form-label form-label-sm">Jam Selesai</label>
                    <input type="time" class="form-control form-control-sm" name="jam_selesai" id="jam_selesai">
                </div>
                <div class="col-12 fs-7">
                    <input class="form-check-input" type="checkbox" id="jam_selesai_notknown">
                    <label class="form-check-label" for="jam_selesai_notknown">Jam Selesai Tidak Diketahui</label>
                </div>
                <div class="col-12 fs-7">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                    <button class="btn btn-sm btn-outline-danger">Batal</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
