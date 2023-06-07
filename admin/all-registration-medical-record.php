<?php
$title = "Dasbor Rekam Medis";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "rekmed") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 my-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pendaftaran</p>
        <div class="d-flex flex-column fs-7 col-lg-5 col-12 border mb-2 p-2 gap-2 rounded">
            <div class="d-flex gap-3">
                <input type="date" class="form-control form-control-sm">
                <p class="mb-0">Sampai Dengan</p>
                <input type="date" class="form-control form-control-sm">
                <button class="btn btn-sm btn-primary">Terapkan</button>
            </div>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Nomor Antrian</td>
                        <td>Tanggal Daftar</td>
                        <td>Data Pasien</td>
                        <td>Ruang Poli</td>
                        <td>Tanggal Berobat</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">O0001</td>
                        <td>03-06-2023</td>
                        <td>
                            <p class="mb-0"><a href="detail-patient-registration.php" class="text-decoration-none">00923456</a> | Fachri Andika | 27 Tahun</p>
                            <p class="mb-0">6281356300160</p>
                            <p class="mb-0">Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Pemeriksaan Umum</td>
                        <td>05-06-2023</td>
                        <td><span class="status p-1 rounded">Selesai</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#O001">Status</button>
                        </td>
                        <!-- modal edit contact starts-->
                        <form action="">
                            <div class="modal fade" id="O001" data-bs-backdrop="static" tabindex="-1">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 fs-7">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Diproses" checked>
                                                    <label class="form-check-label" for="exampleRadios1">Sukses</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Selesai">
                                                    <label class="form-check-label" for="exampleRadios2">Gagal</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </tr>
                    <tr>
                        <td class="fw-semibold">O0002</td>
                        <td>04-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">10923456</a> | Dewi Sari | 25 Tahun</p>
                            <p class="mb-0">6281433002103</p>
                            <p class="mb-0"> Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Kesehatan Gigi dan Mulut</td>
                        <td>06-01-2023</td>
                        <td><span class="status p-1 rounded">Selesai</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#O001">Status</button>
                        </td>
                        <!-- modal edit contact starts-->
                        <form action="">
                            <div class="modal fade" id="O001" data-bs-backdrop="static" tabindex="-1">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 fs-7">
                                                <select class="form-select form-select-sm" required>
                                                    <option>Menunggu</option>
                                                    <option>Diproses</option>
                                                    <option>Ditunda</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
