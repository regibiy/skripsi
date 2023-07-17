<?php

use Mpdf\Tag\Tr;

include("cores/connection.php");
include("cores/function.php");
include("cores/Users.php");
include("crypt.php");
session_start();

$kode_rekmed = array("Kepala Keluarga" => "00", "Istri" => "10", "Anak 1" => "01", "Anak 2" => "02", "Anak 3" => "03", "Anak 4" => "04", "Anak 5" => "05", "Anak 6" => "06", "Anak 7" => "07", "Anak 8" => "08", "Anak 9" => "09");

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
                    header("Location: poly-rooms.php");
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

if (isset($_SESSION['status_login_pasien'])) {
    $no_kk = $_SESSION['no_kk'];
    $sql = "SELECT * FROM pasien WHERE no_kk = '$no_kk' AND status_hubungan = 'Kepala Keluarga'";
    $result = $conn->query($sql);
    $data_header = $result->fetch_assoc();
    $_SESSION['nama_pasien'] = $data_header['nama_depan']; //update nama
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
    $nama_lengkap = $nama_depan . " " . $nama_belakang;
    $sql = "SELECT * FROM akun WHERE no_kk = '$no_kk'";
    $enc_nik = encrypt($nik);
    $result = $conn->query($sql);
    $prev_ktp = $_POST['prev_ktp'];
    if ($result->num_rows > 0) {
        $_SESSION['error_msg'] = "Nomor KK sudah terdaftar! Silakan ke <a href='forgot-account.php' class='text-decoration-none text-white fw-semibold'>halaman lupa akun</a> untuk dikirimkan nomor berobat dan kata sandi";
        header("Location: account-registration.php?nik=" . urlencode($enc_nik));
    } else {

        if (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 4) $ktp = NULL;
        elseif (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 0) $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
        elseif (($prev_ktp !== NULL || $prev_ktp !== "") && $ktp = $_FILES['ktp']['error'] === 0) {
            $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
            if ($ktp) unlink('assets/patient_data/' . $prev_ktp);
        } else $ktp = $prev_ktp;

        $kk = upload_file($_FILES['kk']['name'], $_FILES['kk']['size'], $_FILES['kk']['tmp_name'], 'assets/patient_data/');
        if (!$ktp || !$kk) {
            $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
            header("Location: account-registration.php?nik=" . urlencode($enc_nik));
        } else {
            $temp_password = substr($tanggal_lahir, 0, 4);
            $sql = "INSERT INTO akun VALUES ('$no_kk', NULL, '$email', '$temp_password', '$alamat', '$rt', '$rw', '$kel_desa', '$kecamatan', '$kk')";
            $result_akun = $conn->query($sql);
            $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $sql = "UPDATE pasien SET no_kk = '$no_kk', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir',
                jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = 'Kepala Keluarga', no_hp = '$no_hp', ktp = '$ktp', status_pasien = 'Dalam KK' WHERE nik = '$nik'";
                $result_pasien = $conn->query($sql);
            } else {
                $sql = "INSERT INTO pasien VALUES ('$nik', '$no_kk', '$nama_depan', '$nama_belakang', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$pekerjaan', 'Kepala Keluarga', '$no_hp', '$ktp', 'Dalam KK')";
                $result_pasien = $conn->query($sql);
                $sql = "INSERT INTO rekam_medis VALUES ('$nik', '$nik', NULL, NULL)";
                $result = $conn->query($sql);
            }
            if ($result_akun && $result_pasien) {
                $title = "Pendaftaran Berhasil";
                $content = "Hai, <b>" . $nama_lengkap . "</b><br><br><br>
                    Pendaftaran Anda telah diterima dan akan dikonfirmasi oleh petugas kami secepat mungkin. 
                    Petugas kami akan mengirimkan <i>email</i> kembali kepada Anda yang berisi nomor berobat dan kata sandi untuk <i>log in</i>.<br><br>
                    Terima kasih telah melakukan pendaftaran akun pada website kami.<br><br><br>
                    Salam,<br><br>
                    <b>UPT Puskesmas Alianyang</b><br>
                    Jl. Pangeran Natakusuma, Pontianak Kota";
                if (sendMail($email, $nama_lengkap, $title, $content)) {
                    $_SESSION['success_msg'] = "Pendaftaran berhasil! Silakan cek pesan di email Anda";
                    header("Location: account-registration.php");
                }
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
    $selected_date = $_POST['treatment_date'];
    $treatment_date = $_POST['treatment_date'];
    $timestamp = strtotime($selected_date);
    $month = date('n', $timestamp);
    $selected_date = date("Y-m-j", $timestamp);
    $url = "https://api-harilibur.vercel.app/api?month=$month";
    $data = file_get_contents($url);
    $arrayData = json_decode($data, true);
    $enc_treatment_date = encrypt($treatment_date);
    foreach ($arrayData as $value) {
        if ($selected_date === $value['holiday_date']) {
            $national_holiday = $value['holiday_name'];
            header("Location: poly-rooms.php?treatmentdate=" . urlencode($enc_treatment_date) . "&nationalholiday=" . $national_holiday);
            exit;
        }
    }
    header("Location: poly-rooms.php?treatmentdate=" . urlencode($enc_treatment_date));
}

if (isset($_POST['simpan_pendaftaran'])) {
    $pendaftaran = new Pendaftaran;
    $pendaftaran->set_data_pendaftaran($_POST['tanggal_daftar'], $_POST['nomor_antrian'], $_POST['no_rekam_medis'], $_POST['ruang_poli'], $_POST['tanggal_berobat']);
    $tanggal_daftar = $pendaftaran->get_tanggal_daftar();
    $nomor_antrian = $pendaftaran->get_nomor_antrian();
    $no_rek_med = $pendaftaran->get_nomor_rekam_medis();
    $tujuan_ruang = $pendaftaran->get_tujuan_ruang();
    $tanggal_berobat = $pendaftaran->get_tanggal_berobat();
    $sql = "INSERT INTO pendaftaran (tanggal_daftar, nomor_antrian, no_rekam_medis, id_ruang_poli, tanggal_berobat, status_pendaftaran)
    VALUES ('$tanggal_daftar', '$nomor_antrian', '$no_rek_med', '$tujuan_ruang', '$tanggal_berobat', 'Menunggu')";
    $result = $conn->query($sql);
    if ($result) {
        $pendaftaran->set_daftar_data_kontak($_POST['no_hp'], "");
        $no_hp = $pendaftaran->get_no_hp();
        $sql = "SELECT * FROM rekam_medis WHERE no_rekam_medis = '$no_rek_med'";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        $nik = $data['nik'];
        $sql = "UPDATE pasien SET no_hp = '$no_hp' WHERE nik = '$nik'";
        $result_no_hp = $conn->query($sql);
        $pendaftaran->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kel_desa'], $_POST['kecamatan']);
        $alamat = $pendaftaran->get_alamat();
        $rt = $pendaftaran->get_rt();
        $rw = $pendaftaran->get_rw();
        $kel_desa = $pendaftaran->get_kel_desa();
        $kecamatan = $pendaftaran->get_kecamatan();
        $no_kk = $_SESSION['no_kk'];
        $sql = "UPDATE akun SET alamat = '$alamat', rt = '$rt', rw = '$rw', kelurahan_desa = '$kel_desa', kecamatan = '$kecamatan' WHERE no_kk = '$no_kk'";
        $result_domisili = $conn->query($sql);
        if ($result_no_hp && $result_domisili) {
            $_SESSION['toaster'] = "Pendaftaran Anda berhasil dibuat";
            header("Location: my-registration.php");
        }
    }
}

if (isset($_POST['edit_kontak'])) {
    $no_kk = $_SESSION['no_kk'];
    $email = trim($_POST['email']);
    $sql = "UPDATE akun SET email = '$email' WHERE no_kk = '$no_kk'";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['toaster'] = "Data kontak Anda berhasil diperbarui";
        header("Location: family-members.php");
    }
}

if (isset($_POST['edit_support'])) {
    $no_kk = $_SESSION['no_kk'];
    $prev_kk = $_POST['prev_kk'];
    unlink('assets/patient_data/' . $prev_kk);
    $kk = upload_file($_FILES['new_kk']['name'], $_FILES['new_kk']['size'], $_FILES['new_kk']['tmp_name'], 'assets/patient_data/');
    if (!$kk) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: family-members.php");
    } else {
        $sql = "UPDATE akun SET kk = '$kk' WHERE no_kk = '$no_kk'";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION['toaster'] = "Data Pendukung Anda berhasil diperbarui";
            header("Location: family-members.php");
        }
    }
}

