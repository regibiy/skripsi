<?php
include("../cores/function.php");
include("../cores/connection.php");
include("../cores/Users.php");
include("../crypt.php");
session_start();
date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['login'])) {
    $petugas = new Petugas();
    if (!trim(empty($_POST['username'])) && trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi kata sandi";
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php");
    } elseif (trim(empty($_POST['username'])) || trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi username dan kata sandi";
        header("Location: index.php");
    } else {
        $petugas->set_login_data($_POST['username'], $_POST['password']);
        $username = $petugas->get_username();
        $password = $petugas->get_password();
        $sql = "SELECT * FROM petugas WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['status_petugas'];
                $db_username = $row['username'];
                $db_password = $row['password'];
                if ($db_username === $username && $db_password === $password) {
                    if ($status === "Aktif") {
                        $_SESSION['status_login_admin'] = "login_petugas";
                        $_SESSION['name'] = $row['nama_depan'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = $row['role'];
                        if ($_SESSION['role'] == "daftar") header("Location: index-registration.php");
                        elseif ($_SESSION['role'] == "rekmed") header("Location: index-medical-record.php");
                        elseif ($_SESSION['role'] == "kapus") header("Location: index-head.php");
                    } else {
                        $_SESSION['error_msg'] = "Akun anda telah dinonaktifkan";
                        header("Location: index.php");
                    }
                } else {
                    $_SESSION['error_msg'] = "Username atau kata sandi salah";
                    header("Location: index.php");
                }
            }
        } else {
            $_SESSION['error_msg'] = "Username tidak ditemukan";
            header("Location: index.php");
        }
    }
}

if (isset($_POST['tambah_petugas'])) {
    $petugas = new Data_Petugas;
    $petugas->set_login_data(trim($_POST['username']), $_POST['password']);
    $username = $petugas->get_username();
    $password = $petugas->get_password();
    $petugas->set_manage_data_officer(trim($_POST['nama_depan']), trim($_POST['nama_belakang']), $_POST['role'], $_POST['status']);
    $nama_depan = $petugas->get_nama_depan();
    $nama_belakang = $petugas->get_nama_belakang();
    $role = $petugas->get_role();
    $status = $petugas->get_status();
    $sql = "SELECT * FROM petugas WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['error_msg'] = "Username <b>" . $username . "</b> telah digunakan!";
        $_SESSION['nama_depan'] = $nama_depan;
        $_SESSION['nama_belakang'] = $nama_belakang;
        header("Location: add-officer.php");
    } else {
        $sql = "INSERT INTO petugas VALUES ('$username', '$nama_depan', '$nama_belakang', '$password', '$role', '$status')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data petugas berhasil ditambahkan!');
            window.location='officer.php';
            </script>";
        }
    }
}

if (isset($_POST['edit_petugas'])) {
    $petugas = new Data_Petugas;
    $petugas->set_login_data($_POST['username'], $_POST['password']);
    $username = $petugas->get_username();
    $password = $petugas->get_password();
    $petugas->set_manage_data_officer(trim($_POST['nama_depan']), trim($_POST['nama_belakang']), $_POST['role'], $_POST['status']);
    $nama_depan = $petugas->get_nama_depan();
    $nama_belakang = $petugas->get_nama_belakang();
    $role = $petugas->get_role();
    $status = $petugas->get_status();

    $sql = "UPDATE petugas SET username = '$username', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', 
    password = '$password', role = '$role', status_petugas = '$status' WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data petugas berhasil diperbarui!');
        window.location='officer.php';
        </script>";
    }
}

if (isset($_POST['tambah_ruang'])) {
    $ruang_poli = new Ruang_Poli;
    $ruang_poli->set_data_ruang(trim($_POST['nama']), $_POST['status']);
    $nama_ruang = $ruang_poli->get_nama_ruang();
    $status_ruang = $ruang_poli->get_status_ruang();
    $gambar_ruang = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');
    if (!$gambar_ruang) {
        $_SESSION['nama_ruang'] = $nama_ruang;
        header("Location: add-poly-room-head.php");
    } else {
        $sql = "INSERT INTO ruang_poli (nama_ruang_poli, gambar_ruang_poli, status_ruang_poli) VALUES ('$nama_ruang', '$gambar_ruang', '$status_ruang')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data ruang poli berhasil ditambahkan!');
            window.location='poly-room-head.php';
            </script>";
        }
    }
}

