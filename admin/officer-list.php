<div class="table-responsive border rounded p-2 fs-7">
    <table id="admin-registration" class="table rounded shadow-sm table-hover border" style="width:100%">
        <thead>
            <tr class="fw-medium">
                <td>Username</td>
                <td>Nama</td>
                <td>Role</td>
                <td>Password</td>
                <td>Status Petugas</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = get_data("petugas");
            while ($row = $result->fetch_assoc()) {
                $enc_username = encrypt($row['username']);
                $url = "edit-officer.php?username=" . urlencode($enc_username);
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['nama_depan'] . " " . $row['nama_belakang'] . "</td>";
                if ($row['role'] === "kapus") {
                    echo "<td>Kepala Puskesmas</td>";
                } elseif ($row['role'] === "rekmed") {
                    echo "<td>Rekam Medis</td>";
                } elseif ($row['role'] === "daftar") {
                    echo "<td>Pendaftaran</td>";
                }
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['status_petugas'] . "</td>";
                echo "<td><a href='" . $url . "' class='btn btn-sm btn-primary'>Edit</a>";
                $url = "delete-officer.php?username=" . urlencode($enc_username) . "&role=" . $row['role'];
            ?>
                <a href="<?= $url ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus petugas <?= $row['username'] ?>?')">Hapus</a>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>