if (isset($_POST['edit_domisili'])) {
    $no_kk = $_SESSION['no_kk'];
    $pasien = new Pasien;
    $pasien->set_daftar_data_domisili(trim($_POST['alamat']), trim($_POST['rt']), trim($_POST['rw']), trim($_POST['kel_desa']), trim($_POST['kecamatan']));
    $alamat = $pasien->get_alamat();
    $rt = $pasien->get_rt();
    $rw = $pasien->get_rw();
    $kel_desa = $pasien->get_kel_desa();
    $kecamatan = $pasien->get_kecamatan();
    $sql = "UPDATE akun SET alamat = '$alamat', rt = '$rt', rw = '$rw', kelurahan_desa = '$kel_desa', kecamatan = '$kecamatan' WHERE no_kk = '$no_kk'";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['toaster'] = "Data domisili Anda berhasil diperbarui";
        header("Location: family-members.php");
    }
}

if (isset($_POST['cek_nik'])) {
    $nik = $_POST['nik_check'];
    $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
    $result = $conn->query($sql);
    $enc_nik = encrypt($nik);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status_pasien = $row['status_pasien'];
        if ($status_pasien === "Dalam KK") {
            $_SESSION['error_msg'] = "NIK " . $nik . " terikat dengan KK lain! Silakan ubah status pasien pada akun yang terikat terlebih dahulu";
            header("Location: family-members.php");
        } else header("Location: add-family-member.php?nik=" . urlencode($enc_nik));
    } else header("Location: add-family-member.php?nik=" . urlencode($enc_nik));
}

