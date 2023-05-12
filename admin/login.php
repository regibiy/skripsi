<?php
$title = "Masuk";
include("action-admin.php");
include("views/login-header.php");

if (isset($_SESSION['status_login_admin'])) {
    header("Location: index.php");
}

?>
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="container text-center text-dark-emphasis col-lg-3 col-sm-12 col-md-6">
        <img src="../assets/images/logo.png" alt="goverment's logo" class="img-fluid" width="100">
        <img src="../assets/images/logo-upt.png" alt="puskesmas's logo" class="img-fluid" width="100">
        <form action="action-admin.php" method="post">
            <div class="d-flex flex-column gap-3 shadow-sm rounded p-4 bg-white">
                <h1 class="fs-5">Masuk</h1>
                <?php
                if (isset($_SESSION['error_msg'])) {
                ?>
                    <p class="mb-0 bg-danger rounded text-white fs-6 py-1"><?= $_SESSION['error_msg'] ?></p>
                <?php
                    unset($_SESSION['error_msg']);
                }
                ?>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="regi123" name="username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="******" name="password">
                    <label for="floatingPassword">Password</label>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" onclick="showPassword()">
                        <label class="form-check-label text-dark-emphasis" for="flexCheckDefault">Lihat Kata Sandi</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Masuk</button>
        </form>
    </div>
</div>
</div>

<?php
include("views/login-footer.php");
