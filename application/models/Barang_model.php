<?php 

class barang_model extends CI_Model
{
	
	public function getHp($tanggal = null, $hpin = true)
	{
		if($hpin) $tabel = 'hp_in';
		else $tabel = 'hp_out';
		if($tanggal === null){
			return $this->db->get($tabel)->result_array();
		} else {
			return $this->db->get_where($tabel, ['tanggal' => $tanggal])->result_array();
		}
	}
	
	public function createHp($data, $hpin = true)
	{
		if($hpin) $tabel = 'hp_in';
		else $tabel = 'hp_out';
		$this->db->insert($tabel, $data);
		return $this->db->affected_rows();
	}

	public function deleteHp($id, $hpin = true)
	{
		if($hpin) $tabel = 'hp_in';
		else $tabel = 'hp_out';
		$count = $this->db->count_all($tabel);
		$this->db->delete($tabel, ['id' => $id]);
		$new_count = $this->db->count_all($tabel);
		$compare = $count - $new_count;
		if($compare > 0){
			return true;
		} else {
			return false;
		}
	}

	public function updateHp($id, $data, $hpin = true)
	{
		if($hpin) $tabel = 'hp_in';
		else $tabel = 'hp_out';
		$this->db->update($tabel, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function getServis($tanggal = null, $servisreturn = true)
	{
		if($servisreturn) $tabel = 'servis_return';
		else $tabel = 'servis_out';
		if($tanggal === null){
			return $this->db->get($tabel)->result_array();
		} else {
			return $this->db->get_where($tabel, ['tanggal' => $tanggal])->result_array();
		}
	}

	public function createServis($data, $servisreturn = true)
	{
		if($servisreturn) $tabel = 'servis_return';
		else $tabel = 'servis_out';
		$this->db->insert($tabel, $data);
		return $this->db->affected_rows();
	}

	public function deleteServis($id, $servisreturn = true)
	{
		if($servisreturn) $tabel = 'servis_return';
		else $tabel = 'servis_out';
		$count = $this->db->count_all($tabel);
		$this->db->delete($tabel, ['id' => $id]);
		$new_count = $this->db->count_all($tabel);
		$compare = $count - $new_count;
		if($compare > 0){
			return true;
		} else {
			return false;
		}
	}

	public function updateServis($id, $data, $servisin = true)
	{
		if($servisin) $tabel = 'servis_return';
		else $tabel = 'servis_out';
		$this->db->update($tabel, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function getAccesoris($tanggal = null)
	{
		if($tanggal === null){
			return $this->db->get('accesoris')->result_array();
		} else {
			return $this->db->get_where('accesoris', ['tanggal' => $tanggal])->result_array();
		}
	}
	
	public function createAccesoris($data)
	{
		$this->db->insert('accesoris', $data);
		return $this->db->affected_rows();
	}

	public function deleteAccesoris($id)
	{
		$count = $this->db->count_all('accesoris');
		$this->db->delete('accesoris', ['id' => $id]);
		$new_count = $this->db->count_all('accesoris');
		$compare = $count - $new_count;
		if($compare > 0){
			return true;
		} else {
			return false;
		}
	}

	public function updateAccesoris($id, $data)
	{
		$this->db->update('accesoris', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

}

?>