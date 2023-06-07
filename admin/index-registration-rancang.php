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
    <div class="row g-3 my-2 d-flex justify-content-between text-dark-emphasis">
        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon regist text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">how_to_reg</span>
                </div>
                <div>
                    <p class="fs-6 fw-semibold mb-0">99999</p>
                    <p class="fs-6 m-0 text-secondary">Pendaftaran</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon patient text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">personal_injury</span>
                </div>
                <div>
                    <p class="fs-6 fw-semibold mb-0">99999</p>
                    <p class="fs-6 m-0 text-secondary">Pasien Umum</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon poly text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">medication</span>
                </div>
                <div>
                    <p class="fs-6 fw-semibold mb-0">99</p>
                    <p class="fs-6 m-0 text-secondary">Ruang Poli</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon activity text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">local_activity</span>
                </div>
                <div>
                    <h3 class="fs-6 fw-semibold mb-0">99999</h3>
                    <p class="fs-6 m-0 text-secondary">Info Kegiatan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 fw-medium px-0 mb-2">Pendaftaran Hari Ini, Selasa, 06-06-2023</p>
        <div class="table-responsive border rounded p-2 fs-7 text-dark-emphasis">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead class="text-dark-emphasis">
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
                <tbody class="text-dark-emphasis">
                    <tr>
                        <td class="fw-semibold">O0001</td>
                        <td>04-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">00923456</a> | Fachri Andika | 27 Tahun</p>
                            <p class="mb-0">6281356300160</p>
                            <p class="mb-0"> Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Kesehatan Gigi dan Mulut</td>
                        <td>06-06-2023</td>
                        <td><span class="status p-1 rounded">Ditunda</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#O001">Status</button>
                            <button class="btn btn-sm btn-outline-success">WA</button>
                            <button class="btn btn-sm btn-outline-danger">Email</button>
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
                    <tr>
                        <td class="fw-semibold">O0002</td>
                        <td>05-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">10923456</a> | Dewi Sari | 25 Tahun</p>
                            <p class="mb-0">6281409532109</p>
                            <p class="mb-0"> Jalan Pangeran Nata Kusuma No. 76</p>
                        </td>
                        <td>Ruang Pemeriksaan Umum</td>
                        <td>06-06-2023</td>
                        <td><span class="status p-1 rounded">Menunggu</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#O001">Status</button>
                            <button class="btn btn-sm btn-outline-success">WA</button>
                            <button class="btn btn-sm btn-outline-danger">Email</button>
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
                    <tr>
                        <td class="fw-semibold">O0003</td>
                        <td>06-06-2023</td>
                        <td>
                            <p class="mb-0"> <a href="detail-patient-registration.php" class="text-decoration-none">10998763</a> | Dwi Aditya | 22 Tahun</p>
                            <p class="mb-0">6289987687623</p>
                            <p class="mb-0"> Jalan Suka Mulia No. 6</p>
                        </td>
                        <td>Ruang Pemeriksaan Umum</td>
                        <td>06-06-2023</td>
                        <td><span class="status p-1 rounded">Menunggu</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#O001">Status</button>
                            <button class="btn btn-sm btn-outline-success">WA</button>
                            <button class="btn btn-sm btn-outline-danger">Email</button>
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
