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

if (!isset($_GET['idDokter'])) {
    echo "<script>
    alert('Silakan pilih dokter untuk diedit terlebih dahulu!');
    window.location='add-activity-registration.php';
    </script>";
} else {
    $enc_id_dokter = $_GET['idDokter'];
    $dec_id_dokter = decrypt($enc_id_dokter);
}

$sql = "SELECT * FROM dokter WHERE id_dokter = '$dec_id_dokter'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Edit Dokter</p>
        <form action="action-admin.php" method="post">
            <div class="d-flex justify-content-between align-items-start col-12 px-0 flex-wrap">
                <div class="d-flex flex-column fs-7 col-lg-5 col-12 border p-2 mb-3 gap-3 text-dark-emphasis rounded">
                    <div class="col-12 fs-7">
                        <label for="nama" class="form-label form-label-sm">Nama <span class="text-danger">*</span></label>
                        <input type="hidden" name="id_dokter" value="<?= $dec_id_dokter ?>">
                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" maxlength="60" value="<?= $data['nama_dokter'] ?>" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="spesialisasi" class="form-label form-label-sm">Spesialisasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="spesialisasi" name="spesialisasi" maxlength="30" value="<?= $data['spesialisasi'] ?>" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="noHp" class="form-label form-label-sm">Nomor Hp <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm" id="noHp" name="no_hp" maxlength="15" value="<?= $data['no_hp'] ?>" required autocomplete="off">
                    </div>
                    <div class="col-12 fs-7">
                        <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="3" maxlength="150" required><?= $data['alamat'] ?></textarea>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-sm btn-primary" name="edit_dokter">Simpan</button>
                        <a href="add-activity-registration.php" class="btn btn-sm btn-outline-danger">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("views/index-footer.php");
