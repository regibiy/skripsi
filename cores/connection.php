<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_skripsi";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);
