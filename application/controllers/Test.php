<?php

class Test extends CI_Controller {

    public function index()
    {
        $this->load->view('test/test');
    }

    public function hello()
    {
        echo "Selamat datang di Codigniter";
    }

}
// localhost/sip_71/index.php/nama_controller/nama_function (pkai huruf kecil semua)
// localhost/sip_71/test (pkai huruf kecil semua)
// penamaan class harus diawali dengan huruf besar
// tidak boleh didahului angka
// tidak boleh pakai spasi
// boleh pakai _