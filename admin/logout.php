<?php
require("../cores/connection.php");
require("../cores/Users.php");
session_start();

session_destroy();
header('Location: login.php');