if (isset($_POST['edit_ruang'])) {
    $ruang_poli = new Ruang_Poli;
    $ruang_poli->set_data_ruang(trim($_POST['nama']), $_POST['status']);
    $nama_ruang = $ruang_poli->get_nama_ruang();
    $status_ruang = $ruang_poli->get_status_ruang();
    $id_ruang = $_POST['id_ruang'];
    $prev_image = $_POST['prev_image'];

    if ($gambar_ruang = $_FILES['gambar']['error'] === 4) $gambar_edit = $prev_image;
    else {
        unlink('assets/images/' . $prev_image);
        $gambar_edit = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');
    }

    $sql = "UPDATE ruang_poli SET nama_ruang_poli = '$nama_ruang', gambar_ruang_poli = '$gambar_edit', status_ruang_poli = '$status_ruang' WHERE id_ruang_poli = '$id_ruang'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
            alert('Data ruang poli berhasil diperbarui!');
            window.location = 'poly-room-head.php';
            </script>";
    }
}

if (isset($_POST['tambah_informasi'])) {
    $informasi = new Informasi_Kegiatan;
    $informasi->set_data_informasi($_POST['judul'], $_POST['deskripsi'], $_POST['dokter'], $_POST['tanggal'], $_POST['jam_mulai'], $_POST['jam_selesai']);
    $judul = $informasi->get_judul();
    $tanggal_unggah = date('Y-m-d H:i:s');
    $username = $_SESSION['username'];
    $deskripsi = $informasi->get_deskripsi();
    $dokter = $informasi->get_dokter();
    $tanggal = $informasi->get_tanggal();
    $jam_mulai = $informasi->get_jam_mulai();
    $jam_selesai = $informasi->get_jam_selesai();
    $enc_id_dokter = $_POST['id_dokter'];
    $dec_id_dokter = decrypt($enc_id_dokter);
    $gambar = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');

    $sql = "INSERT INTO informasi (judul, tanggal_unggah, username, deskripsi, gambar, tanggal, jam_mulai, jam_selesai, id_dokter)
            VALUES ('$judul', '$tanggal_unggah', '$username', '$deskripsi', '$gambar', '$tanggal', '$jam_mulai', '$jam_selesai', '$dec_id_dokter')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data informasi kegiatan berhasil ditambahkan!');
        window.location = 'activity-registration.php';
        </script>";
    }
}

if (isset($_POST['edit_informasi'])) {
    $informasi = new Informasi_Kegiatan;
    $informasi->set_data_informasi($_POST['judul'], $_POST['deskripsi'], $_POST['dokter'], $_POST['tanggal'], $_POST['jam_mulai'], $_POST['jam_selesai']);
    $judul = $informasi->get_judul();
    $tanggal_ubah = date('Y-m-d H:i:s');
    $deskripsi = $informasi->get_deskripsi();
    $prev_gambar = $_POST['prev_gambar'];
    $tanggal = $informasi->get_tanggal();
    $jam_mulai = $informasi->get_jam_mulai();
    $jam_selesai = $informasi->get_jam_selesai();
    $id_dokter = $informasi->get_dokter();

    if ($gambar = $_FILES['gambar']['error'] === 4) $gambar_edit = $prev_gambar;
    else {
        unlink('assets/images/' . $prev_gambar);
        $gambar_edit = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');
    }

    $sql = "UPDATE informasi SET judul = '$judul', tanggal_ubah = '$tanggal_ubah', deskripsi = '$deskripsi', gambar = '$gambar_edit', tanggal = '$tanggal', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', id_dokter = '$id_dokter'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data informasi kegiatan berhasil diperbarui!');
        window.location = 'activity-registration.php';
        </script>";
    }
}

if (isset($_POST['tambah_dokter'])) {
    $dokter = new Dokter;
    $dokter->set_data_dokter($_POST['nama'], $_POST['spesialisasi'], $_POST['noHp'], $_POST['alamat']);
    $nama = $dokter->get_nama();
    $spesialisasi = $dokter->get_spesialisasi();
    $no_hp = $dokter->get_no_hp();
    $alamat = $dokter->get_alamat();

    $sql = "INSERT INTO dokter (nama_dokter, spesialisasi, no_hp, alamat) VALUES ('$nama', '$spesialisasi', '$no_hp', '$alamat')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data dokter berhasil ditambah!');
        window.location = 'add-activity-registration.php';
        </script>";
    }
}

if (isset($_POST['edit_dokter'])) {
    $dokter = new Dokter;
    $id_dokter = $_POST['id_dokter'];
    $dokter->set_data_dokter($_POST['nama'], $_POST['spesialisasi'], $_POST['no_hp'], $_POST['alamat']);
    $nama = $dokter->get_nama();
    $spesialisasi = $dokter->get_spesialisasi();
    $no_hp = $dokter->get_no_hp();
    $alamat = $dokter->get_alamat();

    $sql = "UPDATE dokter SET nama_dokter = '$nama', spesialisasi = '$spesialisasi', no_hp = '$no_hp', alamat = '$alamat' WHERE id_dokter = '$id_dokter'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data dokter berhasil diperbarui!');
        window.location = 'add-activity-registration.php';
        </script>";
    }
}
