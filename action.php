<?php
include("cores/connection.php");
include("cores/Users.php");
session_start();

function check_status_login_pasien()
{
    if (isset($_SESSION['status_login_pasien'])) return true;
    else return false;
}

function upload_file($file_name, $file_size, $temp_location)
{
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) {
        $_SESSION['error_msg'] = "Silakan masukkan foto KTP dengan ekstensi .jpg, .jpeg, atau .png";
        header("Location: account-registration.php");
    } else {
        if ($file_size > 3000000) {
            $_SESSION['error_msg'] = "Ukuran file harus kurang dari 3MB";
            header("Location: account-registration.php");
        } else {
            $new_file_name = uniqid() . "." . $ext;
            move_uploaded_file($temp_location, 'assets/patient_data/' . $new_file_name);
            return $new_file_name;
        }
    }
}

if (isset($_POST['login'])) {
    $pasien = new Pasien();
    if (!trim(empty($_POST['no_berobat'])) && trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi kata sandi";
        $_SESSION['no_berobat'] = $_POST['no_berobat'];
        header("Location: index.php");
    } elseif (trim(empty($_POST['no_berobat'])) || trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi nomor berobat dan kata sandi";
        header("Location: index.php");
    } else {
        $pasien->set_login_data($_POST['no_berobat'], $_POST['password']);
        $no_indeks = $pasien->get_no_berobat();
        $password = $pasien->get_password();
        $sql = "SELECT * FROM akun WHERE no_indeks = '$no_indeks' AND kata_sandi = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['status_login_pasien'] = "login_pasien";
                $_SESSION['no_berobat'] = $row['no_berobat'];
                $_SESSION['nama_pasien'] = $row['nama_depan'];
            }
            header("Location: index.php");
        } else {
            $_SESSION['error_msg'] = "No berobat tidak ditemukan";
            header("Location: index.php");
        }
    }
}

if (isset($_POST['daftar_akun_pasien'])) {
    $pasien = new Pasien;
    $pasien->set_daftar_data_identitas($_POST['no_kk'], $_POST['nik'], $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['tempat_lahir'], $_POST['tanggal_lahir']);
    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    $pasien->set_daftar_data_kontak($_POST['no_hp'], $_POST['email']);
    $pasien->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kel_desa'], $_POST['kecamatan']);
    $no_kk = $pasien->get_no_kk();
    $nik = $pasien->get_nik();
    $email = $pasien->get_email();
    $alamat = $pasien->get_alamat();
    $rt = $pasien->get_rt();
    $rw = $pasien->get_rw();
    $kel_desa = $pasien->get_kel_desa();
    $kecamatan = $pasien->get_kecamatan();
    $sql = "SELECT * FROM akun WHERE no_kk = '$no_kk'";
    $cek = $conn->query($sql);
    if ($cek->num_rows > 0) {
        $_SESSION['error_msg'] = "Nomor KK sudah terdaftar! Silakan ke <a href='forgot-account.php' class='text-decoration-none text-white fw-semibold'>halaman lupa akun</a> untuk dikirimkan nomor berobat dan kata sandi";
        header("Location: account-registration.php");
    } else {
        $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
        $cek = $conn->query($sql);
        if ($cek->num_rows > 0) {
            $_SESSION['error_msg'] = "NIK Anda terikat dengan KK lain! Silakan ubah Status Pasien pada akun terikat terlebih dahulu";
            header("Location: account-registration.php");
        } else {
            $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name']);
            $kk = upload_file($_FILES['kk']['name'], $_FILES['kk']['size'], $_FILES['kk']['tmp_name']);
            $sql = "INSERT INTO akun VALUES ('$no_kk', NULL, '$email', NULL, '$alamat', '$rt', '$rw', '$kel_desa', '$kecamatan', '$kk')";
            $result_akun = $conn->query($sql);
            if ($result) header("Location: succeed.php");
        }
    }
}
