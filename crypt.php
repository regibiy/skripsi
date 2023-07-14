<?php

function encrypt($data)
{

    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
    $ciphertext = openssl_encrypt($data, 'aes-128-cbc', 'sensitive_data', OPENSSL_RAW_DATA, $iv);
    $encrypted = $iv . $ciphertext;
    return base64_encode($encrypted);
}

function decrypt($ciphertext)
{
    $ciphertext = base64_decode($ciphertext);
    $iv = substr($ciphertext, 0, openssl_cipher_iv_length('aes-128-cbc'));
    $ciphertext = substr($ciphertext, openssl_cipher_iv_length('aes-128-cbc'));
    $data = openssl_decrypt($ciphertext, 'aes-128-cbc', 'sensitive_data', OPENSSL_RAW_DATA, $iv);
    if ($data === false) {
        if (isset($_SESSION['role'])) echo "<script>window.location='../error-page.php'</script>";
        else echo "<script>window.location='error-page.php'</script>";
        exit;
    } else {
        return $data;
    }
}
