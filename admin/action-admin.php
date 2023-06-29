<?php

use Mpdf\Barcode\Postnet;

include("../cores/connection.php");
include("../cores/function.php");
include("../cores/Users.php");
include("../crypt.php");
session_start();
date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['login'])) {
    $petugas = new Petugas();
    if (!trim(empty($_POST['username'])) && trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi kata sandi";
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php");
    } elseif (trim(empty($_POST['username'])) || trim(empty($_POST['password']))) {
        $_SESSION['error_msg'] = "Silakan isi username dan kata sandi";
        header("Location: index.php");
    } else {
        $petugas->set_login_data($_POST['username'], $_POST['password']);
        $username = $petugas->get_username();
        $password = $petugas->get_password();
        $sql = "SELECT * FROM petugas WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['status_petugas'];
                $db_username = $row['username'];
                $db_password = $row['password'];
                if ($db_username === $username && $db_password === $password) {
                    if ($status === "Aktif") {
                        $_SESSION['status_login_admin'] = "login_petugas";
                        $_SESSION['name'] = $row['nama_depan'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = $row['role'];
                        if ($_SESSION['role'] == "daftar") header("Location: index-registration.php");
                        elseif ($_SESSION['role'] == "rekmed") header("Location: index-medical-record.php");
                        elseif ($_SESSION['role'] == "kapus") header("Location: index-head.php");
                    } else {
                        $_SESSION['error_msg'] = "Akun anda telah dinonaktifkan";
                        header("Location: index.php");
                    }
                } else {
                    $_SESSION['error_msg'] = "Username atau kata sandi salah";
                    header("Location: index.php");
                }
            }
        } else {
            $_SESSION['error_msg'] = "Username tidak ditemukan";
            header("Location: index.php");
        }
    }
}

if (isset($_POST['tambah_petugas'])) {
    $petugas = new Data_Petugas;
    $petugas->set_login_data(trim($_POST['username']), $_POST['password']);
    $username = $petugas->get_username();
    $password = $petugas->get_password();
    $petugas->set_manage_data_officer(trim($_POST['nama_depan']), trim($_POST['nama_belakang']), $_POST['role'], $_POST['status']);
    $nama_depan = $petugas->get_nama_depan();
    $nama_belakang = $petugas->get_nama_belakang();
    $role = $petugas->get_role();
    $status = $petugas->get_status();
    $sql = "SELECT * FROM petugas WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['error_msg'] = "Username <b>" . $username . "</b> telah digunakan!";
        $_SESSION['nama_depan'] = $nama_depan;
        $_SESSION['nama_belakang'] = $nama_belakang;
        header("Location: add-officer.php");
    } else {
        $sql = "INSERT INTO petugas VALUES ('$username', '$nama_depan', '$nama_belakang', '$password', '$role', '$status')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data petugas berhasil ditambahkan!');
            window.location='officer.php';
            </script>";
        }
    }
}

if (isset($_POST['edit_petugas'])) {
    $petugas = new Data_Petugas;
    $petugas->set_login_data($_POST['username'], $_POST['password']);
    $username = $petugas->get_username();
    $password = $petugas->get_password();
    $petugas->set_manage_data_officer(trim($_POST['nama_depan']), trim($_POST['nama_belakang']), $_POST['role'], $_POST['status']);
    $nama_depan = $petugas->get_nama_depan();
    $nama_belakang = $petugas->get_nama_belakang();
    $role = $petugas->get_role();
    $status = $petugas->get_status();

    $sql = "UPDATE petugas SET username = '$username', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', 
    password = '$password', role = '$role', status_petugas = '$status' WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data petugas berhasil diperbarui!');
        window.location='officer.php';
        </script>";
    }
}

if (isset($_POST['tambah_ruang'])) {
    $ruang_poli = new Ruang_Poli;
    $ruang_poli->set_data_ruang(trim($_POST['nama']), $_POST['status']);
    $nama_ruang = $ruang_poli->get_nama_ruang();
    $status_ruang = $ruang_poli->get_status_ruang();
    $gambar_ruang = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');
    if (!$gambar_ruang) {
        $_SESSION['nama_ruang'] = $nama_ruang;
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: add-poly-room-head.php");
    } else {
        $sql = "INSERT INTO ruang_poli (nama_ruang_poli, gambar_ruang_poli, status_ruang_poli) VALUES ('$nama_ruang', '$gambar_ruang', '$status_ruang')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data ruang poli berhasil ditambahkan!');
            window.location='poly-room-head.php';
            </script>";
        }
    }
}

