<?php
include("action.php");

unset($_SESSION['status_login_pasien']);
unset($_SESSION['no_berobat']);
unset($_SESSION['nama_pasien']);
unset($_SESSION['no_kk']);

header('Location: index.php');
