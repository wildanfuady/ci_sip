<?php

class Auth_model extends CI_Model{

    public function cek_login($email)
    {
        $query = $this->db->where('email', $email)->limit(1)->get('users');
        if($query->num_rows() > 0){ // 1
            $hasil = $query->row_array();
            // ['nama' => 'ababa']
        } else {
            $hasil = array(); // 0 / false
        }
        return $hasil;
    }

    public function register($data)
    {
        return $this->db->insert("users", $data);
    }
}