if (isset($_POST['edit_ruang'])) {
    $ruang_poli = new Ruang_Poli;
    $ruang_poli->set_data_ruang(trim($_POST['nama']), $_POST['status']);
    $nama_ruang = $ruang_poli->get_nama_ruang();
    $status_ruang = $ruang_poli->get_status_ruang();
    $id_ruang = $_POST['id_ruang'];
    $prev_image = $_POST['prev_image'];
    $enc_id_ruang = encrypt($id_ruang);

    if ($gambar_ruang = $_FILES['gambar']['error'] === 4) $gambar_edit = $prev_image;
    else $gambar_edit = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');

    if (!$gambar_edit) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: edit-poly-room-head.php?idruang=" . urlencode($enc_id_ruang));
    } else {
        unlink('assets/images/' . $prev_image);
        $sql = "UPDATE ruang_poli SET nama_ruang_poli = '$nama_ruang', gambar_ruang_poli = '$gambar_edit', status_ruang_poli = '$status_ruang' WHERE id_ruang_poli = '$id_ruang'";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
                alert('Data ruang poli berhasil diperbarui!');
                window.location = 'poly-room-head.php';
                </script>";
        }
    }
}

if (isset($_POST['tambah_informasi'])) {
    $informasi = new Informasi_Kegiatan;
    $informasi->set_data_informasi($_POST['judul'], $_POST['deskripsi'], $_POST['dokter'], $_POST['tanggal'], $_POST['jam_mulai'], $_POST['jam_selesai']);
    $judul = $informasi->get_judul();
    $tanggal_unggah = date('Y-m-d H:i:s');
    $username = $_SESSION['username'];
    $deskripsi = nl2br($informasi->get_deskripsi()); //agar format tetap
    $dokter = $informasi->get_dokter();
    $tanggal = $informasi->get_tanggal();
    $jam_mulai = $informasi->get_jam_mulai();
    $jam_selesai = $informasi->get_jam_selesai();
    $enc_id_dokter = $_POST['id_dokter'];
    $dec_id_dokter = decrypt($enc_id_dokter);
    $gambar = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');
    if (!$gambar) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: add-activity-registration.php");
    } else {
        $sql = "INSERT INTO informasi (judul, tanggal_unggah, username, deskripsi, gambar, tanggal, jam_mulai, jam_selesai, id_dokter)
        VALUES ('$judul', '$tanggal_unggah', '$username', '$deskripsi', '$gambar', '$tanggal', '$jam_mulai', '$jam_selesai', '$dec_id_dokter')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data informasi kegiatan berhasil ditambahkan!');
            window.location = 'activity-registration.php';
            </script>";
        }
    }
}

if (isset($_POST['edit_informasi'])) {
    $informasi = new Informasi_Kegiatan;
    $id_informasi = $_POST['id_informasi'];
    $informasi->set_data_informasi($_POST['judul'], $_POST['deskripsi'], $_POST['dokter'], $_POST['tanggal'], $_POST['jam_mulai'], $_POST['jam_selesai']);
    $judul = $informasi->get_judul();
    $tanggal_ubah = date('Y-m-d H:i:s');
    $deskripsi = nl2br($informasi->get_deskripsi());
    $prev_gambar = $_POST['prev_gambar'];
    $tanggal = $informasi->get_tanggal();
    $jam_mulai = $informasi->get_jam_mulai();
    $jam_selesai = $informasi->get_jam_selesai();
    $id_dokter = $informasi->get_dokter();
    $enc_id_informasi = encrypt($id_informasi);

    if ($gambar = $_FILES['gambar']['error'] === 4) $gambar_edit = $prev_gambar;
    else $gambar_edit = upload_file($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], 'assets/images/');

    if (!$gambar_edit) {
        $_SESSION['error_msg'] = "Silakan masukkan gambar dengan ekstensi .jpg, .jpeg, atau .png dengan ukuran kurang dari 3MB";
        header("Location: edit-activity-registration.php?idInformasi=" . $enc_id_informasi);
    } else {
        unlink('assets/images/' . $prev_gambar);
        $sql = "UPDATE informasi SET judul = '$judul', tanggal_ubah = '$tanggal_ubah', deskripsi = '$deskripsi', gambar = '$gambar_edit', tanggal = '$tanggal', jam_mulai = '$jam_mulai', 
        jam_selesai = '$jam_selesai', id_dokter = '$id_dokter' WHERE id_informasi = '$id_informasi'";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>
            alert('Data informasi kegiatan berhasil diperbarui!');
            window.location = 'activity-registration.php';
            </script>";
        }
    }
}

