<?php

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function proses_login()
    {
        $email  = $this->input->post('email');
        $pass   = $this->input->post('password');

        $cek_login = $this->auth_model->cek_login($email);

        // email didapatkan
        if($cek_login == TRUE){

            // jika email dan password cocok
            if(password_verify($pass, $cek_login['password'])){

                $this->session->set_userdata('email', $cek_login['email']);
                $this->session->set_userdata('name', $cek_login['name']);
                $this->session->set_userdata('level', $cek_login['level']);
                $this->session->set_userdata('status', $cek_login['status']);
                
                redirect(base_url('dashboard'));          
            // email cocok, tapi password salah
            } else {
                $this->session->set_flashdata('inputs', $this->input->post());
                $this->session->set_flashdata('errors', ['' => 'Password yang Anda masukan salah']);
                redirect(base_url('auth/login'));
            }
        } else {
            $this->session->set_flashdata('inputs', $this->input->post());
            $this->session->set_flashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
            redirect(base_url('auth/login'));
        }
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function proses_register()
    {
        $email      = $this->input->post('email');
        $username   = $this->input->post('username');
        $name       = $this->input->post('name');
        $pass       = $this->input->post('password');
        $conf       = $this->input->post('conf_password');
        $status     = "Active";
        $level      = "Admin";

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|is_unique[users.username]');
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('conf_password', 'Confirmation Password', 'required|matches[password]');

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('inputs', $this->input->post());
            $this->session->set_flashdata('errors', $this->form_validation->error_array());
            redirect(base_url('auth/register'));
        } else {

            $data = [
                'email'         => $email,
                'name'          => $name,
                'username'      => $username,
                'password'      => password_hash($pass, PASSWORD_DEFAULT),
                'status'        => $status,
                'level'         => $level
            ];

            $simpan = $this->auth_model->register($data);
            if($simpan){
                $this->session->set_flashdata('success', 'Register Successfully');
                redirect(base_url('auth/login'));
            }

        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}