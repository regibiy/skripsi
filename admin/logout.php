<?php
include("action-admin.php");

unset($_SESSION['status_login_admin']);
unset($_SESSION['name']);
unset($_SESSION['role']);

header('Location: index.php');
