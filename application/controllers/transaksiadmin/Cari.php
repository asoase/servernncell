<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cari extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksiadmin/Carimodel', 'carimodel');
  }
  public function Caridata_get()
  {
    $keyword    = $this->get('keyword');
    $returndata = $this->carimodel->getdata($keyword);
    if (!is_null($returndata)) {
      $this->response([
        'status' => true,
        'data'   => $returndata,
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status'  => false,
        'message' => 'data tidak ada',
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

}
