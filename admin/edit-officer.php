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

$enc_username = $_GET['username'];
$dec_username = decrypt($enc_username);

$sql = "SELECT * FROM petugas WHERE username = '$dec_username'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $username_edit = $row['username'];
    $nama_depan_edit = $row['nama_depan'];
    $nama_belakang_edit = $row['nama_belakang'];
    $password_edit = $row['password'];
    $role_edit = $row['role'];
    $status_edit = $row['status_petugas'];
    if ($role_edit === "kapus") $show_role = "Kepala Puskesmas";
    elseif ($role_edit === "daftar") $show_role = "Pendaftaran";
    elseif ($role_edit === "rekmed") $show_role = "Rekam Medis";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <form action="action-admin.php" method="post">
        <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
            <p class="fs-6 p-0 mb-2 fw-medium">Edit Daftar Petugas</p>
            <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
                <div class="col-lg-6 col-12">
                    <table class="table table-borderless mb-0 text-dark-emphasis">
                        <tr>
                            <td class="col-4">
                                <label for="username" class="form-label form-label-sm">Username</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm" name="username" id="username" value="<?= $username_edit ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="namaDepan" class="form-label form-label-sm">Nama Depan</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm" name="nama_depan" id="namaDepan" value="<?= $nama_depan_edit ?>" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="namaBelakang" class="form-label form-label-sm">Nama Belakang</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm" name="nama_belakang" id="namaBelakang" value="<?= $nama_belakang_edit ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4">
                                <label for="role" class="form-label form-label-sm">Role</label>
                            </td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <select name="role" id="role" class="form-select d form-select-sm">
                                        <?php
                                        if ($role_edit === "kapus") {
                                            echo "<option value='" . $role_edit . "'>" . $show_role . "</option>";
                                        } else {
                                            echo "<option value='" . $role_edit . "' hidden>" . $show_role . "</option>";
                                            echo "<option value='daftar'>Pendaftaran</option>";
                                            echo "<option value='rekmed'>Rekam Medis</option>";
                                        }
                                        ?>
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
                                    <input type="text" class="form-control form-control-sm" name="password" id="password" value="<?= $password_edit ?>" readonly>
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
                                        <?php
                                        echo "<option value='" . $status_edit . "' hidden>" . $status_edit . "</option>";
                                        ?>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non Aktif">Non Aktif</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="d-flex justify-content-center gap-3 my-3">
                        <button type="submit" class="btn btn-sm btn-primary" name="edit_petugas">Simpan</button>
                        <a href="officer.php" class="btn btn-sm btn-outline-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("views/index-footer.php");
