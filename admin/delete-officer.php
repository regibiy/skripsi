<?php
include("action-admin.php");

$enc_username = $_GET['username'];
$dec_username = decrypt($enc_username);
$role_delete = $_GET['role'];
if ($role_delete === "kapus") {
    echo "
    <script>
        alert('Data petugas tidak dapat dihapus karena role!');
        window.location='officer.php';
    </script>";
} else {
    $sql = "DELETE FROM petugas WHERE username = '$dec_username'";
    $result = $conn->query($sql);
    if ($result) {
        echo "
        <script>
            alert('Data petugas berhasil dihapus!');
            window.location='officer.php';
        </script>";
    }
}
