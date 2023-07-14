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

if (isset($_GET['idInformasi'])) {
    $enc_id_informasi = $_GET['idInformasi'];
    $dec_id_informasi = decrypt($enc_id_informasi);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='edit-activity-registration.php';
    </script>";
}

$sql = "SELECT * FROM informasi INNER JOIN dokter ON informasi.id_dokter = dokter.id_dokter WHERE id_informasi = '$dec_id_informasi'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$result_doctor = get_data("dokter");
while ($row = $result_doctor->fetch_assoc()) {
    $doctors[$row['id_dokter']] = $row['nama_dokter'];
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-4 px-2 py-3 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Edit Informasi Kegiatan</p>
        <form action="action-admin.php" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-start col-12 px-0 flex-wrap">
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                    <div class="col-12 fs-7">
                        <label for="judul" class="form-label form-label-sm">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="judul" name="judul" maxlength="50" value="<?= $data['judul'] ?>" required>
                        <input type="hidden" name="id_informasi" value="<?= $data['id_informasi'] ?>">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="deskripsi" class="form-label form-label-sm">Deskripsi <span class="text-danger">*</span></label>
                        <?php
                        $deskripsi2 = $data['deskripsi'];
                        $deskripsi_br = strip_tags($deskripsi2, '<br />'); //fungsi menghapus string dari variabel
                        ?>
                        <textarea class="form-control form-control-sm" name="deskripsi" id="deskripsi" cols="30" rows="3" maxlength="255" required><?= $deskripsi_br ?></textarea>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="gambarPrev" class="form-label form-label-sm">Gambar Saat Ini</label>
                        <button type="button" class="btn btn-sm btn-outline-secondary d-block" data-bs-toggle="modal" data-bs-target="#<?= $data['gambar'] ?>">
                            <img src="assets/images/<?= $data['gambar'] ?>" alt="gambar activity" class="img-fluid" width="50">
                        </button>
                        <input type="hidden" name="prev_gambar" value="<?= $data['gambar'] ?>">
                        <!-- Modal starts-->
                        <div class="modal fade" id="<?= $data['gambar'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">Gambar Informasi Kegiatan <?= $data['judul'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="assets/images/<?= $data['gambar'] ?>" class="img-fluid" width="400" alt="informasi kegiatan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    </div>
                    <div class="col-12 fs-7">
                        <label for="gambar" class="form-label form-label-sm">Gambar Baru</label>
                        <input type="file" class="form-control form-control-sm text-dark-emphasis" id="gambar" name="gambar">
                        <p class='fs-7 fst-italic text-secondary m-0'>*Kosongkan field ini jika gambar tidak diperbarui</p>
                    </div>
                </div>
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                    <div class="col-12 fs-7">
                        <label for="dokter" class="form-label form-label-sm">Dokter</label>
                        <select class="form-select form-select-sm text-dark-emphasis" name="dokter" id="dokter">
                            <?php
                            foreach ($doctors as $key => $value) {
                                $selected = ($key == $data['id_dokter']) ? "selected" : "";
                                echo "<option value='" . $key . "' . " . $selected . ">" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="tanggal" class="form-label form-label-sm">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="jam_mulai" class="form-label form-label-sm">Jam Mulai</label>
                        <input type="time" class="form-control form-control-sm" name="jam_mulai" id="jam_mulai" value="<?= $data['jam_mulai'] ?>" required>
                    </div>
                    <div class="col-12 fs-7">
                        <label for="jam_selesai" class="form-label form-label-sm">Jam Selesai</label>
                        <?php
                        if ($data['jam_selesai'] === "Selesai") {
                            echo "<input type='time' class='form-control form-control-sm' name='jam_selesai' id='jamSelesai' disabled>";
                            echo "</div>";
                            echo "<div class='col-12 fs-7'>";
                        ?>
                            <input class="form-check-input" type="checkbox" id="jamSelesaiNotknown" name="jam_selesai" value="Selesai" onclick="disabledJamSelesai()" checked>
                            <label class="form-check-label" for="jamSelesaiNotknown">Jam Selesai Tidak Diketahui</label>
                        <?php
                        } else {
                            echo "<input type='time' class='form-control form-control-sm' name='jam_selesai' id='jamSelesai' value='" . $data['jam_selesai'] . "'>";
                            echo "</div>";
                            echo "<div class='col-12 fs-7'>";
                        ?>
                            <input class="form-check-input" type="checkbox" id="jamSelesaiNotknown" name="jam_selesai" value="Selesai" onclick="disabledJamSelesai()">
                            <label class="form-check-label" for="jamSelesaiNotknown">Jam Selesai Tidak Diketahui</label>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 fs-7 d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-sm btn-primary" name="edit_informasi">Simpan</button>
                    <a href="activity-registration.php" class="btn btn-sm btn-outline-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

<?php
include("views/index-footer.php");
