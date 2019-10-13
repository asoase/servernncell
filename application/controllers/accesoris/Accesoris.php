<?php 

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Accesoris extends REST_Controller
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
          $accesoris = $this->barang->getAccesoris();
      } else {
          $accesoris = $this->barang->getAccesoris($tanggal);
      }

      if($accesoris){
          $this->response([
              'status' => true,
              'data' => $accesoris
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
          'nama' => $this->post('nama'),
          'harga' => $this->post('harga')
      ];

      if($this->barang->createAccesoris($data) > 0){
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
          if($this->barang->deleteAccesoris($id))
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
          'nama' => $this->put('nama'),
          'harga' => $this->put('harga')
      ];

      if($this->barang->updateAccesoris($id, $data) > 0){
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