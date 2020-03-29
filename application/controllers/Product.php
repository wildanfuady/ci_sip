<?php

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('session');
        $this->load->helper('form');
        $this->cek_login();
    }

    public function index()
    {
        $data['category'] = $this->input->get('category');
        $data['keyword'] = $this->input->get('keyword');

        $cat = $data['category'];
        $key = $data['keyword'];

        $this->load->library('pagination');
        // tentukan jumlah data yang mau ditampilkan
        $per_page = 3;
        // set konfirgurasi
        $config['base_url']             = base_url()."product/index/";
        $config['total_rows']           = $this->product_model->num_rows($cat, $key);
        $config['per_page']             = $per_page;
        // set pagination with bootstrap
        $config["uri_segment"]      = 3; 
        $config['first_link']       = 'First'; 
        $config['last_link']        = 'Last'; 
        $config['next_link']        = 'Next'; 
        $config['prev_link']        = 'Prev'; 
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">'; 
        $config['full_tag_close']   = '</ul></nav></div>'; 
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">'; 
        $config['num_tag_close']    = '</span></li>'; 
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">'; 
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>'; 
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">'; 
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>'; 
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">'; 
        $config['prev_tagl_close']  = '</span>Next</li>'; 
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">'; 
        $config['first_tagl_close'] = '</span></li>'; 
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">'; 
        $config['last_tagl_close']  = '</span></li>'; 
        $config['reuse_query_string']  = TRUE;

        $this->pagination->initialize($config);

        if($this->uri->segment(3)){
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }

        $data['nomor'] = $page;
        $categories = $this->category_model->get_all();
        $data['set_category'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');
        
        $data['products'] = $this->product_model->paginate($per_page, $page, $cat, $key);

        $this->load->view('product/index', $data);
    }

    public function create()
    {
        $categories = $this->category_model->get_all();
        $data['set_category'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');
        $this->load->view('product/create', $data);
    }

    public function store()
    {
        $category_id        = $this->input->post('category_id');
        $name               = $this->input->post('product_name');
        $price              = $this->input->post('product_price');
        $sku                = $this->input->post('product_sku');
        $status             = $this->input->post('product_status');
        $description        = $this->input->post('product_description');

        // panggil library validation
        $this->load->library('form_validation');
        // set rulesnya
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('product_name', 'Name', 'required|max_length[100]');
        $this->form_validation->set_rules('product_price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('product_sku', 'SKU', 'required|max_length[100]');
        $this->form_validation->set_rules('product_status', 'Status', 'required');
        $this->form_validation->set_rules('product_description', 'Description', 'required');

        // cek apakah terjadi validasi atau tidak
        if($this->form_validation->run() == FALSE){
            // tampung data error dari validasi
            $errors = $this->form_validation->error_array();
            // set data error ke flash data
            $this->session->set_flashdata('errors', $errors);
            // kembalikan data input ke asalnya
            $this->session->set_flashdata('inputs', $this->input->post());
            redirect(base_url('product/create'));
        }

        // jika berhasil melewati validasi
        $config['upload_path']      = "./uploads/"; // path
        $config['allowed_types']    = "jpg|png|gif|jpeg"; // yang diijinkan
        $config['max_size']         = "1000";
        $config['max_width']        = "1000";
        $config['max_height']       = "1000";
    
        // panggil library upload
        $this->load->library('upload', $config);
        // inisialisasi hasil konfigurasi ke library upload
        $this->upload->initialize($config);
        // cek apakah ada upload atau tidak
        if(!$this->upload->do_upload('product_image')){
            $error_upload = "Gambar gagal diupload";
            echo $error_upload;
        } else {
            // ambil file gambar berdasarkan nama filenya
            $image = $this->upload->data('file_name');
            // buat variabel data untuk menampung array
            $data = [
                'category_id'           => $category_id,
                'product_name'          => $name,
                'product_price'         => $price,
                'product_sku'           => $sku,
                'product_status'        => $status,
                'product_description'   => $description,
                'product_image'         => $image,
            ];
            // simpan ke database
            $simpan = $this->product_model->simpan($data);
            // jika simpan berhasil
            if($simpan){
                $this->session->set_flashdata('success', 'Berhasil menyimpan data');
                redirect(base_url('product'));
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data');
                redirect(base_url('product'));
            }
        }
    } 

    public function show($id)
    {
        $categories = $this->category_model->get_all();
        $data['set_category'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');
        $data['product'] = $this->product_model->get_by_id($id);
        $this->load->view('product/show', $data);
    }
    
    public function edit($id)
    {
        $categories = $this->category_model->get_all();
        $data['set_category'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');
        $data['product'] = $this->product_model->get_by_id($id);
        $this->load->view('product/edit', $data);
    }

    public function update($id)
    {
        $category_id        = $this->input->post('category_id');
        $name               = $this->input->post('product_name');
        $price              = $this->input->post('product_price');
        $sku                = $this->input->post('product_sku');
        $status             = $this->input->post('product_status');
        $description        = $this->input->post('product_description');

        // panggil library validation
        $this->load->library('form_validation');
        // set rulesnya
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('product_name', 'Name', 'required|max_length[100]');
        $this->form_validation->set_rules('product_price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('product_sku', 'SKU', 'required|max_length[100]');
        $this->form_validation->set_rules('product_status', 'Status', 'required');
        $this->form_validation->set_rules('product_description', 'Description', 'required');

        // cek apakah terjadi validasi atau tidak
        if($this->form_validation->run() == FALSE){
            // tampung data error dari validasi
            $errors = $this->form_validation->error_array();
            // set data error ke flash data
            $this->session->set_flashdata('errors', $errors);
            // kembalikan data input ke asalnya
            $this->session->set_flashdata('inputs', $this->input->post());
            redirect(base_url('product/create'));
        }

        // jika berhasil melewati validasi
        $config['upload_path']      = "./uploads/"; // path
        $config['allowed_types']    = "jpg|png|gif|jpeg"; // yang diijinkan
        $config['max_size']         = "1000";
        $config['max_width']        = "1000";
        $config['max_height']       = "1000";
    
        // panggil library upload
        $this->load->library('upload', $config);
        // inisialisasi hasil konfigurasi ke library upload
        $this->upload->initialize($config);
        // cek apakah ada upload atau tidak
        if(!$this->upload->do_upload('product_image')){
            $error_upload = "Gambar gagal diupload";
            echo $error_upload;
        } else {
            // ambil file gambar berdasarkan nama filenya
            $image = $this->upload->data('file_name');
            // buat variabel data untuk menampung array
            $data = [
                'category_id'           => $category_id,
                'product_name'          => $name,
                'product_price'         => $price,
                'product_sku'           => $sku,
                'product_status'        => $status,
                'product_description'   => $description,
                'product_image'         => $image,
            ];
            // update ke database
            $ubah = $this->product_model->update($data, $id);
            // jika update berhasil
            if($ubah){
                $this->session->set_flashdata('info', 'Berhasil mengubah data');
                redirect(base_url('product'));
            } else {
                $this->session->set_flashdata('error', 'Gagal mengubah data');
                redirect(base_url('product'));
            }
        }
    } 

    public function delete($id)
    {
        $product = $this->product_model->delete($id);
        if($product){
            $this->session->set_flashdata('warning', 'Berhasil menghapus data');
            redirect(base_url('product'));
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data');
            redirect(base_url('product'));
        }
    }
}