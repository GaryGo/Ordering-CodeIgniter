<?php
    class Order_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            $this->load ->database();
    
        }

        public function addOrder($order) {
            $this->db->insert('order', $order);
        }

        public function getAllOrder() {
        	// $this->db->select('*');
        	// $query = $this->db->get('item');
        	$query = $this->db->query("select * from orders order by orderdate desc");
        	if ($query->num_rows() > 0) {
        		return $query->result_array();
        	} else  {
        		return FALSE;
        	}
        }


        public function searchWith($key, $value) {
            switch($value) {
                case 1:
                    // $this->db->select('*');
                    // $this->db->where('date(orderdate) >= ', $key['first_date']);
                    // $this->db->where('date(orderdate) <= ', $key['second_date']);
                    // $query = $this->db->get('order');
                    $query = $this->db->query("SELECT * FROM `orders` WHERE orderdate >= '" . $key['first_date'] . "' AND orderdate <= '" . $key['second_date'] . "';");
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    } else {
                        return FALSE;
                    }
                    break;
                case 2:
                    $this->db->select("*");
                    $this->db->like('city', $key['city']);
                    $this->db->or_like('state', $key['state']);
                    $query = $this->db->get('orders');
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    } else {
                        return FALSE;
                    }
                    break;
                case 3:
                    // $query = $this->db->query("select * from `orders` where " . $key['field'] . " = ");
                    $this->db->select("*");
                    $this->db->like($key['field'], $key['keyword']);
                    $query = $this->db->get('orders');
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    } else {
                        return FALSE;
                    }
                    break;
                case 4:
                    $this->db->select("*");
                    $this->db->like('orderid', $key);
                    $this->db->or_like('controlnumber', $key);
                    $this->db->or_like('login', $key);
                    $this->db->or_like('upsreffield', $key);
                    $this->db->or_like('shipto', $key);
                    $this->db->or_like('city', $key);
                    $this->db->or_like('state', $key);
                    $this->db->or_like('zip', $key);
                    $this->db->or_like('shipmethod', $key);
                    $query = $this->db->get('orders');
                    if ($query->num_rows() > 0) {
                        return $query->result_array();
                    } else {
                        return FALSE;
                    }
                    break;
            }
        }
        

    }
?>