if (isset($_POST['cek_nik_daftar'])) {
    $nik = $_POST['nik_check'];
    $sql = "SELECT * FROM pasien WHERE nik = '$nik'";
    $result = $conn->query($sql);
    $enc_nik = encrypt($nik);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if ($data['status_pasien'] === "Luar KK") {
            $_SESSION['success_msg'] = "Silakan periksa kembali dan lengkapi data kepala keluarga sebelum disimpan";
            header("Location: account-registration.php?nik=" . urlencode($enc_nik));
        } else {
            $_SESSION['error_msg'] = "NIK " . $nik . " terikat dengan KK lain! Silakan ubah status pasien pada akun yang terikat terlebih dahulu";
            header("Location: account-registration.php");
        }
    } else {
        $_SESSION['success_msg'] = "Silakan lengkapi data kepala keluarga";
        header("Location: account-registration.php?nik=" . urlencode($enc_nik));
    }
}

if (isset($_POST['tambah_anggota'])) {
    $no_kk = $_SESSION['no_kk'];
    $status_hubungan = $_POST['status_hubungan'];
    $pasien = new Pasien;
    $pasien->set_daftar_data_identitas($no_kk, $_POST['nik'], $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['tempat_lahir'], $_POST['tanggal_lahir']);
    $nik = $pasien->get_nik();
    $nama_depan = $pasien->get_nama_depan();
    $nama_belakang = $pasien->get_nama_belakang();
    $tempat_lahir = $pasien->get_tempat_lahir();
    $tanggal_lahir = $pasien->get_tanggal_lahir();
    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    $jenis_kelamin = $pasien->get_jenis_kelamin();
    $agama = $pasien->get_agama();
    $pekerjaan = $pasien->get_pekerjaan();
    $pasien->set_daftar_data_kontak($_POST['no_hp'], "");
    $no_hp = $pasien->get_no_hp();
    $prev_ktp = $_POST['prev_ktp'];
    $no_berobat = $_SESSION['no_berobat'];
    $enc_nik = encrypt($nik);

    if (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 4) $ktp = NULL;
    elseif (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 0) $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
    elseif (($prev_ktp !== NULL || $prev_ktp !== "") && $ktp = $_FILES['ktp']['error'] === 0) {
        $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
        if ($ktp) unlink('assets/patient_data/' . $prev_ktp);
    } else $ktp = $prev_ktp;

    if ($ktp === false) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: add-family-member.php?nik=" . urlencode($enc_nik));
    } else {
        $sql = "SELECT * FROM pasien WHERE nik = '$nik'"; //uji apakah pasien sudah terdaftar
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            foreach ($kode_rekmed as $key => $value) {
                if ($status_hubungan === $key) $set_status_hubungan = $value;
            }
            $no_rekam_medis = $set_status_hubungan . $no_berobat;
            $sql = "SELECT * FROM rekam_medis WHERE no_rekam_medis = '$no_rekam_medis'"; //uji status hubungan
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['error_msg'] = "Status hubungan yang Anda pilih sudah ada di anggota keluarga Anda";
                header("Location: add-family-member.php?nik=" . urlencode($enc_nik));
            } else {
                $sql = "UPDATE rekam_medis SET no_rekam_medis = '$no_rekam_medis' WHERE nik = '$nik'";
                $result = $conn->query($sql);
                if ($result) {
                    $sql = "UPDATE pasien SET nik = '$nik', no_kk = '$no_kk', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
                    jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = '$status_hubungan', 
                    no_hp = '$no_hp', ktp = '$ktp', status_pasien = 'Dalam KK' WHERE nik = '$nik'";
                    $result = $conn->query($sql);
                    if ($result) {
                        $_SESSION['toaster'] = "Data anggota keluarga Anda berhasil ditambahkan";
                        header("Location: family-members.php");
                    }
                }
            }
        } else {
            foreach ($kode_rekmed as $key => $value) {
                if ($status_hubungan === $key) $set_status_hubungan = $value;
            }
            $no_rekam_medis = $set_status_hubungan . $no_berobat;
            $sql = "SELECT * FROM rekam_medis WHERE no_rekam_medis = '$no_rekam_medis'"; //uji status hubungan
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['error_msg'] = "Status hubungan yang Anda pilih sudah ada di anggota keluarga Anda";
                header("Location: add-family-member.php?nik=" . urlencode($enc_nik));
            } else {
                $sql = "INSERT INTO pasien VALUES ('$nik', '$no_kk', '$nama_depan', '$nama_belakang', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$pekerjaan', '$status_hubungan', '$no_hp', '$ktp', 'Dalam KK')";
                $result = $conn->query($sql);
                if ($result) {
                    $sql = "INSERT INTO rekam_medis (no_rekam_medis, nik) VALUES ('$no_rekam_medis', '$nik')";
                    $result = $conn->query($sql);
                    if ($result) {
                        $_SESSION['toaster'] = "Data anggota keluarga Anda berhasil ditambahkan";
                        header("Location: family-members.php");
                    }
                }
            }
        }
    }
}

