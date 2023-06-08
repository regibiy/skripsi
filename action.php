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
    //cek extension file
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) {
        $_SESSION['error_msg'] = "Silakan masukkan foto KTP dengan ekstensi .jpg, .jpeg, atau .png";
        header("Location: account-registration.php");
    } else {
        //limit file size
        if ($file_size > 3000000) {
            $_SESSION['error_msg'] = "Ukuran file harus kurang dari 3MB";
            header("Location: account-registration.php");
        } else {
            echo $temp_location;
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
    // var_dump($pasien->get_no_kk());
    // var_dump($pasien->get_nik());
    // var_dump($pasien->get_nama_depan());
    // var_dump($pasien->get_nama_belakang());
    // var_dump($pasien->get_tempat_lahir());
    // var_dump($pasien->get_tanggal_lahir());

    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    // var_dump($pasien->get_jenis_kelamin());
    // var_dump($pasien->get_agama());
    // var_dump($pasien->get_pekerjaan());

    $pasien->set_daftar_data_kontak($_POST['no_hp'], $_POST['email']);
    // var_dump($pasien->get_no_hp());
    // var_dump($pasien->get_email());

    $pasien->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kel_desa'], $_POST['kecamatan']);
    // var_dump($pasien->get_alamat());
    // var_dump($pasien->get_rt());
    // var_dump($pasien->get_rw());
    // var_dump($pasien->get_kel_desa());
    // var_dump($pasien->get_kecamatan());

    $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name']);
    $kk = upload_file($_FILES['kk']['name'], $_FILES['kk']['size'], $_FILES['kk']['tmp_name']);
}
