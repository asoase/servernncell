<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Accesoris extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('transaksiadmin/Accesorismodel', 'accesorismodel');
	}
	public function item_get(){
		$id = $this->get('id');
		$returndata = $this->accesorismodel->getdata($id);
		if($returndata){
			$this->response([
				'status' => true,
				'data' => $returndata
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'id not found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}