if (isset($_POST['edit_anggota'])) {
    $no_kk = $_SESSION['no_kk'];
    $pasien = new Pasien;
    $pasien->set_daftar_data_identitas($no_kk, $_POST['nik'], $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['tempat_lahir'], $_POST['tanggal_lahir']);
    $nik = $pasien->get_nik();
    $nama_depan = $pasien->get_nama_depan();
    $nama_belakang = $pasien->get_nama_belakang();
    $tempat_lahir = $pasien->get_tempat_lahir();
    $tanggal_lahir = $pasien->get_tanggal_lahir();
    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    $jenis_kelamin = $pasien->get_jenis_kelamin();
    $agama = $pasien->get_agama();
    $pekerjaan = $pasien->get_pekerjaan();
    $pasien->set_daftar_data_kontak($_POST['no_hp'], "");
    $no_hp = $pasien->get_no_hp();
    $status_hubungan = $_POST['status_hubungan'];
    $status_hubungan_prev = $_POST['status_hubungan_prev'];
    $status_pasien = $_POST['status_pasien'];
    $no_berobat = $_SESSION['no_berobat'];
    $enc_nik = encrypt($nik);
    $prev_ktp = $_POST['prev_ktp'];
    $status_pasien_prev = $_POST['status_pasien_prev'];

    if (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 4) $ktp = NULL;
    elseif (($prev_ktp === NULL || $prev_ktp === "") && $ktp = $_FILES['ktp']['error'] === 0) $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
    elseif (($prev_ktp !== NULL || $prev_ktp !== "") && $ktp = $_FILES['ktp']['error'] === 0) {
        $ktp = upload_file($_FILES['ktp']['name'], $_FILES['ktp']['size'], $_FILES['ktp']['tmp_name'], 'assets/patient_data/');
        if ($ktp) unlink('assets/patient_data/' . $prev_ktp);
    } else $ktp = $prev_ktp;

    if ($ktp === false) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: edit-family-member.php?nik=" . urlencode($enc_nik));
    } else {
        if ($status_pasien !== $status_pasien_prev) {
            $sql = "SELECT COUNT(no_kk) AS total_anggota FROM pasien WHERE no_kk = '$no_kk'";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            if ($data['total_anggota'] > 1) {
                $sql = "UPDATE rekam_medis SET no_rekam_medis = '$nik' WHERE nik = '$nik'";
                $result = $conn->query($sql);
            } else {
                $_SESSION['error_msg'] = "Status pasien tidak dapat diubah karena jumlah anggota keluarga Anda";
                header("Location: edit-family-member.php?nik=" . urlencode($enc_nik));
                exit;
            }
        }

        if ($status_hubungan !== $status_hubungan_prev) {
            foreach ($kode_rekmed as $key => $value) {
                if ($status_hubungan === $key) $set_status_hubungan = $value;
            }
            $no_rekam_medis = $set_status_hubungan . $no_berobat;
            $sql = "SELECT * FROM rekam_medis WHERE no_rekam_medis = '$no_rekam_medis'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['error_msg'] = "Status hubungan yang Anda pilih sudah ada di anggota keluarga Anda";
                header("Location: edit-family-member.php?nik=" . urlencode($enc_nik));
            } else {
                $sql = "UPDATE rekam_medis SET no_rekam_medis = '$no_rekam_medis' WHERE nik = '$nik'";
                $result = $conn->query($sql);
                $sql = "UPDATE pasien SET nik = '$nik', no_kk = '$no_kk', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
                    jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = '$status_hubungan', 
                    no_hp = '$no_hp', ktp = '$ktp', status_pasien = '$status_pasien' WHERE nik = '$nik'";
                $result = $conn->query($sql);
                if ($result) {
                    $_SESSION['toaster'] = "Data anggota keluarga Anda berhasil diperbarui";
                    header("Location: family-members.php");
                }
            }
        } else {
            $sql = "UPDATE pasien SET nik = '$nik', no_kk = '$no_kk', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
                jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = '$status_hubungan', 
                no_hp = '$no_hp', ktp = '$ktp', status_pasien = '$status_pasien' WHERE nik = '$nik'";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION['toaster'] = "Data anggota keluarga Anda berhasil diperbarui";
                header("Location: family-members.php");
            }
        }
    }
}
