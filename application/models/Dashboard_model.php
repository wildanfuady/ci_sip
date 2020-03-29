<?php

class Dashboard_model extends CI_Model{

    public function grafik()
    {
        // data total jumlah produk yang terjual beserta bulannya
        // produk a bulan januari laku 13 pcs
        $query = $this->db->query("SELECT trx_price, MONTHNAME(trx_date) as month, SUM(product_id) as total FROM transactions GROUP BY MONTHNAME(trx_date) ORDER BY MONTH(trx_date)");
        if($query->num_rows() > 0){
            foreach($query->result_array() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function latest_transaction()
    {
        return $this->db->select("transactions.*, products.product_name")
                        ->from("transactions")
                        ->join("products", "products.product_id = transactions.product_id")
                        ->limit(5)
                        ->order_by('trx_id', 'DESC')
                        ->get()
                        ->result_array();
    }
}