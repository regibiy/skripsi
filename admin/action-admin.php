<?php
include("../cores/connection.php");
include("../cores/Users.php");
session_start();

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
        $sql = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
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
                        $_SESSION['role'] = $row['role'];
                        if ($_SESSION['role'] == "daftar") {
                            header("Location: index-registration.php");
                        } elseif ($_SESSION['role'] == "rekmed") {
                            header("Location: index-medical-record.php");
                        } elseif ($_SESSION['role'] == "kapus") {
                            header("Location: index-head.php");
                        }
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
            $_SESSION['error_msg'] = "Username atau kata sandi salah";
            header("Location: index.php");
        }
    }
}

function check_status_login_admin()
{
    if (isset($_SESSION['status_login_admin'])) return true;
    else return false;
}
