<?php
use Restserver\Libraries\REST_Controller;

class Servisreturnmodel extends CI_Model
{
  public function getdata($id)
  {
    $this->db->select('*');
    $this->db->where('id', $id);
    $returndata = $this->db->get('servis_return')->row_array();
    return $returndata;
  }

  public function putdata($id, $data)
  {
    $this->db->select('id');
    $this->db->where('id', $id);
    $idexist = $this->db->get('servis_return')->row_array();
    if (is_null($idexist)) {
      $result = REST_Controller::HTTP_NOT_FOUND;
      return $result; //not found
    }
    $arrdata = json_decode($data, true);
    $this->db->where('id', $id);
    $this->db->update('servis_return', $arrdata);
    $result = REST_Controller::HTTP_NO_CONTENT; //no content
    if ($this->db->affected_rows() > 0) {
      $result = REST_Controller::HTTP_OK; //success ok
    }
    return $result;
  }

  public function deletedata($id)
  {
    $this->db->select('id');
    $this->db->where('id', $id);
    $idexist = $this->db->get('servis_return')->row_array();
    if (is_null($idexist)) {
      $result = REST_Controller::HTTP_NOT_FOUND;
      return $result; //not found
    }
    $this->db->where('id', $id);
    $isdeleted = $this->db->delete('servis_return');
    if ($isdeleted) {
      $result = REST_Controller::HTTP_OK; //success ok
    } else {
      $result = REST_Controller::HTTP_NO_CONTENT; //no content gagal dihapus
    }
    return $result;
  }

}
