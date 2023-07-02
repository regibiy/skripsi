<?php
include("action-admin.php");
$enc_id_ruang = $_GET['idruang'];
$dec_id_ruang = decrypt($enc_id_ruang);

$sql = "SELECT * FROM ruang_poli WHERE id_ruang_poli = '$dec_id_ruang'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    unlink('assets/images/' . $row['gambar_ruang_poli']);
}
$sql = "DELETE FROM ruang_poli WHERE id_ruang_poli = '$dec_id_ruang'";
$result = $conn->query($sql);
if ($result) {
    $_SESSION['toaster'] = "Data ruang poli berhasil dihapus";
    header("location: poly-room-head.php");
}
