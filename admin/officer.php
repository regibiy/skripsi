<?php
$title = "Dasbor Pendaftaran";
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
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <div class="d-flex justify-content-between px-0 pb-2">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Petugas Puskesmas</p>
            <a href="add-officer.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Username</td>
                        <td>Nama</td>
                        <td>Password</td>
                        <td>Role</td>
                        <td>Status Petugas</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pitaw123</td>
                        <td>Pitawati</td>
                        <td>Pitaw123#</td>
                        <td>Petugas Pendaftaran</td>
                        <td>Aktif</td>
                        <td>
                            <a href="edit-officer.php" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Regi123</td>
                        <td>Regi Ridho Biyantomo</td>
                        <td>Regi123#</td>
                        <td>Petugas Rekam Medis</td>
                        <td>Aktif</td>
                        <td>
                            <a href="edit-officer.php" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
