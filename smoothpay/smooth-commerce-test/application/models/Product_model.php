<?php
class Product_model extends CI_Model
{
    /*Insert*/
  

  
	
	public function getAllProducts()
    {
        $this->db->select("p.id,p.name,p.category,p.sku,p.created_at,p.updated_at");
        $this->db->from('products as p');
        $query = $this->db->get();
        $productData = $query->result_array();
   		return $productData;

	}
	
	public function getProductById($productId)
    {
        $this->db->select("p.id,p.name,p.category,p.sku,p.created_at,p.updated_at");
        $this->db->from('products as p');
        $this->db->where('p.id', $productId);
        $query = $this->db->get();
        $userData = $query->row_array();     
        return $userData;
    }

	public function saverecords($productdata)
    {
        $this->db->insert('products', $productdata);
        $product_insert_id = $this->db->insert_id();
        if ($product_insert_id > 0) {
                return $product_insert_id;
        } else {
            return 0;
        }
	}
	
	public function deleteRecord($table, $id, $field_name)
    {
        $this->db->select("count(*) as count");
        $this->db->from($table);
        $this->db->where($field_name, $id);
        $query = $this->db->get();
        $data = $query->row_array();
        if ($data['count'] > 0) {
            $this->db->where($field_name, $id);
            $this->db->delete($table);
            return $this->db->affected_rows();
        } else {
            return 2;
        }

	}

}
