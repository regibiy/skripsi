<?php
require("connection.php");
require("Users.php");
session_start();
session_destroy();
header('Location: index.php');
