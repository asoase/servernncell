<?php 

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Hpin extends REST_Controller
{
	function __construct()
  {
        // Construct the parent class
    parent::__construct();
    $this->load->model('Barang_model', 'barang');
  }

  public function index_get()
  {
    $tanggal = $this->get('tanggal');

    if($tanggal === NULL){
      $hpin = $this->barang->getHp();
    } else {
      $hpin = $this->barang->getHp($tanggal);
    }

    if($hpin){
      $this->response([
        'status' => true,
        'data' => $hpin
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
    $data = [
      'tanggal' => $this->post('tanggal'),
      'merk' => $this->post('merk'),
      'tipe' => $this->post('tipe'),
      'imei' => $this->post('imei'),
      'harga' => $this->post('harga'),
      'kerusakan' => $this->post('kerusakan'),
      'kelengkapan' => $this->post('kelengkapan'),
      'sales' => $this->post('sales')
    ];

    if($this->barang->createHp($data) > 0){
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

  public function index_delete()
  {
    $id = $this->delete('id');

    if($id === null){
      $this->response([
        'status' => false,
        'message' => 'provide an id'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else 
    {
      if($this->barang->deleteHp($id))
      {
        $this->set_response([
          'status' => true,
          'id' => $id,
          'message' => 'deleted'
        ], REST_Controller::HTTP_OK);
      } else
      {
        $this->response([
          'status' => false,
          'message' => 'id not found'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }

  public function index_put()
  {
    $id = $this->put('id');
    $data = [
      'tanggal' => $this->put('tanggal'),
      'merk' => $this->put('merk'),
      'tipe' => $this->put('tipe'),
      'imei' => $this->put('imei'),
      'harga' => $this->put('harga'),
      'kerusakan' => $this->put('kerusakan'),
      'kelengkapan' => $this->put('kelengkapan'),
      'sales' => $this->put('sales')
    ];

    if($this->barang->updateHp($id, $data) > 0){
      $this->response([
        'status' => true,
        'message' => 'mahasiswa has been updated.'
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => false,
        'message' => 'failed to update data atau data sama'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}



?>