<table id="my-registration" class="table table-striped">
    <thead>
        <tr class="fw-medium">
            <td>Tanggal Daftar</td>
            <td>No. Antrian</td>
            <td>Tujuan Ruang Poli</td>
            <td>Tanggal Berobat</td>
            <td>Status Pendaftaran</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST['terapkan_no_rekmed'])) {
            $no_rekmed = $_POST['no_rekmed'];
            $sql = "SELECT * FROM pendaftaran INNER JOIN ruang_poli ON pendaftaran.id_ruang_poli = ruang_poli.id_ruang_poli WHERE no_rekam_medis = '$no_rekmed'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . format_date($row['tanggal_daftar']) . "</td>";
                echo "<td>" . $row['nomor_antrian'] . "</td>";
                echo "<td>" . $row['nama_ruang_poli'] . "</td>";
                echo "<td>" . format_date($row['tanggal_berobat']) . "</td>";
                echo "<td>" . $row['status_pendaftaran'] . "</td>";
                echo "<td>
            <a href='print-registration.php' class='btn btn-sm btn-success'>Cetak</a>
            <button class='btn btn-sm btn-outline-danger'>Batal</button>
            </td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<!-- <form action="my-registration-list.php" method="post" onsubmit="return validasiFormRekmed()">
        <div class="row g-3 align-items-center justify-content-center my-2">
            <div class="col-auto">
                <label for="no_rekmed" class="col-form-label col-form-label-sm text-dark-emphasis">Nomor Rekam Medis</label>
            </div>
            <div class="col-auto">
                <select class="form-select form-select-sm fs-7 text-dark-emphasis" name="no_rekmed" id="noRekmed" required>
                    <option value="---" selected hidden>Pilih pasien</option>
                    <?php
                    // $no_kk = $_SESSION['no_kk'];
                    // $sql = "SELECT * FROM rekam_medis INNER JOIN pasien ON rekam_medis.nik = pasien.nik WHERE pasien.no_kk = '$no_kk'";
                    // $result = $conn->query($sql);
                    // while ($row = $result->fetch_assoc()) {
                    //     echo "<option value= '" . $row['no_rekam_medis'] . "'>" . $row['no_rekam_medis'] . " | " . $row['nama_depan'] . " " . $row['nama_belakang'] . "</option>";
                    // }
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success btn-sm" name="terapkan_no_rekmed">Terapkan</button>
            </div>
        </div>
        <p id="alert" class="bg-danger fs-7 py-1 px-2 text-white rounded" style="display: none;"></p>
    </form> -->