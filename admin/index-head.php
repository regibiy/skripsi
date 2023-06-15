<?php
$title = "Dasbor Kepala Puskesmas";
include("action-admin.php");
if (!check_status_login_admin()) {
    $_SESSION["error_msg"] = "Silakan masuk terlebih dahulu";
    header("Location: index.php");
}

if ($_SESSION['role'] != "kapus") {
    echo "<script>
    alert('Aksi tidak diizinkan!');
    window.location='index.php';
    </script>";
}

include("views/index-header.php");
?>

<div class="container-fluid px-4">
    <div class="row g-3 d-flex justify-content-start mt-4 mb-5">

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon activity text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp">person</span>
                </div>
                <div>
                    <?php
                    $data = get_total("username", "petugas");
                    echo "<h3 class='fs-6 fw-semibold mb-0'>" . $data['total'] . "</h3>"
                    ?>
                    <p class="fs-6 m-0 text-secondary">Akun Petugas</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon poly text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp fs-1">medication</span>
                </div>
                <div>
                    <?php
                    $data = get_total("id_ruang_poli", "ruang_poli");
                    echo "<h3 class='fs-6 fw-semibold mb-0'>" . $data['total'] . "</h3>"
                    ?>
                    <p class="fs-6 m-0 text-secondary">Ruang Poli</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="p-4 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="bg-icon patient text-white d-flex justify-content-center align-items-center rounded-circle">
                    <span class="material-symbols-sharp">hourglass_top</span>
                </div>
                <div>
                    <?php
                    $result = get_data("kuota");
                    $data = $result->fetch_assoc();
                    echo "<p class='fs-6 fw-semibold mb-0'>" . $data['kuota_tersedia'] . "</p>";
                    ?>
                    <p class="fs-6 m-0 text-secondary">Kuota Tersedia</p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
include("views/index-footer.php");
