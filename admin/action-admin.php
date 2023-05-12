<?php
include("../cores/connection.php");
include("../cores/Users.php");
session_start();

$petugas = new Petugas();
if (isset($_POST['login'])) {
    if (!trim(empty($_POST['username'])) && trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi kata sandi";
        $_SESSION['username'] = $_POST['username'];
        header("Location: login.php");
    } elseif (trim(empty($_POST['username'])) || trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi username dan kata sandi";
        header("Location: login.php");
    } else {
        $petugas->set_login_data($_POST['username'], $_POST['password']);
        $username = $petugas->get_username();
        $password = $petugas->get_password();
        $sql = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['status_login_admin'] = "login_petugas";
            }
            header("Location: index.php");
        } else {
            $_SESSION['error_msg'] = "Username atau kata sandi salah";
            header("Location: login.php");
        }
    }
}

function check_status_login_admin()
{
    if (isset($_SESSION['status_login_admin'])) return true;
    else return false;
}
