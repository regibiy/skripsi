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
    <div class="row mt-3 mb-5 px-2 py-3 bg-white rounded">
        <div class="d-flex justify-content-between px-0 pb-2">
            <p class="fs-6 p-0 mb-2 fw-medium">Daftar Informasi Kegiatan</p>
            <a href="add-activity-registration.php" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="table-responsive border rounded p-2 fs-7">
            <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
                <thead>
                    <tr class="fw-medium">
                        <td>Judul</td>
                        <td>Gambar</td>
                        <td>Tanggal Unggah</td>
                        <td>Tanggal Edit</td>
                        <td>Pengunggah</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = get_data("informasi");
                    while ($row = $result->fetch_assoc()) {
                        $enc_id_informasi = encrypt($row['id_informasi']);
                        $url = "edit-activity-registration.php?idInformasi=" . urlencode($enc_id_informasi);
                        echo "<tr>";
                        echo "<td>" . $row['judul'] . "</td>";
                        echo "<td><button class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#" . $row['id_informasi'] . "'>Lihat Gambar</button></td>";
                    ?>
                        <!-- modal starts -->
                        <div class="modal fade" id="<?= $row['id_informasi'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-7" id="exampleModalLabel">Gambar Kegiatan <?= $row['judul'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="assets/images/<?= $row['gambar'] ?>" class="img-fluid" width="400" alt="gambar informasi kegiatan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal ends -->
                        <?php
                        echo "<td>" . $row['tanggal_unggah'] . "</td>";
                        if ($row['tanggal_ubah'] === NULL || $row['tanggal_ubah'] === "") echo "<td>Belum diedit</td>";
                        else echo "<td>" . $row['tanggal_ubah'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td><a href='" . $url . "' class='btn btn-sm btn-primary'>Ubah</a>";
                        $url = "delete-activity-registration.php?idInformasi=" . urlencode($enc_id_informasi);
                        ?>
                        <a href="<?= $url ?>" class='btn btn-sm btn-outline-danger' onclick="return confirm('Hapus informasi kegiatan <?= $row['judul'] ?>?')">Hapus</a>
                    <?php
                        echo "</td>";
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
