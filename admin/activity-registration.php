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
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <div class="d-flex justify-content-between px-0 pb-2">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Informasi Kegiatan</p>
            <a href="add-activity-registration.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Judul</td>
                        <td>Gambar</td>
                        <td>Tanggal Unggah</td>
                        <td>Tanggal Edit</td>
                        <td>Pengunggah</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pemeriksaan Buah Hati</td>
                        <td><button class="btn btn-sm btn-outline-primary">Lihat Gambar</button></td>
                        <td>01-06-2023</td>
                        <td>03-06-2023</td>
                        <td>Pitaw123</td>
                        <td>
                            <a href="edit-activity-registration.php" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan USG</td>
                        <td><button class="btn btn-sm btn-outline-primary">Lihat Gambar</button></td>
                        <td>03-06-2023</td>
                        <td>Belum diedit</td>
                        <td>Pitaw123</td>
                        <td>
                            <a href="ecit-activity-registration.php" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
