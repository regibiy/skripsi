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
        <p class="fs-6 p-0 mb-2 fw-medium">Daftar Pasien Umum</p>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>No. KK</td>
                        <td>No. Rekmed</td>
                        <td>Nama</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Agama</td>
                        <td>Nomor HP</td>
                        <td>KTP</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM pasien INNER JOIN akun ON pasien.no_kk = akun.no_kk INNER JOIN rekam_medis ON pasien.nik = rekam_medis.nik";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        $enc_no_kk = encrypt($row['no_kk']);
                        $url = "detail-patient-registration.php?noKk=" . urlencode($enc_no_kk);
                        echo "<td><a href='" . $url . "' class='text-decoration-none'>" . $row['no_kk'] . "</a></td>";
                        if ($row['no_rekam_medis'] === NULL) echo "<td>Tidak ada</td>";
                        else echo "<td>" . $row['no_rekam_medis'] . "</td>";
                        echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_lahir']) . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['agama'] . "</td>";
                        if ($row['no_hp'] === NULL || $row['no_hp'] === "") echo "<td>Tidak ada</td>";
                        else echo "<td>" . $row['no_hp'] . "</td>";
                        echo "<td class='text-secondary'><button type='button' class='btn btn-sm btn-outline-secondary fs-7' data-bs-toggle='modal' data-bs-target='#ktp" . $row['no_rekam_medis'] . "'>Lihat KTP</button></td>";
                        echo "</tr>";
                    ?>
                        <!-- Modal starts-->
                        <div class="modal fade" id="ktp<?= $row['no_rekam_medis'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">KTP <?= $row['nama_depan'] . " " . $row['nama_belakang'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <?php
                                        if ($row['ktp'] === NULL || $row['ktp'] === "") echo "<p class='fs-7 m-0'>" . $row['nama_depan'] . " belum memiliki KTP</p>";
                                        else echo "<img src='../assets/patient_data/" . $row['ktp'] . "' class='img-fluid' width='400' alt='KTP' />";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ends -->
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
