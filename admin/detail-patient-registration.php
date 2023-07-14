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

if (isset($_GET['noKk'])) {
    $enc_no_kk = $_GET['noKk'];
    $dec_no_kk = decrypt($enc_no_kk);
    $sql = "SELECT * FROM akun WHERE no_kk = '$dec_no_kk'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
} elseif (isset($_GET['noRekmed'])) {
    $enc_no_rekmed = $_GET['noRekmed'];
    $dec_no_rekmed = decrypt($enc_no_rekmed);
    $sql = "SELECT * FROM rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik
    INNER JOIN akun ON pasien.no_kk = akun.no_kk WHERE no_rekam_medis = '$dec_no_rekmed'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $dec_no_kk = $data['no_kk'];
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded">
        <p class="fs-6 p-0 mb-2 fw-medium">Detail Nomor Kepala Keluarga <?= $data['no_kk'] ?></p>
        <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
            <div class="col-lg-6 col-12">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-4">No Indeks</td>
                        <td class="fw-medium"><?= $data['no_indeks'] ?></td>
                    </tr>
                    <tr>
                        <td class="col-4">Email</td>
                        <td class="fw-medium"><?= $data['email'] ?></td>
                    </tr>
                    <tr>
                        <td class="col-4">Kata Sandi</td>
                        <td class="fw-medium"><?= $data['kata_sandi'] ?></td>
                    </tr>
                    <tr>
                        <td class="col-4">Kartu Keluarga</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#kk">Lihat KK</button>
                        </td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="kk" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7">Kartu Keluarga</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center"><img src="../assets/patient_data/<?= $data['kk'] ?>" class="img-fluid" width="800" alt="KK" /></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-12">
                <table class="table table-borderless">
                    <tr>
                        <td class="col-4">Alamat</td>
                        <td class="fw-medium"><?= $data['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td class="col-4">RT</td>
                        <td class="fw-medium"><?= $data['rt'] ?></td>
                    </tr>
                    <tr>
                        <td class="col-4">RW</td>
                        <td class="fw-medium"><?= $data['rw'] ?></td>
                    </tr>
                    <tr class="col-4">
                        <td>Kelurahan / Desa</td>
                        <td class="fw-medium"><?= $data['kelurahan_desa'] ?></td>
                    </tr>
                    <tr class="col-4">
                        <td>Kecamatan</td>
                        <td class="fw-medium"><?= $data['kecamatan'] ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <p class="fs-6 p-0 mt-3 mb-2 fw-medium">Detail Anggota Keluarga</p>

        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>No. Rekmed</td>
                        <td>NIK</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Agama</td>
                        <td>Pekerjaan</td>
                        <td>Status Hubungan</td>
                        <td>Nomor HP</td>
                        <td>KTP</td>
                        <td>Status Pasien</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk INNER JOIN rekam_medis on pasien.nik = rekam_medis.nik WHERE akun.no_kk = '$dec_no_kk'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                        if ($row['no_rekam_medis'] === NULL) echo "Tidak ada";
                        else echo "<button type='button' class='btn btn-sm btn-outline-secondary fs-7' data-bs-toggle='modal' data-bs-target='#rm" . $row['no_rekam_medis'] . "'>" . $row['no_rekam_medis'] . "</button>";
                        echo "</td>";
                    ?>
                        <!-- Modal starts-->
                        <div class="modal fade" id="rm<?= $row['no_rekam_medis'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7">Detail Nomor Rekam Medis <?= $row['no_rekam_medis'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body fs-7">
                                        <p class="text-dark-emphasis mb-0">NIK</p>
                                        <p class="text-secondary"><?= $row['nik'] ?></p>
                                        <p class="text-dark-emphasis mb-0">Tanggal Masuk</p>
                                        <p class="text-secondary">
                                            <?php
                                            if ($row['tanggal_masuk'] === NULL || $row['tanggal_masuk'] === "") echo "Belum diatur";
                                            else echo format_date($row['tanggal_masuk']);
                                            ?>
                                        </p>
                                        <p class="text-dark-emphasis mb-0">Riwayat Alergi Obat</p>
                                        <?php
                                        if ($row['riwayat_alergi_obat'] === NULL || $row['riwayat_alergi_obat'] === "") echo "<p class='text-secondary'>Tidak ada</p>";
                                        echo "<p class='text-secondary'>" . $row['riwayat_alergi_obat'] . "</p>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                        <?php
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                        echo "<td>" . $row['tempat_lahir'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_lahir']) . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['agama'] . "</td>";
                        echo "<td>" . $row['pekerjaan'] . "</td>";
                        echo "<td>" . $row['status_hubungan'] . "</td>";
                        if ($row['no_hp'] === NULL || $row['no_hp'] === "") echo "<td>Tidak ada</td>";
                        else echo "<td>" . $row['no_hp'] . "</td>";
                        ?>
                        <td class="text-secondary"><button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#nik<?= $row['nik'] ?>">Lihat KTP</button></td>
                        <!-- Modal starts-->
                        <div class="modal fade" id="nik<?= $row['nik'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP <?= $row['nama_depan'] . " " . $row['nama_belakang'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <?php
                                        if ($row['ktp'] === NULL || $row['ktp'] === "") echo "<p class='fs-7 m-0'>" . $row['nama_depan'] . " belum memiliki KTP</p>";
                                        else echo "<img src='../assets/patient_data/" . $row['ktp'] . "' class='img-fluid' width='400' alt='ktp' />";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
                    <?php
                        echo "<td>" . $row['status_pasien'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("views/index-footer.php");
