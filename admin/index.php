<?php
$title = "Masuk";
include("action-admin.php");

if (check_status_login_admin()) {
    if ($_SESSION['role'] == "daftar") {
        header("Location: index-registration.php");
    } elseif ($_SESSION['role'] == "rekmed") {
        header("Location: index-medical-record.php");
    } elseif ($_SESSION['role'] == "kapus") {
        header("Location: index-head.php");
    }
}

include("views/login-header.php");

?>
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="container text-center text-dark-emphasis col-lg-3 col-sm-12 col-md-6">
        <img src="../assets/images/logo-upt.png" alt="puskesmas's logo" class="img-fluid" width="90">
        <img src="../assets/images/logo.png" alt="goverment's logo" class="img-fluid" width="100">
        <form action="action-admin.php" method="post">
            <div class="d-flex flex-column gap-3 shadow-sm rounded p-4 bg-white">
                <h1 class="fs-6">Masuk</h1>
                <?php
                if (isset($_SESSION['error_msg'])) {
                ?>
                    <p class="mb-0 bg-danger rounded text-white fs-7 py-1"><?= $_SESSION['error_msg'] ?></p>
                <?php
                    unset($_SESSION['error_msg']);
                }
                ?>
                <div class="form-floating fs-7">
                    <?php
                    if (isset($_SESSION['username']) && !check_status_login_admin()) {
                    ?>
                        <input type="text" class="form-control form-control-sm" id="floatingInput" placeholder="regi123" name="username" value="<?= $_SESSION['username'] ?>" autocomplete="off">
                    <?php
                        unset($_SESSION['username']);
                    } else {
                    ?>
                        <input type="text" class="form-control form-control-sm" id="floatingInput" placeholder="regi123" name="username" autocomplete="off">
                    <?php
                    }
                    ?>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating fs-7">
                    <input type="password" class="form-control form-control-sm" id="floatingPassword" placeholder="******" name="password">
                    <label for="floatingPassword">Password</label>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" onclick="showPassword()">
                        <label class="form-check-label text-dark-emphasis" for="flexCheckDefault">Lihat Kata Sandi</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="login">Masuk</button>
        </form>
    </div>
</div>
</div>

<?php
include("views/login-footer.php");
