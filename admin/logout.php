<?php
include("action-admin.php");

unset($_SESSION['status_login_admin']);

header('Location: login.php');
