<?php

class Servisoutmodel extends CI_Model
{
	public function getdata($id){
		$this->db->select('*');
		$this->db->where('id =', $id);
		$returndata = $this->db->get('servis_out')->result_array();
		return $returndata;
	}
}