<?php

class Hpoutmodel extends CI_Model
{
	public function getdata($id){
		$this->db->select('*');
		$this->db->where('id =', $id);
		$returndata = $this->db->get('hp_out')->result_array();
		return $returndata;
	}
  public function putdata($id, $data)
  {
    $arrdata = json_decode($data, true);
    $this->db->where('id', $id);
    $this->db->update('hp_out', $arrdata);
    $result = 0;
    if ($this->db->affected_rows() > 0) {
      $result = 1;
    }
    return $result;
  }
}