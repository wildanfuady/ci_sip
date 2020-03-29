<?php

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->cek_login();
    }

    public function index()
    {
        $data['categories'] = $this->category_model->get_all();
        $this->load->view('category/index', $data);
    }

    public function create()
    {
        $this->load->view('category/create');
    }

    public function store()
    {
        $name   = $this->input->post('category_name');
        $status = $this->input->post('category_status');

        // echo "Form data: {$name} {$status}";

        $data = [
            'category_name'     => $name,
            'category_status'   => $status
        ];

        // kirim data yang telah diinputkan dari form ke model
        $simpan = $this->category_model->simpan($data);

        // simpan ke database sukses
        if($simpan){
            redirect(base_url('category'));
        } else {
            echo "Gagal menyimpan data";
        }
    }

    public function edit($id)
    {
        $data['category'] = $this->category_model->get_by_id($id);
        $this->load->view('category/edit', $data);
    }

    public function update($id)
    {
        $name   = $this->input->post('category_name');
        $status = $this->input->post('category_status');

        // echo "Form data: {$name} {$status}";

        $data = [
            'category_name'     => $name,
            'category_status'   => $status
        ];

        // kirim data yang telah diinputkan dari form ke model
        $ubah = $this->category_model->update($data, $id);

        // simpan ke database sukses
        if($ubah){
            redirect(base_url('category'));
        } else {
            echo "Gagal mengubah data";
        }
    }

    public function delete($id)
    {
        $hapus = $this->category_model->delete($id);
        if($hapus){
            redirect(base_url('category'));
        } else {
            echo "Gagal menghapus data";
        }
    }

}