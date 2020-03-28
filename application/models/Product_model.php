<?php

class Product_model extends CI_Model{

    public function num_rows($category, $keyword)
    {
        $this->db->select("categories.category_name, products.*");
        $this->db->from("products");
        $this->db->join("categories", "products.category_id = categories.category_id");
        
        if(!empty($category)){
            $this->db->where('products.category_id', $category);
        }
        if(!empty($keyword)){
            $this->db->like('products.product_name', $keyword);
            $this->db->or_like('products.product_sku', $keyword);
            $this->db->or_like('products.product_description', $keyword);
        }

        return $this->db->get()->num_rows();
    }

    public function paginate($per_page, $page, $category, $keyword)
    {
        $this->db->select("categories.category_name, products.*");
        $this->db->from("products");
        $this->db->join("categories", "products.category_id = categories.category_id");
        $this->db->limit($per_page, $page);

        if(!empty($category)){
            $this->db->where('products.category_id', $category);
        }
        if(!empty($keyword)){
            $this->db->like('products.product_name', $keyword);
            $this->db->or_like('products.product_sku', $keyword);
            $this->db->or_like('products.product_description', $keyword);
        }
        return $this->db->get()->result_array();
    }

    public function get_all()
    {
        return $this->db->select("categories.category_name, products.*")
                        ->from("products")
                        ->join("categories", "products.category_id = categories.category_id")
                        ->get()
                        ->result_array();
    }

    public function simpan($data)
    {
        return $this->db->insert("products", $data);
    }

    public function get_by_id($id)
    {
        // SELECT * FROM products WHERE product_id='$id' AND category_id='2'
        // row_array() = $data['category_id']
        // row() = $data->category_id
        return $this->db->get_where("products", ['product_id' =>  $id])->row_array();
    }

    public function update($data, $id)
    {
        return $this->db->where('product_id', $id)
                        ->update('products', $data);
    }

    public function delete($id)
    {
        return $this->db->where('product_id', $id)
                        ->delete('products');
    }

    public function getPrice($id)
    {
        return $this->db->get_where("products", ['product_id' => $id])->row_array();
    }

}