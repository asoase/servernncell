<?php 

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Restsubmit extends REST_Controller
{
	
	function __construct()
	{
      // Construct the parent class
		parent::__construct();
		$this->load->model('Submitbarang', 'barang');
	}

	public function index_post()
	{

	}

	public function rekap1hari_post()
	{
		$datainput = $this->post('datainput');
      // var_dump($datainput);

		if($this->barang->posttodb($datainput) > 0){
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
