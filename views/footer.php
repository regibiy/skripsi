<footer class="bg-dark py-5 mt-4">
    <div class="container text-white">
        <img src="assets/images/logo-upt.png" alt="puskesmas's logo" class="img-fluid">
        <img src="assets/images/logo.png" alt="goverment's logo" class="img-fluid">
        <div class=" d-flex flex-wrap justify-content-between">
            <div class="col-auto mb-3">
                <p class="mb-0 fs-6">UPT Puskesmas Alianyang</p>
                <p class="mb-0 fs-7">Jl. Pangeran Nata Kusuma <br> Kota Pontianak, Kalimantan Barat, 78113</p>
                <p class="mb-0 fs-7">Telp. 0561-8212307</p>
                <p class="mb-0 fs-7">Email : alianyang.pnkkota@gmail.com</p>
            </div>
            <div class="col-auto mb-3">
                <p class="mb-0 fs-6">Jam Pelayanan Pendaftaran</p>
                <p class="mb-0 fs-7">Hari Senin-Kamis, Pukul 07.15-12.00</p>
                <p class="mb-0 fs-7">Hari Jumat-Sabtu, Pukul 07.15-10.00</p>
            </div>
            <div class="social-media col-auto">
                <p class=" mb-0 fs-6">Media Sosial Puskesmas</p>
                <p class="mb-0 fs-7"><i class="fa-brands fa-facebook"></i> Puskesmas Alianyang</p>
                <p class="mb-0 fs-7"><i class="fa-brands fa-instagram"></i> puskesmas_alianyangptk</p>
            </div>
            <div class="footer-nav col-auto">
                <p class="mb-0 fs-6">Link Navigasi</p>
                <a href="index.php" class="text-decoration-none text-white d-block fs-7">Beranda</a>
                <a href="poly-rooms.php" class="text-decoration-none text-white d-block fs-7">Pendaftaran</a>
                <?php
                if (!check_status_login_pasien()) {
                ?>
                    <a href="index.php#information" class="text-decoration-none text-white fs-7">Informasi</a>
                <?php
                } else {
                ?>
                    <a href="index.php" class="text-decoration-none text-white fs-7">Informasi</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>

</html>