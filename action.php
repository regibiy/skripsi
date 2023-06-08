<?php
include("cores/connection.php");
include("cores/Users.php");
session_start();

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

function check_status_login_pasien()
{
    if (isset($_SESSION['status_login_pasien'])) return true;
    else return false;
}
