<?php
$title = "Pendaftaran Saya";
include("action.php");
include("views/header.php");
?>

<div class="container my-mtb-body shadow-sm rounded border py-3">
    <h1 class="text-dark-emphasis fs-6 text-center mb-0">Pendaftaran Saya</h1>
    <div class="row g-3 align-items-center justify-content-center my-2">
        <div class="col-auto">
            <label for="no_rekmed" class="col-form-label col-form-label-sm text-dark-emphasis">Nomor Rekam Medis</label>
        </div>
        <div class="col-auto">
            <select class="form-select form-select-sm fs-7 text-dark-emphasis" name="no_rekmed" id="no_rekmed" required>
                <option value="" selected>---</option>
                <option value="00945678">00945678 | Fachri Andika Permana</option>
                <option value="10945678">10945678 | Dewi Sari Pramudita</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success btn-sm">Terapkan</button>
        </div>
    </div>
    <div class="table-responsive fs-7 border rounded p-2">
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
                <tr>
                    <td>19-10-2023</td>
                    <td>O0001</td>
                    <td>Ruang Pemeriksaan Umum</td>
                    <td>20-10-2023</td>
                    <td>Menunggu</td>
                    <td>
                        <button class="btn btn-sm btn-success">Cetak</button>
                        <button class="btn btn-sm btn-outline-danger">Batal</button>
                    </td>
                </tr>
                <tr>
                    <td>19-10-2023</td>
                    <td>O0002</td>
                    <td>Ruang Kesehatan Gigi Mulut</td>
                    <td>20-10-2023</td>
                    <td>Menunggu</td>
                    <td>
                        <a href="print-registration.php" class="btn btn-sm btn-success">Cetak</a>
                        <button class="btn btn-sm btn-outline-danger">Batal</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
include("views/footer.php");
