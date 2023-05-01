<!DOCTYPE html>
<html lang="id">

<!-- https://github.com/mustafaerden/responsive-bootstrap5-admin-dashboard -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style/variables.css" />
    <link rel="stylesheet" href="style/styles.css" />
    <link rel="stylesheet" href="style/responsive.css" />
    <title>Dasbor</title>
</head>

<body>
    <div class="d-flex main-bg" id="wrapper">
        <!-- Sidebar starts-->
        <div class="bg-blue position-fixed z-3" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fw-bold fs-6"><img src="../assets/images/logo-upt.png" class="img-logo me-2" alt="logo puskesmas">Puskesmas Alianyang</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text active"><span class="material-symbols-sharp me-2">health_metrics</span>Dasbor</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">patient_list</span>Pasien</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">local_activity</span>Kegiatan</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">medication</span>Poli</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">summarize</span>Laporan</a>
                <a href="#" class="list-group-item my-list-group-item-action bg-transparent second-text"><span class="material-symbols-sharp me-2">supervisor_account</span>Petugas</a>
                <a href="#" class="list-group-item my-list-group-item-action-out bg-transparent second-text"><span class="material-symbols-sharp me-2">power_settings_new</span>Logout</a>
            </div>
        </div>
        <!-- #sidebar-wrapper ends -->

        <!-- Page Content starts, RESPONSIVE UNDER 320 DOESNT WORK-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 fixed-top my-margin-left z-1">
                <div class="d-flex justify-content-start align-items-center">
                    <span class="material-symbols-sharp fs-4 me-2" id="menu-toggle">menu</span>
                    <input type="text" class="form-control text-uppercase search" placeholder="Cari">
                </div>
                <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <img src="images/profile-1.jpg" alt="" width="35" class="rounded">
                </div>
            </nav>

            <div class="container-fluid px-4">
                <h4>Days, DD/MM/YYYY HH:MM:SS</h4>
                <div class="row g-3 my-2 d-flex justify-content-between">
                    <div class="col-md-4 col-xl-3">
                        <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div class="bg-icon regist text-white d-flex justify-content-center align-items-center rounded-circle">
                                <span class="material-symbols-sharp fs-1">how_to_reg</span>
                            </div>
                            <div>
                                <h3 class="fs-5 fw-bold">XXXXX</h3>
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
                                <h3 class="fs-5 fw-bold">XXXXX</h3>
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
                                <h3 class="fs-5 fw-bold">XXXXX</h3>
                                <p class="fs-6 m-0 text-secondary">Poli dan Ruang</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-3">
                        <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div class="bg-icon activity text-white d-flex justify-content-center align-items-center rounded-circle">
                                <span class="material-symbols-sharp fs-1">local_activity</span>
                            </div>
                            <div>
                                <h3 class="fs-5 fw-bold">XXXXX</h3>
                                <p class="fs-6 m-0 text-secondary">Info Kegiatan</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Pendaftar Saat Ini</h3>
                    <div class="col table-responsive">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="100">No. Daftar</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tujuan Poli</th>
                                    <th scope="col">Waktu Daftar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Television</td>
                                    <td>Jonny</td>
                                    <td>$1200</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Laptop</td>
                                    <td>Kenny</td>
                                    <td>$750</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Cell Phone</td>
                                    <td>Jenny</td>
                                    <td>$600</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Fridge</td>
                                    <td>Killy</td>
                                    <td>$300</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Books</td>
                                    <td>Filly</td>
                                    <td>$120</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Gold</td>
                                    <td>Bumbo</td>
                                    <td>$1800</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Pen</td>
                                    <td>Bilbo</td>
                                    <td>$75</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Notebook</td>
                                    <td>Frodo</td>
                                    <td>$36</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Dress</td>
                                    <td>Kimo</td>
                                    <td>$255</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Paint</td>
                                    <td>Zico</td>
                                    <td>$434</td>
                                    <td><span class="status p-1 rounded">Pending</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Carpet</td>
                                    <td>Jeco</td>
                                    <td>$1236</td>
                                    <td><span class="status bg-info p-1 rounded">Process</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">O100</th>
                                    <td>Food</td>
                                    <td>Haso</td>
                                    <td>$422</td>
                                    <td><span class="status p-1 rounded">Process</span></td>
                                    <td class="action"><a href="#">Ubah</a>|<a href="#">Proses</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>