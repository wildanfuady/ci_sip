<?php

class Transaction_model extends CI_Model{

    public function get_all()
    {
        return $this->db->select("transactions.*, products.product_name")
                        ->from("transactions")
                        ->join("products", "products.product_id = transactions.product_id")
                        ->get()
                        ->result_array();
    }
    
    public function insert($data){
        return $this->db->insert($data);

    }
}