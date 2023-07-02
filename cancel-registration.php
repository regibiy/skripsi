<?php
include("action.php");

if (isset($_GET['iddaftar'])) $id_daftar = $_GET['iddaftar'];
else header("Location: index.php");

$sql = "UPDATE pendaftaran SET status_pendaftaran = 'Dibatalkan' WHERE id_pendaftaran = '$id_daftar'";
$result = $conn->query($sql);
if ($result) {
    $_SESSION['toaster'] = "Pendaftaran berhasil dibatalkan";
    header("Location: my-registration.php");
}
