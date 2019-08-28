<?php
class Category_model extends CI_Model
{
    /*Insert*/
  

  
	
	public function getAllCategories()
    {
		$this->db->select("c.id,c.name");
        $this->db->from('categories as c');
        $query = $this->db->get();
        $categorytData = $query->result_array();       
		return $categorytData;

    }

}
