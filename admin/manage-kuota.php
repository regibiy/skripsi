<?php
$result = get_data("kuota");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kuota = $row['kuota_tersedia'];
    }
    if (isset($_POST['simpan_kuota'])) {
        $jumlah_kuota = $_POST['kuota'];
        $sql = "UPDATE kuota SET kuota_tersedia = '$jumlah_kuota' WHERE kuota_tersedia = '$kuota'";
        $result = $conn->query($sql);
        $result = get_data("kuota");
        while ($row = $result->fetch_assoc()) {
            $kuota = $row['kuota_tersedia'];
        }
        $_SESSION['toaster'] = "Kuota pendaftaran berhasil diatur";
    }
} else {
    $kuota = 0;
    if (isset($_POST['simpan_kuota'])) {
        $jumlah_kuota = $_POST['kuota'];
        $sql = "INSERT INTO kuota VALUES ('$jumlah_kuota')";
        $result = $conn->query($sql);
        $result = get_data("kuota");
        while ($row = $result->fetch_assoc()) {
            $kuota = $row['kuota_tersedia'];
        }
        $_SESSION['toaster'] = "Kuota pendaftaran berhasil diatur";
    }
}
?>

<form action="" method="post">
    <div class="border d-flex flex-column gap-3 p-2 rounded">
        <p class="bg-danger text-white fs-7 mb-0 p-1 rounded" style="display: none;" id="alert">Pesan Kesalahan</p>
        <label for="kuota" class="form-label form-label-sm mb-0">Kuota Tersedia</label>
        <?php
        if ($kuota === 0) echo "<input type='number' class='form-control form-control-sm' name='kuota' id='kuotaInput' min='10' max='1000' placeholder='" . $kuota . "' readonly>";
        else echo "<input type='number' class='form-control form-control-sm' name='kuota' id='kuotaInput' min='10' max='1000' value='" .  $kuota . "' readonly>";
        ?>
        <div>
            <button type="button" class="btn btn-sm btn-primary" id="kuotaBtn">Edit</button>
            <button type="submit" class="btn btn-sm btn-outline-primary" id="kuotaBtnSimpan" name="simpan_kuota" disabled>Simpan</button>
        </div>
    </div>
</form>