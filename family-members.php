<?php
$title = "Anggota Keluarga";
include("action.php");

$no_kk = $_SESSION['no_kk'];

include("views/header.php");
?>

<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-5">Data Anggota Keluarga</h1>
        <?php
        if (isset($_SESSION['error_msg'])) {
            echo "<p class='bg-danger py-1 px-2 text-white fs-7 rounded'>" . $_SESSION['error_msg'] . "</p>";
            unset($_SESSION['error_msg']);
        }
        ?>
        <div class="d-flex justify-content-between col-12 flex-wrap">
            <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3 mb-4">
                <h2 class="text-dark-emphasis fs-7 mb-0">
                    Daftar Anggota Keluarga
                    <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#nikCheck">Tambah</button>
                    <!-- modal cek nik starts-->
                    <form action="action.php" method="post" onsubmit="return validasiNIK()">
                        <div class="modal fade" id="nikCheck" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">NIK</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="restartNIK()"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="alert" class="bg-danger text-white fs-7 rounded py-1 px-2" style="display: none;"></p>
                                        <div class="col-12 fs-7">
                                            <label for="nikCheckDua" class="form-label form-label-sm">NIK Anggota Keluarga <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" name="nik_check" id="nikCheckDua" placeholder="2151331605010002" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal" onclick="restartNIK()">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success" name="cek_nik">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- modal cek nik ends -->
                </h2>
                <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                    <?php
                    $sql = "SELECT * FROM (
            SELECT *, 
                CASE
                    WHEN status_hubungan = 'Kepala Keluarga' THEN '00'
                    WHEN status_hubungan = 'Istri' THEN '10'
                    WHEN status_hubungan = 'Anak 1' THEN '01'
                    WHEN status_hubungan = 'Anak 2' THEN '02'
                    WHEN status_hubungan = 'Anak 3' THEN '03'
                    WHEN status_hubungan = 'Anak 4' THEN '04'
                    WHEN status_hubungan = 'Anak 5' THEN '05'
                    WHEN status_hubungan = 'Anak 6' THEN '06'
                    WHEN status_hubungan = 'Anak 7' THEN '07'
                    WHEN status_hubungan = 'Anak 8' THEN '08'
                    WHEN status_hubungan = 'Anak 9' THEN '09'
                END AS kode_status, ROW_NUMBER() OVER (ORDER BY
                CASE
                    WHEN status_hubungan = 'Kepala Keluarga' THEN 0
                    WHEN status_hubungan = 'Istri' THEN 1
                    WHEN status_hubungan = 'Anak 1' THEN 2
                    WHEN status_hubungan = 'Anak 2' THEN 3
                    WHEN status_hubungan = 'Anak 3' THEN 4
                    WHEN status_hubungan = 'Anak 4' THEN 5
                    WHEN status_hubungan = 'Anak 5' THEN 6
                    WHEN status_hubungan = 'Anak 6' THEN 7
                    WHEN status_hubungan = 'Anak 7' THEN 8
                    WHEN status_hubungan = 'Anak 8' THEN 9
                    WHEN status_hubungan = 'Anak 9' THEN 10
                END) AS rn FROM pasien WHERE no_kk = '$no_kk' AND status_pasien = 'Dalam KK') AS subquery ORDER BY rn";  //if else query ordering name
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $enc_nik = encrypt($row['nik']);
                        $url = "edit-family-member.php?nik=" . urlencode($enc_nik);
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fs-7 text-dark-emphasis fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $row['nik'] ?>">
                                    <?= $row['nama_depan'] . " " . $row['nama_belakang'] ?> (<?= $row['status_hubungan'] ?>)
                                </button>
                            </h2>
                            <div id="<?= $row['nik'] ?>" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <table class="table table-borderless fs-7 mb-0">
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">NIK</td>
                                            <td class="text-secondary"><?= $row['nik'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Tempat Lahir</td>
                                            <td class="text-secondary"><?= $row['tempat_lahir'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Tanggal Lahir</td>
                                            <td class="text-secondary"><?= format_date($row['tanggal_lahir']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Jenis Kelamin</td>
                                            <td class="text-secondary"><?= $row['jenis_kelamin'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Agama</td>
                                            <td class="text-secondary"><?= $row['agama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Pekerjaan</td>
                                            <td class="text-secondary"><?= $row['pekerjaan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">No. HP</td>
                                            <td class="text-secondary"><?= $row['no_hp'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">KTP</td>
                                            <td class="text-secondary"><button type="button" class="btn btn-sm btn-success fs-7" data-bs-toggle="modal" data-bs-target="#ktp<?= $row['nik'] ?>">Lihat KTP</button></td>
                                            <!-- Modal starts-->
                                            <div class="modal fade" id="ktp<?= $row['nik'] ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-7">KTP <?= $row['status_hubungan'] ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <?php
                                                        if ($row['ktp'] === NULL || $row['ktp'] === "") echo "<div class='modal-body text-center'><p class='fs-7'>" . $row['nama_depan'] . " belum memiliki KTP</p></div>";
                                                        else echo "<div class='modal-body text-center'><img src='assets/patient_data/" . $row['ktp'] . "' class='img-fluid' width='400' alt='KTP " . $row['nama_depan'] . "' /></div>";
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal ends -->
                                        </tr>
                                        <tr>
                                            <td class="text-dark-emphasis fw-medium">Status Pasien</td>
                                            <td class="text-secondary"><?= $row['status_pasien'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><a href="<?= $url ?>" class="btn btn-sm btn-outline-success">Edit</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <?php
            $sql = "SELECT * FROM akun WHERE no_kk = '$no_kk'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            ?>
            <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
                <h2 class="text-dark-emphasis fs-7 mb-0">
                    Data Kontak Kepala Keluarga
                    <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editContact">Edit</button>
                    <!-- modal edit contact starts-->
                    <form action="action.php" method="post">
                        <div class="modal fade" id="editContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Kontak Kepala Keluarga</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="restartEmail()"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 fs-7">
                                            <label for="email" class="form-label form-label-sm">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm" name="email" id="email" value="<?= $data['email'] ?>" required autocomplete="off">
                                            <input type="hidden" id="hiddenEmail" value="<?= $data['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal" onclick="restartEmail()">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success" name="edit_kontak">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- modal edit contact ends -->
                </h2>
                <div class="col-12 mb-2">
                    <label for="email" class="form-label form-label-sm fs-7">Email</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['email'] ?></p>
                </div>
                <h2 class="text-dark-emphasis fs-7 my-0">
                    Data Pendukung
                    <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editSupport">Edit</button>
                    <!-- modal edit data support starts -->
                    <form action="action.php" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="editSupport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Pendukung</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 fs-7">
                                            <label for="newKk" class="form-label form-label-sm">Kartu Keluarga <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-sm" name="new_kk" id="newKk" required>
                                            <input type="hidden" name="prev_kk" value="<?= $data['kk'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success" name="edit_support">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- modal edit data support ends -->
                </h2>
                <div class="col-12 fs-7">
                    <label for="noKk" class="form-label form-label-sm">Nomor KK</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['no_kk'] ?></p>
                </div>
                <div class="col-12 mb-4">
                    <label for="kk" class="form-label form-label-sm fs-7">Kartu Keluarga</label>
                    <br />
                    <button type="button" class="btn btn-sm btn-success fs-7" data-bs-toggle="modal" data-bs-target="#kk">Lihat KK</button></td>
                    <!-- Modal starts-->
                    <div class="modal fade" id="kk" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-7">Kartu Keluarga</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center"><img src="assets/patient_data/<?= $data['kk'] ?>" class="img-fluid" width="800" alt="kk" /></div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal ends -->
                </div>
            </div>

            <div class="d-flex flex-column align-items-start col-lg-3 col-12 gap-3">
                <h2 class="text-dark-emphasis fs-7 mb-0">Data Domisili
                    <button type="button" class="btn btn-sm btn-outline-success fs-7" data-bs-toggle="modal" data-bs-target="#editDomisili">Edit</button>
                    <!-- modal edit data domisili starts -->
                    <form action="action.php" method="post">
                        <div class="modal fade" id="editDomisili" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7 text-dark-emphasis fw-medium">Edit Data Domisili</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="restartDomisili()"></button>
                                    </div>
                                    <div class="modal-body fs-7">
                                        <div class="d-flex flex-column align-items-start col-12 gap-3">
                                            <div class="col-12">
                                                <label for="alamat" class="form-label form-label-sm">Alamat <span class="text-danger">*</span></label>
                                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" required><?= $data['alamat'] ?></textarea>
                                                <input type="hidden" id="hiddenAlamat" value="<?= $data['alamat'] ?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="rt" class="form-label form-label-sm">RT <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="rt" id="rt" value="<?= $data['rt'] ?>" required>
                                                <input type="hidden" id="hiddenRT" value="<?= $data['rt'] ?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="rw" class="form-label form-label-sm">RW <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="rw" id="rw" value="<?= $data['rw'] ?>" required>
                                                <input type="hidden" id="hiddenRW" value="<?= $data['rw'] ?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="kel_desa" class="form-label form-label-sm">Kelurahan / Desa <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="kel_desa" id="kel_desa" value="<?= $data['kelurahan_desa'] ?>" required>
                                                <input type="hidden" id="hiddenKelDesa" value="<?= $data['kelurahan_desa'] ?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="kecamatan" class="form-label form-label-sm">Kecamatan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" value="<?= $data['kecamatan'] ?>" required>
                                                <input type="hidden" id="hiddenKecamatan" value="<?= $data['kecamatan'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal" onclick="restartDomisili()">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success" name="edit_domisili">Simpan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- modal edit data domisili ends -->
                </h2>
                <div class="col-12">
                    <label for="alamat" class="form-label form-label-sm fs-7">Alamat</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['alamat'] ?></p>
                </div>
                <div class="col-12">
                    <label for="rt" class="form-label form-label-sm fs-7">RT</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['rt'] ?></p>
                </div>
                <div class="col-12">
                    <label for="rw" class="form-label form-label-sm fs-7">RW</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['rw'] ?></p>
                </div>
                <div class="col-12">
                    <label for="kel_desa" class="form-label form-label-sm fs-7">Kelurahan / Desa</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['kelurahan_desa'] ?></p>
                </div>
                <div class="col-12">
                    <label for="kecamatan" class="form-label form-label-sm fs-7">Kecamatan</label>
                    <p class="text-secondary fs-7 mb-0"><?= $data['kecamatan'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("views/footer.php");
