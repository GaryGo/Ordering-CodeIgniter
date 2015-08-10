<?php
    class Item_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            $this->load ->database();
    
        }

        public function addItem($item) {
            $this->db->insert('item', $item);
        }

        public function getAllItem() {
        	// $this->db->select('*');
        	// $query = $this->db->get('item');
        	$query = $this->db->query("select * from item order by stock_number");
        	if ($query->num_rows() > 0) {
        		return $query->result_array();
        	} else  {
        		return FALSE;
        	}
        }


        public function search($key) {
            $this->db->select("*");
            $this->db->like('stock_number', $key);
            $this->db->or_like('description', $key);
            $query = $this->db->get('item');
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return FALSE;
            }
        }
        

    }
?>