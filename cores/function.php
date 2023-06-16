<?php
date_default_timezone_set("Asia/Jakarta");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($emailReceiver, $nameReceiver, $title, $content)
{
    $emailSender = "puskesmasalianyangpnkkota@gmail.com";
    $senderName = "Puskesmas Alianyang";
    //Load Composer's autoloader
    require getcwd() . '/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $emailSender;                           //SMTP username
        $mail->Password   = "zzurroffajkplakq";                     //MTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($emailSender, $senderName);
        $mail->addAddress($emailReceiver, $nameReceiver);           //Add a recipient

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function check_status_login_pasien()
{
    if (isset($_SESSION['status_login_pasien'])) return true;
    else return false;
}

function check_status_login_admin()
{
    if (isset($_SESSION['status_login_admin'])) return true;
    else return false;
}

function format_date($tanggal)
{
    $formatted_date = date_create($tanggal);
    return date_format($formatted_date, "d-m-Y");
}

function upload_file($file_name, $file_size, $temp_location, $target_location)
{
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png";
        return false;
    } else {
        if ($file_size > 3000000) {
            $_SESSION['error_msg'] = "Ukuran file harus kurang dari 3MB";
            return false;
        } else {
            $new_file_name = uniqid() . "." . $ext;
            move_uploaded_file($temp_location, $target_location . $new_file_name);
            return $new_file_name;
        }
    }
}

function get_total($column_name, $table_name)
{
    global $conn;
    $sql = "SELECT COUNT($column_name) as total FROM $table_name";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    return $data;
}

function get_data($table_name)
{
    global $conn;
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    return $result;
}

function generate_queue_number($treatment_date)
{
    global $conn;
    $sql = "SELECT MAX(nomor_antrian) as nomor_antrian FROM pendaftaran WHERE tanggal_berobat = '$treatment_date'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    if ($data['nomor_antrian'] === NULL) {
        $number = 1;
        if ($number < 10) $leading_zero = "000";
        elseif ($number > 9) $leading_zero = "00";
        elseif ($number > 99) $leading_zero = "0";
        $queue_number = "O" . $leading_zero . $number;
    } else {
        $queue_number = $data['nomor_antrian'];
        $number = substr($queue_number, 1, 4);
        $number = $number + 1;
        if ($number < 10) $leading_zero = "000";
        elseif ($number > 9) $leading_zero = "00";
        elseif ($number > 99) $leading_zero = "0";
        $queue_number = "O" . $leading_zero . $number;
    }
    return $queue_number;
}
