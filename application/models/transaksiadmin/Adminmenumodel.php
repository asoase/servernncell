<?php

class Adminmenumodel extends CI_Model
{
  public function getdata($tipeitem)
  {
    $this->db->select('*');
    $returndata['sales'] = $this->db->get('sales')->result_array();
    if ($tipeitem == 0) {
      $this->db->select('*');
      $returndata['jaringan'] = $this->db->get('jaringan')->result_array();
      $this->db->select('*');
      $returndata['ram'] = $this->db->get('ram')->result_array();
      $this->db->select('*');
      $returndata['rom'] = $this->db->get('rom')->result_array();
      $this->db->select('*');
      $returndata['garansi'] = $this->db->get('garansi')->result_array();
      $this->db->select('*');
      $returndata['kelengkapan'] = $this->db->get('kelengkapan')->result_array();
    }
    return $returndata;
  }
}
