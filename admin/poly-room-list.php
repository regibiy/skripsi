<table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
    <thead>
        <tr class="fw-medium">
            <td>Nama Ruang Poli</td>
            <td>Gambar</td>
            <td>Status Ruang Poli</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = get_data("ruang_poli");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_ruang_poli'] . "</td>";
            echo "<td><button type='button' class='btn btn-sm btn-outline-secondary fs-7' data-bs-toggle='modal' data-bs-target='#" . $row['gambar_ruang_poli'] . "'>Lihat Gambar</button></td>";
            echo "
                <div class='modal fade' id='" . $row['gambar_ruang_poli'] . "' tabindex='-1'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title fs-7'>Gambar " . $row['nama_ruang_poli'] . "</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body text-center'><img src='assets/images/" . $row['gambar_ruang_poli'] . "' class='img-fluid' width='400' alt='gambar ruang poli' /></div>
                        </div>
                    </div>
                </div>";
            echo "<td>" . $row['status_ruang_poli'] . "</td>";
            $enc_id_ruang = encrypt($row['id_ruang_poli']);
            $url = "edit-poly-room-head.php?idruang=" . urlencode($enc_id_ruang);
            echo "<td><a href='" . $url . "' class='btn btn-sm btn-primary'>Edit</a>";
            $url = "delete-poly-room-head.php?idruang=" . urlencode($enc_id_ruang);
        ?>
            <a href="<?= $url ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus ruang <?= $row['nama_ruang_poli'] ?>?')">Hapus</a>
        <?php
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>