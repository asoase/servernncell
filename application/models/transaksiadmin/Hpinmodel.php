<?php

class Hpinmodel extends CI_Model
{
	public function getdata($id){
		$this->db->select('*');
		$this->db->where('id =', $id);
		$returndata = $this->db->get('hp_in')->result_array();
		return $returndata;
	}
}