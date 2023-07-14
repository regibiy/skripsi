<?php
$title = "Pendaftaran Saya";
include("action.php");

if (!isset($_SESSION['status_login_pasien'])) {
    $_SESSION['error_msg'] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

include("views/header.php");
?>

<div class="mx-3 my-mtb-body">
    <div class="container shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-3">Pendaftaran Saya</h1>
        <div class="fs-7 border rounded p-2">
            <table id="my-registration" class="table table-borderless display" style="width: 100%;">
                <thead>
                    <tr class="fw-medium">
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no_kk = $_SESSION['no_kk'];
                    $sql = "SELECT * FROM pendaftaran INNER JOIN rekam_medis ON pendaftaran.no_rekam_medis = rekam_medis.no_rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik
                            INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli WHERE pasien.no_kk = '$no_kk' ORDER BY tanggal_daftar DESC, tanggal_berobat DESC, nomor_antrian DESC";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $enc_nik = encrypt($row['nik']);
                        $id_daftar = $row['id_pendaftaran'];
                        echo "<tr>";
                        echo "<td class='overflow-hidden'>";
                        echo "<div class='border rounded p-2 shadow-sm fs-7' data-aos='fade-up'>";
                        echo "<div class='d-flex justify-content-between border-bottom'>";
                        echo "<div>";
                        echo "<p class='fw-medium m-0'>" . $row['nomor_antrian'] . "</p>";
                        echo "<p class='m-0'>" . format_date($row['tanggal_daftar']) . "</p>";
                        echo "</div>";
                        echo "<p class='status p-1 rounded'>" . $row['status_pendaftaran'] . "</p>";
                        echo "</div>";
                        echo "<div class='py-3 border-bottom'>";
                        echo "<p class='m-0 fw-medium'>" . $row['nama_ruang_poli'] . "</p>";
                        echo "<p class='m-0'>" . format_date($row['tanggal_berobat']) . "</p>";
                        echo "<p class='m-0'>" . $row['no_rekam_medis'] . " | " . $row['nama_depan'] . " " . $row['nama_belakang'] . "</p>";
                        echo "</div>";
                        echo "<div class='pt-2 d-flex justify-content-end gap-2'>";
                        if ($row['status_pendaftaran'] === "Diproses" || $row['status_pendaftaran'] === "Selesai" || $row['status_pendaftaran'] === "Sukses")
                            echo "<a href='print-registration.php?nik=" . urlencode($enc_nik) . "&iddaftar=" . $id_daftar . "' class='btn btn-sm btn-success'>Cetak</a>";
                        elseif ($row['status_pendaftaran'] === "Menunggu" || $row['status_pendaftaran'] === "Ditunda") {
                            echo "<a href='print-registration.php?nik=" . urlencode($enc_nik) . "&iddaftar=" . $id_daftar . "' class='btn btn-sm btn-success'>Cetak</a>";
                    ?>
                            <a href="cancel-registration.php?iddaftar=<?= $id_daftar ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Batalkan pendaftaran <?= $row['nama_ruang_poli'] ?> dengan nomor antrian <?= $row['nomor_antrian'] ?>?')">Batal</a>
                    <?php
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include("views/footer.php");
