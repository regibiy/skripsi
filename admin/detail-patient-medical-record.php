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

if (isset($_GET['noKk'])) {
    $enc_no_kk = $_GET['noKk'];
    $dec_no_kk = decrypt($enc_no_kk);
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

$sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk LEFT JOIN rekam_medis on pasien.nik = rekam_medis.nik WHERE akun.no_kk = '$dec_no_kk'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row mt-3 mb-5 p-2 bg-white rounded text-dark-emphasis">
        <p class="fs-6 p-0 mb-2 fw-medium">Detail Nomor Kepala Keluarga <?= $data['no_kk'] ?></p>
        <form action="action-admin.php" method="post">
            <?php
            if (isset($_SESSION['success_msg'])) {
                echo "<p class='bg-success text-white fs-7 rounded px-2 py-1'>" . $_SESSION['success_msg'] . "</p>";
                unset($_SESSION['success_msg']);
            }
            ?>
            <div class="d-flex justify-content-between flex-wrap border rounded p-0 col-12 fs-7">
                <div class="col-lg-6 col-12">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="col-4"><label for="noKk" class="form-label form-label-sm">Nomor KK</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <p class="fs-7 m-0 fw-medium"><?= $data['no_kk'] ?></p>
                                    <input type="hidden" name="no_kk" value="<?= $data['no_kk'] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="noIndeks" class="form-label form-label-sm">Nomor Indeks</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <?php
                                    if ($data['no_indeks'] === NULL || $data['no_indeks'] === "") echo "<input type='number' class='form-control form-control-sm edit-kk-rekmed' name='no_indeks' id='noIndeks' required readonly>";
                                    else {
                                        echo "<p class='fs-7 m-0 fw-medium'>" . $data['no_indeks'] . "</p>";
                                        echo "<input type='hidden' name='no_indeks' value='" . $data['no_indeks'] . "'>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="email" class="form-label form-label-sm">Email</label></td>
                            <td class="fw-semibold text-secondary"><?= $data['email'] ?></td>
                            <input type="hidden" name="email" value="<?= $data['email'] ?>">
                        </tr>
                        <tr>
                            <td class="col-4"><label for="password" class="form-label form-label-sm">Kata Sandi</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <?php
                                    if (strlen($data['kata_sandi']) === 4) echo "<input type='number' class='form-control form-control-sm edit-kk-rekmed' name='password' id='password' value='" . $data['kata_sandi'] . "' required readonly>";
                                    else {
                                        echo "<p class='fs-7 m-0 fw-medium'>" . $data['kata_sandi'] . "</p>";
                                        echo "<input type='hidden' name='password' value='" . $data['kata_sandi'] . "'>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="Kk" class="form-label form-label-sm">Kartu Keluarga</label></td>
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
                                        <div class="modal-body text-center"><img src="../assets/patient_data/<?= $data['kk'] ?>" class="img-fluid" width="800" alt="kk" /></div>
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
                            <td class="col-4"><label for="alamat" class="form-label form-label-sm">Alamat</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <textarea class="form-control form-control-sm text-dark-emphasis edit-kk-rekmed" name="alamat" id="alamat" rows="3" placeholder="Jalan Pangeran Nata Kusuma No. 76" required readonly><?= $data['alamat'] ?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="rt" class="form-label form-label-sm">RT</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="number" class="form-control form-control-sm edit-kk-rekmed" name="rt" id="rt" placeholder="004" value="<?= $data['rt'] ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4"><label for="rw" class="form-label form-label-sm">RW</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="number" class="form-control form-control-sm edit-kk-rekmed" name="rw" id="rw" placeholder="023" value="<?= $data['rw'] ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr class="col-4">
                            <td><label for="kelurahanDesa" class="form-label form-label-sm">Kelurahan / Desa</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-kk-rekmed" name="kelurahan_desa" id="kelurahanDesa" placeholder="Sungai Bangkong" value="<?= $data['kelurahan_desa'] ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr class="col-4">
                            <td><label for="kecamatan" class="form-label form-label-sm">Kecamatan</label></td>
                            <td>
                                <div class="col-lg-8 col-12">
                                    <input type="text" class="form-control form-control-sm edit-kk-rekmed" name="kecamatan" id="kecamatan" placeholder="Pontianak Kota" value="<?= $data['kecamatan'] ?>" required readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-center col-12 mb-2 gap-3">
                    <button type="button" class="btn btn-sm btn-primary" onclick="editKkReadonly()">Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#warning" id="simpanEditKk" disabled>Simpan</button>
                    <!-- modal edit status starts-->
                    <div class="modal fade" id="warning" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Perhatian</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 fs-7">
                                        <p class="m-0">Pastikan TIDAK ada data yang keliru saat Anda memasukkan atau mengubah data pasien. Apakah Anda ingin melanjutkan?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="edit_data_kk_rekmed">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal edit status ends -->
                </div>
        </form>
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
                $sql = "SELECT * FROM pasien INNER JOIN rekam_medis ON pasien.nik = rekam_medis.nik WHERE pasien.no_kk = '$dec_no_kk'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    if ($row['no_rekam_medis'] === NULL) echo "<td>Tidak ada</td>";
                    else {
                        echo "<td>";
                ?>
                        <button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#<?= $row['no_rekam_medis'] ?>"><?= $row['no_rekam_medis'] ?></button>
                        <!-- Modal starts-->
                        <form action="action-admin.php" method="post">
                            <div class="modal fade" id="<?= $row['no_rekam_medis'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-7">Detail Nomor Rekam Medis <?= $row['no_rekam_medis'] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body fs-7">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="fs-7">
                                                    <label for="nik" class="form-label form-label-sm text-dark-emphasis">NIK</label>
                                                    <p class="text-secondary mb-0"><?= $row['nik'] ?></p>
                                                    <input type="hidden" name="no_rekam_medis" value="<?= $row['no_rekam_medis'] ?>">
                                                </div>
                                                <div class="fs-7">
                                                    <label for="tanggalMasuk" class="form-label form-label-sm text-dark-emphasis">Tanggal Masuk</label>
                                                    <input type="date" class="form-control form-control-sm text-secondary edit-rekam-medis" name="tanggal_masuk" value="<?= $row['tanggal_masuk'] ?>" required readonly>
                                                </div>
                                                <div class="fs-7">
                                                    <label for="riwayatAlergiObat" class="form-label form-label-sm text-dark-emphasis">Riwayat Alergi Obat</label>
                                                    <textarea class="form-control form-control-sm edit-rekam-medis" name="riwayat_alergi_obat" id="riwayatAlergiObat" rows="3" readonly><?= $row['riwayat_alergi_obat'] ?></textarea>
                                                </div>
                                                <div class="fs-7">
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="editRekMedReadonly()">Edit</button>
                                                    <button type="submit" class="btn btn-sm btn-outline-primary simpan-edit-rekmed" name="edit_rekam_medis" disabled>Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Modal ends -->
                    <?php
                        echo "</td>";
                    }
                    $enc_nik = encrypt($row['nik']);
                    $url = "edit-patient-medical-record.php?nik=" . urlencode($enc_nik);
                    echo "<td><a href='" . $url . "' class='text-decoration-none'>" . $row['nik'] . "</a></td>";
                    echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                    echo "<td>" . $row['tempat_lahir'] . "</td>";
                    echo "<td>" . format_date($row['tanggal_lahir']) . "</td>";
                    echo "<td>" . $row['jenis_kelamin'] . "</td>";
                    echo "<td>" . $row['agama'] . "</td>";
                    echo "<td>" . $row['pekerjaan'] . "</td>";
                    echo "<td>" . $row['status_hubungan'] . "</td>";
                    echo "<td>" . $row['no_hp'] . "</td>";
                    ?>
                    <td><button type="button" class="btn btn-sm btn-outline-secondary fs-7" data-bs-toggle="modal" data-bs-target="#<?= $row['nik'] ?>">Lihat KTP</button></td>
                    <!-- Modal starts-->
                    <div class="modal fade" id="<?= $row['nik'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7" id="exampleModalLabel">KTP <?= $row['status_hubungan'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <?php
                                    if ($row['ktp'] === NULL || $row['ktp'] === "") echo "<p>" . $row['nama_depan'] . " belum memiliki KTP</p>";
                                    else echo "<img src='../assets/patient_data/" . $row['ktp'] . "' class='img-fluid' width='800' alt='KTP " . $row['nama_depan'] . "' />";
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
