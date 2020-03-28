<?php

class Category_model extends CI_Model{

    public function get_all()
    {
        return $this->db->get("categories")->result_array();
        // get() = SELECT * FROM categories
        // result() = object = $data->category_name = mysqli_fetch_assoc
        // result_array() = array = $data['category_name'] = mysqli_fetch_array
    }

    public function simpan($data)
    {
        return $this->db->insert("categories", $data);
    }

    public function get_by_id($id)
    {
        // return $this->db->select('*')
        //                 ->from("categories")
        //                 ->where('category_id', $id)
        //                 ->get()
        //                 ->row_array();
        
        return $this->db->get_where("categories", ['category_id' =>  $id])->row_array();
        // row() = $category->category_name
        // row_array() = $category['category_name']
    }

    public function update($data, $id)
    {
        return $this->db->where('category_id', $id)
                        ->update('categories', $data);
    }

    public function delete($id)
    {
        return $this->db->where('category_id', $id)
                        ->delete('categories');
    }

}