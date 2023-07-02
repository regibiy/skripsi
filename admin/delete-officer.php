<?php
include("action-admin.php");

$enc_username = $_GET['username'];
$dec_username = decrypt($enc_username);
$role_delete = $_GET['role'];
if ($role_delete === "kapus") {
    $_SESSION['toaster'] = "Data petugas tidak dapat dihapus karena role";
    header("location: officer.php");
} else {
    $sql = "DELETE FROM petugas WHERE username = '$dec_username'";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['toaster'] = "Data petugas berhasil dihapus";
        header("location: officer.php");
    }
}
