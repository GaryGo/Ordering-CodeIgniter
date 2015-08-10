<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->view('login');
	}

	public function login() {
		$uemail = $this->input->post('uemail');
		$upw = $this->input->post('upw');
		$user = $this->user_model->getPwByEmail($uemail);
		if ($upw == $user['pw']) {
			$session = array(
					'uname' => $user['name'],
					'uemail' => $user['email']
				);
			$this->session->set_userdata($session);
			$this->load->view('home');
		} else {
			$this->load->view('login');
		}
	}

}
