<?php
$title = "Lupa Akun";
include("action.php");
include("views/header.php");
?>

<form action="action.php" method="post">
    <div class="container d-flex justify-content-center my-mtb-body">
        <div class="d-flex flex-column gap-4 col-lg-5 col-sm-12 col-md-7">
            <label for="email" class="form-label mb-0 fs-6 text-dark-emphasis">Email yang terdaftar</label>
            <input type="email" class="form-control fs-7 text-dark-emphasis" id="email" name="email" placeholder="pasien@domain.com" maxlength="50" required autocomplete="off">
            <?php
            if (isset($_SESSION['error_msg'])) {
                echo "<p class='mb-0 bg-danger text-white fs-7 p-1 rounded'>" . $_SESSION['error_msg'] . "</p>";
                unset($_SESSION['error_msg']);
            } elseif (isset($_SESSION['success_msg'])) {
                echo "<p class='mb-0 bg-success text-white fs-7 p-1 rounded'>" . $_SESSION['success_msg'] . "</p>";
                unset($_SESSION['success_msg']);
            }
            ?>
            <button type="submit" class="btn btn-sm btn-success fs-6" name="forgot-account">Kirim nomor berobat dan kata sandi</button>
        </div>
    </div>
</form>

<?php
include("views/footer.php");
