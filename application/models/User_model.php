<?php
    class User_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            $this -> load -> database();
    
        }

        public function getPwByEmail($uemail) {
            $this->db->where('email', $uemail);
            $this->db->select("*");
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return FALSE;
            }
        }

        public function getPwByEmailAdmin($uemail) {
            $this->db->where('email', $uemail);
            $this->db->select("*");
            $query = $this->db->get('admin');
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return FALSE;
            }
        }

        public function showAllUser() {
            $query = $this->db->query("select * from user");
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return FALSE;
            }
        }

        public function showUserByPage($page) {
            $query = $this->db->get('user', 10, ($page-1) * 10);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return FALSE;
            }
        }

        public function updateUser($user) {
            $this->db->where('id', $user['id']);
            $this->db->update('user', $user);
           // $this->db->query("update user set pw = " . $user['pw'] . " where id = " . $user['id'] . ";");
            // return $user['pw'];
            // $this->db->query("update user set pw = 444 where id = 1;");
        }

        public function deleteUser($id) {
            $this->db->delete('user', array('id' => $id)); 
        }

        public function search($key) {
            $this->db->select("*");
            $this->db->like('email', $key);
            $this->db->or_like('name', $key);
            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return FALSE;
            }
        }

    }
?>