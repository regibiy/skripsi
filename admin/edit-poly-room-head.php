<?php
$title = "Dasbor Kepala Puskesmas";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "kapus") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$enc_id_ruang = $_GET['idruang'];
$dec_id_ruang = decrypt($enc_id_ruang);

$sql = "SELECT * FROM ruang_poli WHERE id_ruang_poli = '$dec_id_ruang'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $id_ruang = $row['id_ruang_poli'];
    $nama_ruang = $row['nama_ruang_poli'];
    $gambar_ruang = $row['gambar_ruang_poli'];
    $status_ruang = $row['status_ruang_poli'];
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <form action="action-admin.php" method="post" enctype="multipart/form-data">
        <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
            <p class="fs-6 p-0 mb-2 fw-medium">Edit Ruang Poli</p>
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<p class='bg-danger p-1 text-white fs-7 rounded'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            }
            ?>
            <p id="alert" class="bg-danger p-1 text-white fs-7 rounded" style="display: none;"></p>
            <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
                <div class="col-lg-7 col-12">
                    <table class="table table-borderless mb-0 text-dark-emphasis">
                        <tr>
                            <td class="col-4">
                                <label for="nama" class="form-label form-label-sm">Nama</label>
                            </td>
                            <td>
                                <div class="col-12">
                                    <input type="hidden" name="id_ruang" value="<?= $id_ruang ?>">
                                    <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="<?= $nama_ruang ?>" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="gambarPrev" class="form-label form-label-sm">Gambar Saat Ini</label>
                            </td>
                            <td>
                                <input type="hidden" id="gambarPrev" name="prev_image" value="<?= $gambar_ruang ?>">
                                <button type="button" class="btn btn-sm btn-outline-secondary d-block" data-bs-toggle="modal" data-bs-target="#<?= $gambar_ruang ?>">
                                    <img src="assets/images/<?= $gambar_ruang ?>" alt="gambar ruang" class="img-fluid" width="50">
                                </button>
                                <!-- modal starts -->
                                <div class="modal fade" id="<?= $gambar_ruang ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-7" id="exampleModalLabel">Gambar <?= $nama_ruang ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="assets/images/<?= $gambar_ruang ?>" class="img-fluid" width="400" alt="gambar ruang" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="gambar" class="form-label form-label-sm">Gambar Baru</label>
                            </td>
                            <td>
                                <div class="col-12">
                                    <input type="file" class="form-control form-control-sm" name="gambar" id="gambar">
                                    <p class="fs-7 mb-0 fst-italic text-secondary">*Kosongkan field ini jika gambar tidak diperbarui</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="status" class="form-label form-label-sm">Status</label>
                            </td>
                            <td>
                                <div class="col-12">
                                    <select name="status" id="status" class="form-select form-select-sm text-dark-emphasis">
                                        <option value="<?= $status_ruang ?>" hidden><?= $status_ruang ?></option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non Aktif">Non Aktif</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-center gap-3 my-3">
                        <button type="submit" class="btn btn-sm btn-primary" name="edit_ruang">Simpan</button>
                        <a href="poly-room-head.php" class="btn btn-sm btn-outline-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("views/index-footer.php");
