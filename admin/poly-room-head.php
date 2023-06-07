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
    <div class="row mt-4 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <div class="px-0 pb-2 fs-7 col-lg-3 col-sm-12 col-md-6">
            <p class="fs-6 p-0 mb-2 fw-medium">Kuota Pendaftaran</p>
            <div class="border d-flex flex-column gap-3 p-2 rounded">
                <label for="kuota" class="form-label form-label-sm mb-0">Kuota Tersedia</label>
                <input type="text" class="form-control form-control-sm" placeholder="50" required>
                <div>
                    <button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-outline-primary">Simpan</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between px-0 pb-2 mt-3">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Ruang Poli</p>
            <a href="add-poly-room-head.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Nama Ruang Poli</td>
                        <td>Gambar</td>
                        <td>Status Ruang Poli</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ruang Tindakan Umum</td>
                        <td class="text-secondary">
                            <button type="button" class="btn btn-sm btn-outline-primary fs-7" data-bs-toggle="modal" data-bs-target="#gambar">Lihat Gambar</button>
                        </td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="gambar" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP x-6-x</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="assets/patient_data/KTP.jpg" class="img-fluid" width="400" alt="ktp" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                        <td>Aktif</td>
                        <td>
                            <a href="edit-poly-room-head.php" class="btn btn-sm btn-primary">Edit</a>
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
