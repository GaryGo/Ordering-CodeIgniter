<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {



	   public function __construct() {
        parent :: __construct();
        $this->load->model('order_model');
    }


    public function searchFieldDate() {
      $first_date = $this->input->post('first_date');

      $second_date = $this->input->post('second_date');
      $key = array(
            'first_date' => $first_date,
            'second_date' => $second_date
        );

      $orders = $this->order_model->searchWith($key, 1);
      // // // $data['orders'] = $orders;
      // // $data['orders'] = $orders;
      // $orders = FALSE;
      $data['orders'] = $orders;
      $this->load->view('order-status', $data);
    }

    public function searchFieldArea() {
      $city = $this->input->post('city');
      $state = $this->input->post('state');
      $key = array(
            'city' => $city,
            'state' => $state
        );
      $orders = $this->order_model->searchWith($key, 2);
      $data['orders'] = $orders;
      $this->load->view('order-status', $data);

    }

    public function searchFieldKey() {
      $field = $this->input->post('field');
      $keyword = $this->input->post('keyword');
      $key = array(
            'field' => $field,
            'keyword' => $keyword
        );
      $orders = $this->order_model->searchWith($key, 3);
      $data['orders'] = $orders;
      $this->load->view('order-status', $data);

    }

    public function searchFuzzy() {
      $key = $this->input->post('key');
      $orders = $this->order_model->searchWith($key, 4);
      $data['orders'] = $orders;
      $this->load->view('order-status', $data);
    }

}
