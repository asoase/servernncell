<?php

class Accesorismodel extends CI_Model
{
	public function getdata($id){
		$this->db->select('*');
		$this->db->where('id =', $id);
		$returndata = $this->db->get('accesoris')->result_array();
		return $returndata;
	}
}