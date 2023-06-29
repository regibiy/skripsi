<?php
$title = "Upss...";
session_start();
include("views/header-error.php");
?>

<div class="container">
    <div class="d-flex justify-content-center align-items-center flex-column gap-3 min-vh-100">
        <img src="assets/images/warning.png" alt="warning" width="100">
        <h1 class="fs-4 mb-0">Kesalahan telah terjadi</h1>
        <?php
        if (isset($_SESSION['role'])) {
            echo "<a href='admin/index.php' class='text-decoration-none'>Kembali ke halaman utama</a>";
        } else {
            echo "<a href='index.php' class='text-decoration-none'>Kembali ke halaman utama</a>";
        }
        ?>
    </div>
</div>

<?php
include("views/footer-error.php");
?>