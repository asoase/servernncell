<?php

class Submitbarang extends CI_Model
{
	public function posttodb($datainput)
	{
		$dataobj = json_decode($datainput, true);

		if((sizeof($dataobj['vhpin'])) > 0)
			$this->db->insert_batch('hp_in', $dataobj['vhpin']);
		if((sizeof($dataobj['vhpout'])) > 0)
			$this->db->insert_batch('hp_out', $dataobj['vhpout']);
		if((sizeof($dataobj['vservisreturn'])) > 0)
			$this->db->insert_batch('servis_return', $dataobj['vservisreturn']);
		if((sizeof($dataobj['vservisdone'])) > 0)
			$this->db->insert_batch('servis_out', $dataobj['vservisdone']);
		if((sizeof($dataobj['vacc'])) > 0)
			$this->db->insert_batch('accesoris', $dataobj['vacc']);
		return 1;
	}
}
