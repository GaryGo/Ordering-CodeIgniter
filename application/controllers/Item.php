<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {



	public function __construct() {
        parent :: __construct();
        $this->load->model('item_model');
    }

    function uploadItemImg() {
    	$config['upload_path'] = './static/images/item-images/';
    	$config['allowed_types'] = 'gif|jpg|png';
  		$config['max_size'] = '10240';
  		$config['max_width']  = '1024';
  		$config['max_height']  = '768';
  		$config['file_name'] = 'tmp.jpg';
  		$this->load->library('upload', $config);

  		if (!$this->upload->do_upload()) {
  			echo $this->upload->display_errors();
  		} else {
  			echo "success";
  			// do nothing
  		}
    }

    function addNewItem() {
    	$sn = $this->input->post('sn');
    	$description = $this->input->post('description');
    	$aqty = $this->input->post('aqty');
    	$bqty = $this->input->post('bqty');
    	$item = array(
    			'stock_number' => $sn,
    			'description' => $description,
    			'avail_qty' => $aqty,
    			'backorder_qty' => $bqty
    		);
    	$this->item_model->addItem($item);
    }

    function renameImg() {
      $sn = $this->input->post('sn');
      $dir = FCPATH . "static/images/item-images/";
      rename($dir."tmp.jpg", $dir.$sn.".jpg");
      echo "success change name";
    }

    function addChangeItemImg() {
        $sn = $this->input->post('sn');
        $old_img = FCPATH . "static/images/item-images/" . $sn . ".jpg";
        if (file_exists ($old_img)) {
            unlink($old_img);
        }

        $config['upload_path'] = './static/images/item-images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10240';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] = $sn . '.jpg';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
          echo $this->upload->display_errors();
        } else {
          echo "success";
          // do nothing
        }
    }

    public function search() {
      $key = $this->input->post('key');
      $res = $this->item_model->search($key);
      
      $data['items'] = $res;
      $data['page_num'] = 0;
      $data['page'] = 0;
      $this->load->view('place-order', $data);
    }



}
