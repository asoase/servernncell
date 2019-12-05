<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Servisreturn extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksiadmin/Servisreturnmodel', 'servisreturnmodel');
  }
  public function item_get()
  {
    $id         = $this->get('id');
    $returndata = $this->servisreturnmodel->getdata($id);
    if ($returndata) {
      $this->response([
        'status' => true,
        'data'   => $returndata,
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status'  => false,
        'message' => 'id not found',
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
  public function item_put()
  {
    $id      = $this->put('id');
    $data    = $this->put('dataput');
    $result  = $this->servisreturnmodel->putdata($id, $data);
    $status  = false;
    $message = 'data tidak di update /  data yang di kirim sama';
    if ($result == 1) {
      $status  = true;
      $message = 'data sukses di update';
    }
    $this->response([
      'status'  => $status,
      'message' => $message,
    ], REST_Controller::HTTP_OK);
  }
}
