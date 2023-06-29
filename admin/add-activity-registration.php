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
    <div class="row mt-3 mb-4 px-2 py-3 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Tambah Informasi Kegiatan</p>
        <form action="action-admin.php" method="post" enctype="multipart/form-data" onsubmit="return validasiFormInformasi()">
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<p class='bg-danger text-white fs-7 py-1 px-2 rounded'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            }
            ?>
            <p id="alert" class="bg-danger text-white fs-7 py-1 px-2 rounded" style="display: none;"></p>
            <div class="d-flex justify-content-between align-items-start col-12 px-0 flex-wrap">
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                    <div class="col-12 fs-7">
                        <label for="judul" class="form-label form-label-sm">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="judul" name="judul" maxlength="50" placeholder="Pemeriksaan Buah Hati" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="deskripsi" class="form-label form-label-sm">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="deskripsi" id="deskripsi" cols="30" rows="3" maxlength="255" placeholder="Konsultasikan buah hati anda..." required></textarea>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="gambar" class="form-label form-label-sm">Gambar <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm" id="gambar" name="gambar" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="dokter" class="form-label form-label-sm">
                            Dokter <span class="text-danger">*</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#tambahDokter">Tambah</button>
                            <a href="edit-doctor-registration.php" class="btn btn-sm btn-outline-secondary fs-7" id="idDokterEdit">Edit</a>
                        </label>
                        <select class="form-select form-select-sm" name="dokter" id="dokter">
                            <option value="---" hidden selected>Silakan pilih dokter</option>
                            <?php
                            $result = get_data("dokter");
                            while ($row = $result->fetch_assoc()) {
                                $enc_id_dokter = encrypt($row['id_dokter']);
                                $id_dokter = urlencode($enc_id_dokter);
                                echo "<option value='" . $id_dokter . " " . $enc_id_dokter . "'>" . $row['nama_dokter'] . " | " . $row['spesialisasi'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="id_dokter" id="idDokter">
                    </div>
                </div>
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                    <div class="col-12 fs-7">
                        <label for="tanggal" class="form-label form-label-sm">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="jam_mulai" class="form-label form-label-sm">Jam Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control form-control-sm" name="jam_mulai" id="jam_mulai" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="jamSelesai" class="form-label form-label-sm">Jam Selesai</label>
                        <input type="time" class="form-control form-control-sm" name="jam_selesai" id="jamSelesai">
                    </div>
                    <div class="col-12 fs-7">
                        <input class="form-check-input" type="checkbox" id="jamSelesaiNotknown" name="jam_selesai" value="Selesai" onclick="disabledJamSelesai()">
                        <label class="form-check-label" for="jamSelesaiNotknown">Jam Selesai Tidak Diketahui</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-2">
                <button type="submit" class="btn btn-sm btn-primary" name="tambah_informasi">Simpan</button>
                <a href="activity-registration.php" class="btn btn-sm btn-outline-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- modal tambah dokter starts -->
<div class="modal fade" id="tambahDokter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Tambah Data Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="restartTambahDokter()"></button>
            </div>
            <form action="action-admin.php" method="post" onsubmit="return validasiFormDokter()">
                <div class="modal-body fs-7">
                    <p id="alertModal" class="bg-danger text-white py-1 px-2 fs-7 rounded" style="display: none;"></p>
                    <div class="d-flex flex-column align-items-start col-12 gap-3">
                        <div class="col-12">
                            <label for="nama" class="form-label form-label-sm">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="drg. Regi Ridho Biyantomo" autocomplete="off">
                        </div>
                        <div class="col-12">
                            <label for="spesialisasi" class="form-label form-label-sm">Spesialisasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="spesialisasi" id="spesialisasi" placeholder="Gigi" autocomplete="off">
                        </div>
                        <div class="col-12">
                            <label for="noHp" class="form-label form-label-sm">Nomor HP <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" name="noHp" id="noHp" placeholder="628991332811">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" placeholder="Jalan HM. Suwignyo"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal" onclick="restartTambahDokter()">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="tambah_dokter">Simpan</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal tambah dokter ends -->

<?php
include("views/index-footer.php");
