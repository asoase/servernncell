<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Hpin extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksiadmin/Hpinmodel', 'hpinmodel');
  }
  public function item_get()
  {
    $id         = $this->get('id');
    $returndata = $this->hpinmodel->getdata($id);
    if (!is_null($returndata)) {
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
    $id     = $this->put('id');
    $data   = $this->put('dataput');
    $result = $this->hpinmodel->putdata($id, $data);
    switch ($result) {
      case REST_Controller::HTTP_OK:
        $status     = true;
        $message    = 'data sukses diupdate';
        $statuscode = REST_Controller::HTTP_OK;
        break;
      case REST_Controller::HTTP_NO_CONTENT:
        $status     = false;
        $message    = 'data gagal diupdate / data sama';
        $statuscode = REST_Controller::HTTP_NO_CONTENT;
        break;
      default:
        $status     = false;
        $message    = 'data tidak ada';
        $statuscode = REST_Controller::HTTP_NOT_FOUND;
        break;
    }
    $this->response([
      'status'  => $status,
      'message' => $message,
    ], $statuscode);
  }
  public function item_delete()
  {
    $id     = $this->delete('id');
    $result = $this->hpinmodel->deletedata($id);
    switch ($result) {
      case REST_Controller::HTTP_OK:
        $status     = true;
        $message    = 'data sukses dihapus';
        $statuscode = REST_Controller::HTTP_OK;
        break;
      case REST_Controller::HTTP_NO_CONTENT:
        $status     = false;
        $message    = 'data gagal dihapus';
        $statuscode = REST_Controller::HTTP_NO_CONTENT;
        break;
      default:
        $status     = false;
        $message    = 'data tidak ada';
        $statuscode = REST_Controller::HTTP_NOT_FOUND;
        break;
    }
    $this->response([
      'status'  => $status,
      'message' => $message,
    ], $statuscode);
  }
  public function alternateput_post()
  {
    $id     = $this->post('id');
    $data   = $this->post('dataput');
    $result = $this->hpinmodel->putdata($id, $data);
    switch ($result) {
      case REST_Controller::HTTP_OK:
        $status     = true;
        $message    = 'data sukses diupdate';
        $statuscode = REST_Controller::HTTP_OK;
        break;
      case REST_Controller::HTTP_NO_CONTENT:
        $status     = false;
        $message    = 'data gagal diupdate / data sama';
        $statuscode = REST_Controller::HTTP_NO_CONTENT;
        break;
      default:
        $status     = false;
        $message    = 'data tidak ada';
        $statuscode = REST_Controller::HTTP_NOT_FOUND;
        break;
    }
    $this->response([
      'status'  => $status,
      'message' => $message,
    ], $statuscode);
  }
  public function alternatedelete_post()
  {
    $id     = $this->post('id');
    $result = $this->hpinmodel->deletedata($id);
    switch ($result) {
      case REST_Controller::HTTP_OK:
        $status     = true;
        $message    = 'data sukses dihapus';
        $statuscode = REST_Controller::HTTP_OK;
        break;
      case REST_Controller::HTTP_NO_CONTENT:
        $status     = false;
        $message    = 'data gagal dihapus';
        $statuscode = REST_Controller::HTTP_NO_CONTENT;
        break;
      default:
        $status     = false;
        $message    = 'data tidak ada';
        $statuscode = REST_Controller::HTTP_NOT_FOUND;
        break;
    }
    $this->response([
      'status'  => $status,
      'message' => $message,
    ], $statuscode);
  }
}
