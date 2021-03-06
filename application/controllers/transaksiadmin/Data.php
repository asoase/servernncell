<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Data extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksiadmin/Database', 'database');
  }

  public function oneweek_get()
  {
    $tanggal = $this->get('tanggal');

    $returndata = $this->database->oneweekdata($tanggal);

    if (!is_null($returndata)) {
      $this->response([
        'status' => true,
        'data'   => $returndata,
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status'  => false,
        'message' => 'data not found',
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }
  
}
