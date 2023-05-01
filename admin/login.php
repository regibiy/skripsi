<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style/login-styles.css" />
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="container text-center text-dark-emphasis col-lg-3 col-sm-12 col-md-6">
            <img src="../assets/images/logo.png" alt="goverment's logo" class="img-fluid" width="100">
            <img src="../assets/images/logo-upt.png" alt="puskesmas's logo" class="img-fluid" width="100">
            <div class="d-flex flex-column gap-3 shadow-sm rounded p-4 bg-white">
                <h1 class="fs-5">Masuk</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="regibiy">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="******">
                    <label for="floatingPassword">Password</label>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-dark-emphasis" for="flexCheckDefault">Lihat Kata Sandi</label>
                    </div>
                </div>
                <button class="btn btn-primary">Masuk</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>