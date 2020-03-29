<?php

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->cek_login();
    }
    
    public function index()
    {
        $data['grafik'] = $this->dashboard_model->grafik();
        $data['latest_transactions'] = $this->dashboard_model->latest_transaction();
        $this->load->view('dashboard', $data);
    }

}