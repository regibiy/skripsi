<?php
class Pasien
{
    // properties
    private $no_berobat;
    private $nama;
    private $password;
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
}
