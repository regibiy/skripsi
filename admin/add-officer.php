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
    <form action="action-admin.php" method="post" onsubmit="return validasiFormTambahPetugas()">
        <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
            <p class="fs-6 p-0 mb-2 fw-medium">Tambah Petugas Puskesmas</p>
            <p class="bg-danger text-white fs-7 p-1 rounded" id="alert" style="display: none;"></p>
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<p class='bg-danger text-white fs-7 p-1 rounded'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            }
            ?>
            <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
                <div class="col-lg-6 col-12">
                    <table class="table table-borderless mb-0 text-dark-emphasis">
                        <tr>
                            <td class="col-4">
                                <label for="username" class="form-label form-label-sm">Username</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm" name="username" id="username" maxlength="50" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="namaDepan" class="form-label form-label-sm">Nama Depan</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <?php
                                    if (isset($_SESSION['nama_depan'])) {
                                        echo "<input type='text' class='form-control form-control-sm' name='nama_depan' id='namaDepan' maxlength='30' value='" . $_SESSION['nama_depan'] . "' required>";
                                        unset($_SESSION['nama_depan']);
                                    } else {
                                        echo "<input type='text' class='form-control form-control-sm' name='nama_depan' id='namaDepan' maxlength='30' required>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="namaBelakang" class="form-label form-label-sm">Nama Belakang</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <?php
                                    if (isset($_SESSION['nama_belakang'])) {
                                        echo "<input type='text' class='form-control form-control-sm' name='nama_belakang' id='namaBelakang' maxlength='30' value='" . $_SESSION['nama_belakang'] . "'";
                                        unset($_SESSION['nama_belakang']);
                                    } else {
                                        echo "<input type='text' class='form-control form-control-sm' name='nama_belakang' id='namaBelakang' maxlength='30'>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="role" class="form-label form-label-sm">Role</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <select name="role" id="role" class="form-select form-select-sm text-dark-emphasis">
                                        <option value="">---</option>
                                        <option value="daftar">Pendaftaran</option>
                                        <option value="rekmed">Rekam Medis</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="password" class="form-label form-label-sm">Password</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm" name="password" id="password" readonly>
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
                    </table>
                    <div class="d-flex justify-content-center gap-3 my-2">
                        <button type="submit" class="btn btn-sm btn-primary" name="tambah_petugas">Simpan</button>
                        <a href="officer.php" class="btn btn-sm btn-outline-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("views/index-footer.php");
