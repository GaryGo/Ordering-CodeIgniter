<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent :: __construct();
        $this->load->library('session');
        $this->load->model('user_model');
    }

	public function index() {
		$this->load->view('admin');
	}

	public function login() {
		$uemail = $this->input->post('uemail');
		$upw = $this->input->post('upw');
		if (!$uemail || !$upw) {
			$this->index();
		} else {
			$user = $this->user_model->getPwByEmailAdmin($uemail);
			if ($upw == $user['password']) {
				$session = array(
						'uname' => $user['username'],
						'uemail' => $user['email']
					);
				$this->session->set_userdata($session);
				$data['username'] = $user['username'];
				$this->load->view('templates/header', $data);
				$this->load->view('overview');
				$this->load->view('templates/footer');
			} else {
				$this->index();
			}
		}
		
	}


	public function loadPageByItem() {
		$value = $this->input->post('value');

		switch ($value) {
			case 2:
				$all_user = $this->user_model->showUserByPage(1);
				$data['all_user'] = $all_user;
				$data['page'] = 1;
				$page_num = ceil($this->db->count_all('user') / 10);
				$data['page_num'] = $page_num;
				$this->load->view('admin-user', $data);
				break;
			case 1:
				$this->load->view('overview');
				break;
			case 3:
				$this->load->model('order_model');
				$orders = $this->order_model->getAllOrder();
				$data['orders'] = $orders;
				$this->load->view('order-status', $data);
				break;
			case 4:
				$this->load->model('item_model');
				$items = $this->item_model->getAllItem();
				$data['items'] = $items;
				$this->load->view('place-order', $data);
				break;
			case 5:
				$this->load->view('report');
				break;
		}
	}

	public function loadPageUser() {
		$page = $this->input->post('page');
		$data['page'] = $page;
		$all_user = $this->user_model->showUserByPage($page);
		$data['all_user'] = $all_user;
		$page_num = ceil($this->db->count_all('user') / 10);
		$data['page_num'] = $page_num;
		$this->load->view('admin-user', $data);
	}

	public function updateUser() {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$pw = $this->input->post('pw');
		$user = array(
				'id' => $id,
				'name' => $name,
				'email' => $email,
				'pw' => $pw
			);
		$this->user_model->updateUser($user);
		// echo $res;
	}

	public function deleteUser() {
		$id = $this->input->post('id');
		$this->user_model->deleteUser($id);
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->index();
	}

	public function search() {
		$key = $this->input->post('key');
		$res = $this->user_model->search($key);
		
		$data['all_user'] = $res;
		$data['page_num'] = 0;
		$data['page'] = 0;
		$this->load->view('admin-user', $data);
	}

}
