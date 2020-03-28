<?php

class Transaction extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data['trx'] = $this->transaction_model->get_all();
        $this->load->view('transaction/index', $data);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->view('transaction/create');
    }

    public function import()
    {
        $config['upload_path']      = "./uploads/"; // path
        $config['allowed_types']    = "xlsx|xls"; // yang diijinkan
        $config['max_size']         = "1000";
    
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('trx_file')){
            $errors = $this->upload->display_errors();
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url('transaction/create'));
        } else {

            // mengambil data berdasarkan tempat target upload
            // contoh: D:/folder/nama_file.xlsx
            $excel = $this->upload->data('full_path'); // tipenya string ini
            // ubah string jadi array
            // yang dipisah nama file dengan nama extensionnya
            // contoh: datasiswa.xlsx
            $arr_file = explode(".", $excel); // sekarang jadi dua, yaitu nama file dan extensionnya
            // contoh:
            // tadinya datasiswa.xlsx
            // jadi:
            // 1. datasiswa (start)
            // 2. xlsx (end)
            // ambil yang extension
            $ext = end($arr_file); // xls atau xlxs

            if($ext == "xls"){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $sheet = $reader->load($excel);
            $data = $sheet->getActiveSheet()->toArray();
            
            foreach($data as $idx => $row){
                
                // ngelewatin judul
                if($idx == 0) {
                    continue;
                }

                $product_id     = $row[0];
                $trx_date       = $row[1];
                $trx_price      = $this->getTrxPrice($row[0]);

                $data = [
                    "product_id"    => $product_id,
                    "trx_date"      => date('Y-m-d', strtotime($trx_date)),
                    "trx_price"     => $trx_price
                ];

                $simpan = $this->db->insert("transactions", $data);
            }

            if($simpan) {
                echo "Berhasil import data";
            }
        }
    }

    public function getTrxPrice($product_id)
    {
        $this->load->model('product_model');
        $price = $this->product_model->getPrice($product_id);
        $data = $price['product_price'];
        return $data;
    }
}