<?php

use Mpdf\Tag\Tr;

include("cores/function.php");
include("cores/connection.php");
include("cores/Users.php");
session_start();

if (isset($_POST['login'])) {
    $pasien = new Pasien();
    if (!trim(empty($_POST['no_berobat'])) && trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi kata sandi";
        $_SESSION['no_berobat'] = $_POST['no_berobat'];
        header("Location: index.php");
    } elseif (trim(empty($_POST['no_berobat'])) || trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi nomor berobat dan kata sandi";
        header("Location: index.php");
    } else {
        $pasien->set_login_data($_POST['no_berobat'], $_POST['password']);
        $no_indeks = $pasien->get_no_berobat();
        $password = $pasien->get_password();
        $sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk WHERE akun.no_indeks = '$no_indeks' AND pasien.status_hubungan = 'Kepala Keluarga'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $db_password = $row['kata_sandi'];
                if ($password === $db_password) {
                    $_SESSION['status_login_pasien'] = "login_pasien";
                    $_SESSION['no_berobat'] = $row['no_indeks'];
                    $_SESSION['nama_pasien'] = $row['nama_depan'];
                    $_SESSION['no_kk'] = $row['no_kk'];
                    header("Location: index.php");
                } else {
                    $_SESSION['error_msg'] = "No berobat atau kata sandi salah";
                    header("Location: index.php");
                }
            }
        } else {
            $_SESSION['error_msg'] = "No berobat tidak ditemukan";
            header("Location: index.php");
        }
    }
}

if (isset($_POST['daftar_akun_pasien'])) {
    $pasien = new Pasien;
    $pasien->set_daftar_data_identitas($_POST['no_kk'], $_POST['nik'], $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['tempat_lahir'], $_POST['tanggal_lahir']);
    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    $pasien->set_daftar_data_kontak($_POST['no_hp'], $_POST['email']);
    $pasien->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kel_desa'], $_POST['kecamatan']);
    $no_kk = $pasien->get_no_kk();
    $nik = $pasien->get_nik();
    $nama_depan = $pasien->get_nama_depan();
    $nama_belakang = $pasien->get_nama_belakang();
    $tempat_lahir = $pasien->get_tempat_lahir();
    $tanggal_lahir = $pasien->get_tanggal_lahir();
    $jenis_kelamin = $pasien->get_jenis_kelamin();
    $agama = $pasien->get_agama();
    $pekerjaan = $pasien->get_pekerjaan();
    $no_hp = $pasien->get_no_hp();
    $email = $pasien->get_email();
    $alamat = $pasien->get_alamat();
    $rt = $pasien->get_rt();
    $rw = $pasien->get_rw();
    $kel_desa = $pasien->get_kel_desa();
    $kecamatan = $pasien->get_kecamatan();
    $sql = "SELECT * FROM akun WHERE no_kk = '$no_kk'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['error_msg'] = "Nomor KK sudah terdaftar! Silakan ke <a href='forgot-account.php' class='text-decoration-none text-white fw-semibold'>halaman lupa akun</a> untuk dikirimkan nomor berobat dan kata sandi";
        header("Location: account-registration.php");
    } else {
        $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['error_msg'] = "NIK Anda terikat dengan KK lain! Silakan ubah Status Pasien pada akun terikat terlebih dahulu";
            header("Location: account-registration.php");
        } else {
            $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
            $kk = upload_file($_FILES['kk']['name'], $_FILES['kk']['size'], $_FILES['kk']['tmp_name'], 'assets/patient_data/');
            $temp_password = substr($tanggal_lahir, 0, 4);
            $sql = "INSERT INTO akun VALUES ('$no_kk', NULL, '$email', '$temp_password', '$alamat', '$rt', '$rw', '$kel_desa', '$kecamatan', '$kk')";
            $result_akun = $conn->query($sql);
            $sql = "INSERT INTO pasien VALUES ('$nik','$no_kk', '$nama_depan', '$nama_belakang', '$tempat_lahir','$tanggal_lahir', '$jenis_kelamin', '$agama', '$pekerjaan', 'Kepala Keluarga', '$no_hp', '$ktp', 'Dalam KK')";
            $result_pasien = $conn->query($sql);
            if ($result_akun && $result_pasien) {
                $_SESSION['no_kk'] = $no_kk;
                include("account-registration-succeed.php");
                $_SESSION['success_msg'] = "Pendaftaran berhasil! Silakan cek pesan di email Anda";
                header("Location: account-registration.php");
            }
        }
    }
}

