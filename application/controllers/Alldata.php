<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Alldata extends REST_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('AllData_model', 'alldata');
	}

	// hpin untuk mengubah hp masuk hpin
	public function hpin_get()
	{
		$id = $this->get('id');

		$returndata = $this->alldata->gethpin($id);

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

	// hpin untuk mengubah hp masuk hpin
	public function hpout_get()
	{
		$id = $this->get('id');

		$returndata = $this->alldata->gethpout($id);

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

		// hpin untuk mengubah hp masuk hpin
	public function servin_get()
	{
		$id = $this->get('id');

		$returndata = $this->alldata->getservin($id);

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

		// hpin untuk mengubah hp masuk hpin
	public function servout_get()
	{
		$id = $this->get('id');

		$returndata = $this->alldata->getservout($id);

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

		// hpin untuk mengubah hp masuk hpin
	public function acc_get()
	{
		$id = $this->get('id');

		$returndata = $this->alldata->getacc($id);

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
