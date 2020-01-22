<?php

class Adminmenumodel extends CI_Model
{
  public function getdata($tipeitem)
  {
    $this->db->select('*');
    $this->db->order_by('urutan', 'asc');
    $returndata['sales'] = $this->db->get('sales')->result_array();
    switch ($tipeitem) {
      case 'hp':
        $this->db->select('*');
        $this->db->order_by('urutan', 'asc');
        $returndata['jaringan'] = $this->db->get('jaringan')->result_array();
        $this->db->select('*');
        $this->db->order_by('urutan', 'asc');
        $returndata['ram'] = $this->db->get('ram')->result_array();
        $this->db->select('*');
        $this->db->order_by('urutan', 'asc');
        $returndata['rom'] = $this->db->get('rom')->result_array();
        $this->db->select('*');
        $this->db->order_by('urutan', 'asc');
        $returndata['garansi'] = $this->db->get('garansi')->result_array();
        $this->db->select('*');
        $this->db->order_by('urutan', 'asc');
        $returndata['kelengkapan'] = $this->db->get('kelengkapan')->result_array();
        break;
      default:
        break;
    }
    return $returndata;
  }
}
