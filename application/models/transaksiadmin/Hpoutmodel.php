<?php

class Hpoutmodel extends CI_Model
{
	public function getdata($id){
		$this->db->select('*');
		$this->db->where('id =', $id);
		$returndata = $this->db->get('hp_out')->result_array();
		return $returndata;
	}
}