<?php
include("../crypt.php");
$string = "6171051710010005";
$string_to_replace = substr($string, 6, 8);
$text_replace = "";

for ($i = 1; $i <= strlen($string_to_replace); $i++) {
    $text_replace .= "*";
}

$replace = str_replace($string_to_replace, $text_replace, $string);

var_dump($replace);
