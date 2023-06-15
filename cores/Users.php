<?php
class Pasien
{
    // properties
    private $no_berobat, $no_kk, $nik, $nama_depan, $nama_belakang, $tempat_lahir, $tanggal_lahir,
        $jenis_kelamin, $agama, $pekerjaan, $no_hp, $email, $alamat, $rt, $rw, $kel_desa, $kecamatan, $ktp_kk, $kk, $password;
    // method
    function set_login_data($no_berobat, $password)
    {
        $this->no_berobat = $no_berobat;
        $this->password = $password;
    }
    function get_no_berobat()
    {
        return $this->no_berobat;
    }
    function get_password()
    {
        return $this->password;
    }

    function set_daftar_data_identitas($no_kk, $nik, $nama_depan, $nama_belakang, $tempat_lahir, $tanggal_lahir)
    {
        $this->no_kk = $no_kk;
        $this->nik = $nik;
        $this->nama_depan = $nama_depan;
        $this->nama_belakang = $nama_belakang;
        $this->tempat_lahir = $tempat_lahir;
        $this->tanggal_lahir = $tanggal_lahir;
    }
    function get_no_kk()
    {
        return $this->no_kk;
    }
    function get_nik()
    {
        return $this->nik;
    }
    function get_nama_depan()
    {
        return $this->nama_depan;
    }
    function get_nama_belakang()
    {
        return $this->nama_belakang;
    }
    function get_tempat_lahir()
    {
        return $this->tempat_lahir;
    }
    function get_tanggal_lahir()
    {
        return $this->tanggal_lahir;
    }

    function set_daftar_data_sosial($jenis_kelamin, $agama, $pekerjaan)
    {
        $this->jenis_kelamin = $jenis_kelamin;
        $this->agama = $agama;
        $this->pekerjaan = $pekerjaan;
    }
    function get_jenis_kelamin()
    {
        return $this->jenis_kelamin;
    }
    function get_agama()
    {
        return $this->agama;
    }
    function get_pekerjaan()
    {
        return $this->pekerjaan;
    }

    function set_daftar_data_kontak($no_hp, $email)
    {
        $this->no_hp = $no_hp;
        $this->email = $email;
    }
    function get_no_hp()
    {
        return $this->no_hp;
    }
    function get_email()
    {
        return $this->email;
    }

    function set_daftar_data_domisili($alamat, $rt, $rw, $kel_desa, $kecamatan)
    {
        $this->alamat = $alamat;
        $this->rt = $rt;
        $this->rw = $rw;
        $this->kel_desa = $kel_desa;
        $this->kecamatan = $kecamatan;
    }
    function get_alamat()
    {
        return $this->alamat;
    }
    function get_rt()
    {
        return $this->rt;
    }
    function get_rw()
    {
        return $this->rw;
    }
    function get_kel_desa()
    {
        return $this->kel_desa;
    }
    function get_kecamatan()
    {
        return $this->kecamatan;
    }

    function set_data_pendukung($ktp_kk, $kk)
    {
        $this->ktp_kk = $ktp_kk;
        $this->kk = $kk;
    }
    function get_ktp_kk()
    {
        return $this->ktp_kk;
    }
    function get_kk()
    {
        return $this->kk;
    }
}

class Petugas
{
    protected $username, $password;

    function set_login_data($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    function get_username()
    {
        return $this->username;
    }
    function get_password()
    {
        return $this->password;
    }
}

class Data_Petugas extends Petugas
{
    private $nama_depan, $nama_belakang, $role, $status;

    function set_manage_data_officer($nama_depan, $nama_belakang, $role, $status)
    {
        $this->nama_depan = $nama_depan;
        $this->nama_belakang = $nama_belakang;
        $this->role = $role;
        $this->status = $status;
    }
    function get_nama_depan()
    {
        return $this->nama_depan;
    }
    function get_nama_belakang()
    {
        return $this->nama_belakang;
    }
    function get_role()
    {
        return $this->role;
    }
    function get_status()
    {
        return $this->status;
    }
}

class Ruang_Poli
{
    private $nama_ruang, $status_ruang;

    function set_data_ruang($nama_ruang, $status_ruang)
    {
        $this->nama_ruang = $nama_ruang;
        $this->status_ruang = $status_ruang;
    }

    function get_nama_ruang()
    {
        return $this->nama_ruang;
    }
    function get_status_ruang()
    {
        return $this->status_ruang;
    }
}
