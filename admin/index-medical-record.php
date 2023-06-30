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

$hari = array("1" => "Senin", "2" => "Selasa", "3" => "Rabu", "4" => "Kamis", "5" => "Jumat", "6" => "Sabtu", "7" => "Minggu");

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row g-3 my-2 d-flex justify-content-between text-dark-emphasis">

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon activity text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp">patient_list</span>
                </div>
                <div>
                    <?php
                    $first_date = date('Y-m-01', strtotime(date('Y-m')));
                    $last_date = date('Y-m-t', strtotime(date('Y-m')));
                    $sql = "SELECT COUNT(id_pendaftaran) as total FROM pendaftaran WHERE tanggal_berobat BETWEEN '$first_date' AND '$last_date'";
                    $result = $conn->query($sql);
                    $data = $result->fetch_assoc();
                    ?>
                    <h3 class="fs-6 fw-semibold mb-0"><?= $data['total'] ?></h3>
                    <p class="fs-6 m-0 text-secondary">Pendaftaran</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon regist text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp">diversity_1</span>
                </div>
                <div>
                    <?php
                    $data = get_total("no_kk", "akun");
                    ?>
                    <p class="fs-6 fw-semibold mb-0"><?= $data['total'] ?></p>
                    <p class="fs-6 m-0 text-secondary">Akun Keluarga</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon patient text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">personal_injury</span>
                </div>
                <div>
                    <?php
                    $data = get_total("nik", "pasien");
                    ?>
                    <p class="fs-6 fw-semibold mb-0"><?= $data['total'] ?></p>
                    <p class="fs-6 m-0 text-secondary">Pasien Umum</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon poly text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">medication</span>
                </div>
                <?php
                $data = get_total("id_ruang_poli", "ruang_poli");
                ?>
                <div>
                    <p class="fs-6 fw-semibold mb-0"><?= $data['total'] ?></p>
                    <p class="fs-6 m-0 text-secondary">Ruang Poli</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5 p-2 bg-white rounded text-dark-emphasis">
        <?php
        $tanggal = date('d-m-Y');
        $hari2 = date('N', strtotime($tanggal));
        foreach ($hari as $x => $value) {
            if ($hari2 == $x) $tampil_hari = $value;
        }
        ?>
        <p class="fs-6 fw-medium px-0 mb-2">Pendaftaran Hari Ini, <?= $tampil_hari ?>, <?= $tanggal ?></p>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="rekmed-registration" class="table rounded shadow-sm table-hover border text-dark-emphasis" style="width:100%">
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
                    <?php
                    $sql = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis
                            INNER JOIN pasien ON rekam_medis.nik = pasien.nik INNER JOIN akun ON pasien.no_kk = akun.no_kk
                            INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli
                            WHERE tanggal_berobat = '2023-06-24' AND status_pendaftaran = 'Diproses' ORDER BY tanggal_ubah"; //TANGGAL UBAH KE CURRENT DATE
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='fw-semibold'>" . $row['nomor_antrian'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_daftar']) . "</td>";
                        echo "<td>";
                        $tanggal_lahir = $row['tanggal_lahir'];
                        $tanggal_berobat = $row['tanggal_berobat'];
                        $selisih = date_diff(date_create($tanggal_lahir), date_create($tanggal_berobat));
                        $umur = $selisih->y;
                        $enc_no_rekam_medis = encrypt($row['no_rekam_medis']);
                        $url = "detail-patient-medical-record.php?noRekmed=" . urlencode($enc_no_rekam_medis);
                        echo "<p class='mb-0'> <a href='" . $url . "' class='text-decoration-none'>" . $row['no_rekam_medis'] . "</a> | " . $row['nama_depan'] . " " . $row['nama_belakang'] . " | " . $umur . " Tahun</p>";
                        echo "<p class='mb-0'>" . $row['no_hp'] . "</p>";
                        echo "<p class='mb-0'>" . $row['alamat'] . "</p>";
                        echo "</td>";
                        echo "<td>" . $row['nama_ruang_poli'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_berobat']) . "</td>";
                        echo "<td><span class='status py-1 px-2 rounded'>" . $row['status_pendaftaran'] . "</span></td>";
                        echo "<td>";
                        $enc_no_kk = encrypt($row['no_kk']);
                        $url = "print-medical-record.php?noRekmed=" . urlencode($enc_no_rekam_medis) . "&noKk=" . urlencode($enc_no_kk);
                        if ($row['tanggal_masuk'] === NULL || $row['tanggal_masuk'] === "") {
                            echo "<button class='btn btn-sm btn-primary' onclick=\"alert('Tanggal berobat pasien tidak bernilai atau kosong! Rekam medis tidak dapat dicetak')\">Cetak</button>";
                            echo "<button class='btn btn-sm btn-outline-primary' onclick=\"alert('Tanggal berobat pasien tidak bernilai atau kosong! Status tidak dapat diselesaikan')\">Status</button>";
                        } else {
                            echo "<a href='" . $url . "' target='_blank' class='btn btn-sm btn-primary'>Cetak</a>";
                            echo "<button type='button' class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#" . $row['nomor_antrian'] . "'>Status</button>";
                        }
                        echo "</td>";
                    ?>
                        <!-- modal edit contact starts-->
                        <div class="modal fade" id="<?= $row['nomor_antrian'] ?>" data-bs-backdrop="static" tabindex="-1">
                            <form action="action-admin.php" method="post">
                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Ubah Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Status pendaftaran dengan informasi:</p>
                                            <p>Nomor Antrian : <?= $row['nomor_antrian'] ?></p>
                                            <p>Tujuan Ruang Poli : <?= $row['nama_ruang_poli'] ?></p>
                                            <p>Pasien : <?= $row['nama_depan'] . " " . $row['nama_belakang'] ?></p>
                                            <p class="mb-0">akan diselesaikan. Apakah Anda yakin?</p>
                                            <input type="hidden" name="id_daftar" value="<?= $row['id_pendaftaran'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-sm btn-primary" name="selesai_daftar">Ya</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- modal edit contact ends-->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include("views/index-footer.php");
