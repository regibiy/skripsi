<?php
$title = "Pendaftaran Saya";
include("action.php");
include("views/header.php");
?>

<div class="mx-3 my-mtb-body">
    <div class="container  shadow-sm rounded border py-3">
        <h1 class="text-dark-emphasis fs-6 text-center mb-3">Pendaftaran Saya</h1>
        <div class="table-responsive fs-7 border rounded p-2">
            <table id="my-registration" class="table table-striped">
                <thead>
                    <tr class="fw-medium">
                        <td>Tanggal Daftar</td>
                        <td>No. Antrian</td>
                        <td>Pasien</td>
                        <td>Tujuan Ruang Poli</td>
                        <td>Tanggal Berobat</td>
                        <td>Status Pendaftaran</td>
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
                        echo "<td>" . format_date($row['tanggal_daftar']) . "</td>";
                        echo "<td>" . $row['nomor_antrian'] . "</td>";
                        echo "<td>" . $row['no_rekam_medis'] . " | " . $row['nama_depan'] . " " . $row['nama_belakang'] .  "</td>";
                        echo "<td>" . $row['nama_ruang_poli'] . "</td>";
                        echo "<td>" . format_date($row['tanggal_berobat']) . "</td>";
                        echo "<td>" . $row['status_pendaftaran'] . "</td>";
                        if ($row['status_pendaftaran'] === "Dibatalkan" || $row['status_pendaftaran'] === "Diproses" || $row['status_pendaftaran'] === "Selesai" || $row['status_pendaftaran'] === "Sukses" || $row['status_pendaftaran'] === "Gagal") {
                            echo "<td>
                            <a href='print-registration.php?nik=" . urlencode($enc_nik) . "&iddaftar=" . $id_daftar . "' class='btn btn-sm btn-success'>Cetak</a>
                            </td>";
                        } elseif ($row['status_pendaftaran'] === "Menunggu" || $row['status_pendaftaran'] === "Ditunda" || $row['status_pendaftaran'] === "Invalid") {
                            echo "<td>
                            <a href='print-registration.php?nik=" . urlencode($enc_nik) . "&iddaftar=" . $id_daftar . "' class='btn btn-sm btn-success'>Cetak</a>";
                    ?>
                            <a href="cancel-registration.php?iddaftar=<?= $id_daftar ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Batalkan pendaftaran <?= $row['nama_ruang_poli'] ?> dengan nomor antrian <?= $row['nomor_antrian'] ?>?')">Batal</a>
                    <?php
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
