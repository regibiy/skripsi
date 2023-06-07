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
include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Tambah Ruang Poli</p>
        <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
            <div class="col-lg-6 col-12">
                <table class="table table-borderless mb-0 text-dark-emphasis">
                    <tr>
                        <td class="col-4">
                            <label for="nama" class="form-label form-label-sm">Nama</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="gambar" class="form-label form-label-sm">Gambar</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-4">
                            <label for="status" class="form-label form-label-sm">Status</label>
                        </td>
                        <td>
                            <div class="col-lg-8 col-12">
                                <select name="status" id="status" class="form-select form-select-sm text-dark-emphasis">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="d-flex justify-content-center gap-3 my-3">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                    <button class="btn btn-sm btn-outline-danger">Batal</button>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include("views/index-footer.php");