if (isset($_POST['tambah_dokter'])) {
    $dokter = new Dokter;
    $dokter->set_data_dokter($_POST['nama'], $_POST['spesialisasi'], $_POST['noHp'], $_POST['alamat']);
    $nama = $dokter->get_nama();
    $spesialisasi = $dokter->get_spesialisasi();
    $no_hp = $dokter->get_no_hp();
    $alamat = $dokter->get_alamat();

    $sql = "INSERT INTO dokter (nama_dokter, spesialisasi, no_hp, alamat) VALUES ('$nama', '$spesialisasi', '$no_hp', '$alamat')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data dokter berhasil ditambah!');
        window.location = 'add-activity-registration.php';
        </script>";
    }
}

if (isset($_POST['edit_dokter'])) {
    $dokter = new Dokter;
    $id_dokter = $_POST['id_dokter'];
    $dokter->set_data_dokter($_POST['nama'], $_POST['spesialisasi'], $_POST['no_hp'], $_POST['alamat']);
    $nama = $dokter->get_nama();
    $spesialisasi = $dokter->get_spesialisasi();
    $no_hp = $dokter->get_no_hp();
    $alamat = $dokter->get_alamat();

    $sql = "UPDATE dokter SET nama_dokter = '$nama', spesialisasi = '$spesialisasi', no_hp = '$no_hp', alamat = '$alamat' WHERE id_dokter = '$id_dokter'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Data dokter berhasil diperbarui!');
        window.location = 'add-activity-registration.php';
        </script>";
    }
}

if (isset($_POST['edit_status'])) {
    $waktu_daftar_ulang = date('Y-m-d H:i:s');
    $status = $_POST['status'];
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $sql = "UPDATE pendaftaran SET status_pendaftaran = '$status', tanggal_ubah = '$waktu_daftar_ulang' WHERE id_pendaftaran = '$id_pendaftaran'";
    $result = $conn->query($sql);
    if ($result) header("Location: index-registration.php");
}

if (isset($_POST['edit_status_rekmed'])) {
    $status = $_POST['status'];
    $id_pendaftaran =  $_POST['id_pendaftaran'];
    $sql = "UPDATE pendaftaran SET status_pendaftaran = '$status' WHERE id_pendaftaran = '$id_pendaftaran'";
    $result = $conn->query($sql);
    if ($result) header("Location: all-registration-medical-record.php");
}

