<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_skripsi";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database gagal terhubung :" . $conn->connect_error);
}