if (isset($_POST['forgot-account'])) {
    $pasien = new Pasien;
    $pasien->set_daftar_data_kontak("", $_POST['email']);
    $email = $pasien->get_email();
    $sql = "SELECT * FROM akun INNER JOIN pasien ON akun.no_kk = pasien.no_kk WHERE akun.email = '$email' AND pasien.status_hubungan = 'Kepala Keluarga'";
    $result = $conn->query($sql);
    if (!$result->num_rows > 0) {
        $_SESSION['error_msg'] = "Email yang Anda masukkan tidak terdaftar";
        header("Location: forgot-account.php");
    } else {
        while ($row = $result->fetch_assoc()) {
            $no_indeks = $row['no_indeks'];
            if ($no_indeks === NULL) {
                $_SESSION['error_msg'] = "Akun Anda belum diproses oleh petugas kami! Silakan tunggu email dari petugas kami atau cek kembali email Anda";
                header("Location: forgot-account.php");
            } elseif ($no_indeks !== NULL) {
                $full_name = $row['nama_depan'] . " " . $row['nama_belakang'];
                $password = $row['kata_sandi'];
                $title = "Nomor Berobat dan Kata Sandi Anda";
                $content = "Hai, <b>" . $full_name . "</b>
                <br><br><br>
                Berikut adalah informasi akun Anda :
                <br><br>
                Nomor Berobat : <b>" . $no_indeks . "</b><br>
                Kata Sandi : <b>" . $password . "</b><br>
                <br>
                Kata sandi terdiri dari tahun lahir kepala keluarga dan lima angka terakhir dari nomor berobat Anda.
                <br>
                Terima kasih telah menggunakan website pendaftaran rawat jalan kami.
                <br><br>
                Salam,
                <br><br>
                <b>UPT Puskesmas Alianyang</b>
                <br>
                Jalan Pangeran Natakusuma, Pontianak Kota 
                ";
                sendMail($email, $full_name, $title, $content);
            }
        }
        $_SESSION['success_msg'] = "Nomor berobat dan kata sandi berhasil dikirim! Silakan cek email Anda";
        header("Location: forgot-account.php");
    }
}

if (isset($_POST['pilih_tanggal'])) {
    $selected_date = $_POST['register_date'];
    $register_date = $_POST['register_date'];
    $timestamp = strtotime($selected_date);
    $month = date('n', $timestamp);
    $selected_date = date("Y-m-j", $timestamp);
    $url = "https://api-harilibur.vercel.app/api?month=$month";
    $data = file_get_contents($url);
    $arrayData = json_decode($data, true);
    foreach ($arrayData as $value) {
        if ($selected_date === $value['holiday_date']) {
            $_SESSION['error_msg'] = "Puskesmas tidak melayani apapun karena memperingati " . $value['holiday_name'];
            header("Location: poly-rooms.php");
        }
    }
    header("Location: poly-rooms.php?registerdate=" . $register_date);
    // $sql = "SELECT ruang_poli.nama_ruang_poli, COUNT(id_pendaftaran) AS jumlah_pendaftar FROM ruang_poli LEFT JOIN pendaftaran ON ruang_poli.id_ruang_poli = pendaftaran.id_ruang_poli WHERE tanggal_daftar = CURRENT_DATE GROUP BY ruang_poli.id_ruang_poli";
}

if (isset($_POST['simpan_pendaftaran'])) {
    $pendaftaran = new Pendaftaran();
    $pendaftaran->set_data_pendaftaran($_POST['tanggal_daftar'], $_POST['nomor_antrian'], $_POST['no_rekam_medis'], $_POST['ruang_poli'], $_POST['tanggal_berobat']);
    $test = $_POST['no_rekam_medis'];
    var_dump($test);
    die;
    $pendaftaran->set_daftar_data_kontak($_POST['no_hp'], "");
    $pendaftaran->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kel_desa'], $_POST['kecamatan']);
    die;
}
