<?php
include("action-admin.php");

if (isset($_GET['idInformasi'])) {
    $enc_id_informasi = $_GET['idInformasi'];
    $dec_id_informasi = decrypt($enc_id_informasi);
} else {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

$sql = "SELECT * FROM informasi WHERE id_informasi = '$dec_id_informasi'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

unlink('assets/images/' . $data['gambar']);
$sql = "DELETE FROM informasi WHERE id_informasi = '$dec_id_informasi'";
$result = $conn->query($sql);
if ($result) {
    $_SESSION['toaster'] = "Data informasi kegiatan berhasil dihapus";
    header("location: activity-registration.php");
}
