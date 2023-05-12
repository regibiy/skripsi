<?php
$title = "Dasbor";
include("action-admin.php");
include("views/index-header.php");

if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: login.php");
}
?>

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

<?php
include("views/index-footer.php");