if (isset($_POST['set_tanggal_daftar'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $enc_tanggal_awal = encrypt($tanggal_awal);
    $enc_tanggal_akhir = encrypt($tanggal_akhir);
    header("Location: all-registration.php?tanggalAwal=" . urlencode($enc_tanggal_awal) . "&tanggalAkhir=" . urlencode($enc_tanggal_akhir));
}

if (isset($_POST['set_tanggal_daftar_rekmed'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $enc_tanggal_awal = encrypt($tanggal_awal);
    $enc_tanggal_akhir = encrypt($tanggal_akhir);
    header("Location: all-registration-medical-record.php?tanggalAwal=" . urlencode($enc_tanggal_awal) . "&tanggalAkhir=" . urlencode($enc_tanggal_akhir));
}

if (isset($_POST['cetak_laporan'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $enc_tanggal_awal = encrypt($tanggal_awal);
    $enc_tanggal_akhir = encrypt($tanggal_akhir);
    header("Location: print-indirect-contact-registration.php?tanggalAwal=" . urlencode($enc_tanggal_awal) . "&tanggalAkhir=" . urlencode($enc_tanggal_akhir));
}

if (isset($_POST['cetak_laporan_rekmed'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $enc_tanggal_awal = encrypt($tanggal_awal);
    $enc_tanggal_akhir = encrypt($tanggal_akhir);
    header("Location: print-indirect-contact-medical-record.php?tanggalAwal=" . urlencode($enc_tanggal_awal) . "&tanggalAkhir=" . urlencode($enc_tanggal_akhir));
}

if (isset($_POST['selesai_daftar'])) {
    $id_daftar = $_POST['id_daftar'];
    $sql = "UPDATE pendaftaran SET status_pendaftaran = 'Selesai' WHERE id_pendaftaran = '$id_daftar'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>
        alert('Pendaftaran berhasil diselesaikan! Kontrol semua data pendaftaran pasien pada menu Pendaftaran');
        window.location = 'index-medical-record.php';
        </script>";
    }
}

if (isset($_POST['edit_data_kk_rekmed'])) {
    $akun = new Akun;
    $akun->set_data_akun($_POST['no_kk'], $_POST['no_indeks'], $_POST['password']);
    $no_kk = $akun->get_no_kk();
    $no_indeks = $akun->get_no_indeks();
    $password = $akun->get_kata_sandi();
    $akun->set_daftar_data_domisili($_POST['alamat'], $_POST['rt'], $_POST['rw'], $_POST['kelurahan_desa'], $_POST['kecamatan']);
    $alamat = $akun->get_alamat();
    $rt = $akun->get_rt();
    $rw = $akun->get_rw();
    $kel_desa = $akun->get_kel_desa();
    $kecamatan = $akun->get_kecamatan();
    $email = $_POST['email'];
    $enc_no_kk = encrypt($no_kk);
    $sql = "UPDATE akun SET no_kk = '$no_kk', no_indeks = '$no_indeks', kata_sandi = '$password',
    alamat = '$alamat', rt = '$rt', rw = '$rw', kelurahan_desa = '$kel_desa', kecamatan = '$kecamatan' WHERE no_kk = '$no_kk'";
    $result = $conn->query($sql);
    if ($result) {
        $sql = "SELECT pasien.nik, nama_depan, nama_belakang, no_rekam_medis, no_kk FROM pasien LEFT JOIN rekam_medis ON pasien.nik = rekam_medis.nik 
        WHERE no_kk = '$no_kk' AND status_hubungan = 'Kepala Keluarga'"; //get nik, no rekam medis, nama pasien 
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        $nik = $data['nik'];
        $no_rekam_medis = $data['no_rekam_medis'];
        $nama = $data['nama_depan'] . " " . $data['nama_belakang'];
        // validasi rekam medis
        if ($no_rekam_medis === NULL || $no_rekam_medis === "") {
            $no_rekam_medis = "00" . $no_indeks;
            $sql = "INSERT INTO rekam_medis (no_rekam_medis, nik) VALUES ('$no_rekam_medis', '$nik')";
            $result = $conn->query($sql);
            if ($result) {
                $petugas = $_SESSION['name'];
                if ($_SESSION['role'] === "rekmed") $bagian = "Rekam Medis";
                // script code send mail
                $title = "Nomor Berobat dan Kata Sandi Anda";
                $content = "Hai, <b>" . $nama . "</b><br><br><br>
                Terima kasih telah sabar menunggu.<br>Berikut adalah informasi akun Anda:<br><br>
                Nomor Berobat : <b>" . $no_indeks . "</b><br> Kata Sandi : <b>" . $password . " </b><br><br>
                Dengan masuk menggunakan akun di atas, Anda dapat melakukan pendaftaran rawat jalan secara online dan mengatur data anggota keluarga Anda.<br><br>
                Jangan khawatir jika Anda lupa dengan nomor berobat dan kata sandi Anda, Anda dapat meminta sistem untuk mengirimkannya melalui <i>email</i> yang Anda gunakan
                untuk mendaftar sebagai pasien baru di puskesmasalianyangpnk.my.id. 
                <br><br><br>
                Terima kasih.<br><br> Salam, <br>" . $petugas . ", Petugas " . $bagian . " <b>UPT Puskesmas Alianyang</b><br>
                Jalan Pangeran Natakusuma, Pontianak Kota<br><br><br><i>*pesan dikirim oleh sistem, harap TIDAK membalas.</i>";
                sendMail($email, $nama, $title, $content);
                $_SESSION['success_msg'] = "No indeks dan kata sandi berhasil disimpan dan dikirim ke pasien menggunakan email yang tertera";
                header("Location: detail-patient-medical-record.php?noKk=" . urlencode($enc_no_kk));
            }
        } else {
            $_SESSION['success_msg'] = "Data nomor kepala keluarga berhasil diperbarui";
            header("Location: detail-patient-medical-record.php?noKk=" . urlencode($enc_no_kk));
        }
    }
}

if (isset($_POST['edit_rekam_medis'])) {
    $no_rekam_medis = $_POST['no_rekam_medis'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $riwayat_alergi_obat = $_POST['riwayat_alergi_obat'];
    $sql = "UPDATE rekam_medis SET tanggal_masuk = '$tanggal_masuk', riwayat_alergi_obat = '$riwayat_alergi_obat' WHERE no_rekam_medis = '$no_rekam_medis'";
    $result = $conn->query($sql);
    $enc_no_rekmed = encrypt($no_rekam_medis);
    if ($result) {
        $_SESSION['success_msg'] = "Data nomor rekam medis berhasil diperbarui";
        header("Location: detail-patient-medical-record.php?noRekmed=" . urlencode($enc_no_rekmed));
    }
}

if (isset($_POST['edit_data_nik_rekmed'])) {
    $pasien = new Pasien;
    $pasien->set_daftar_data_identitas($_POST['no_kk'], $_POST['nik'], $_POST['nama_depan'], $_POST['nama_belakang'], $_POST['tempat_lahir'], $_POST['tanggal_lahir']);
    $no_kk = $pasien->get_no_kk();
    $nik = $pasien->get_nik();
    $nama_depan = $pasien->get_nama_depan();
    $nama_belakang = $pasien->get_nama_belakang();
    $tempat_lahir = $pasien->get_tempat_lahir();
    $tanggal_lahir = $pasien->get_tanggal_lahir();
    $pasien->set_daftar_data_sosial($_POST['jenis_kelamin'], $_POST['agama'], $_POST['pekerjaan']);
    $jenis_kelamin = $pasien->get_jenis_kelamin();
    $agama = $pasien->get_agama();
    $pekerjaan = $pasien->get_pekerjaan();
    $status_hubungan = $_POST['status_hubungan'];
    $status_pasien = $_POST['status_pasien'];
    $status_hubungan_prev = $_POST['status_hubungan_prev'];
    $no_rekmed_prev = $_POST['no_rek_med_prev'];

    if ($status_hubungan !== $status_hubungan_prev) {
        $kode_rekmed = array("Kepala Keluarga" => "00", "Istri" => "10", "Anak 1" => "01", "Anak 2" => "02", "Anak 3" => "03", "Anak 4" => "04", "Anak 5" => "05", "Anak 6" => "06", "Anak 7" => "07", "Anak 8" => "08", "Anak 9" => "09");
        foreach ($kode_rekmed as $key => $value) {
            if ($status_hubungan === $key) $set_status_hubungan = $value;
        }
        $no_rekmed = $set_status_hubungan;
        $no_rekmed .= substr($no_rekmed_prev, 2, 6);
        $sql = "SELECT * FROM rekam_medis WHERE no_rekam_medis = '$no_rekmed'"; // mencari data yang sudah ada
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['error_msg'] = "Status hubungan telah ada dalam data anggota keluarga pasien";
            $enc_nik = encrypt($nik);
            header("Location: edit-patient-medical-record.php?nik=" . urlencode($enc_nik));
        } else {
            $sql = "UPDATE rekam_medis SET no_rekam_medis = '$no_rekmed' WHERE no_rekam_medis = '$no_rekmed_prev'";
            $result = $conn->query($sql);
            $sql = "UPDATE pasien SET nik = '$nik', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
            jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = '$status_hubungan', status_pasien = '$status_pasien' WHERE nik = '$nik'";
            $result = $conn->query($sql);
            if ($result) {
                $_SESSION['success_msg'] = "Data Pasien berhasil diperbarui";
                $enc_no_kk = encrypt($no_kk);
                header("Location: detail-patient-medical-record.php?noKk=" . urlencode($enc_no_kk));
            }
        }
    } else {
        $sql = "UPDATE pasien SET nik = '$nik', nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
        jenis_kelamin = '$jenis_kelamin', agama = '$agama', pekerjaan = '$pekerjaan', status_hubungan = '$status_hubungan', status_pasien = '$status_pasien' WHERE nik = '$nik'";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION['success_msg'] = "Data Pasien berhasil diperbarui";
            $enc_no_kk = encrypt($no_kk);
            header("Location: detail-patient-medical-record.php?noKk=" . urlencode($enc_no_kk));
        }
    }
}
