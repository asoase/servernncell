<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Datarekap extends REST_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('AllData_model', 'alldata');
	}

	public function index_get()
	{
		$tanggal = $this->get('tanggal');

		$returndata = $this->alldata->getalldata($tanggal);

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

	public function index_post()
	{
		$datainput = $this->post('datainput');

		if($this->alldata->submitalldata($datainput) > 0){
			$this->response([
				'status' => true,
				'message' => 'data baru has been created.'
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => false,
				'message' => 'failed to create new data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

}
