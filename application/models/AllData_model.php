<?php

class AllData_model extends CI_Model
{

	public function getalldata($tanggal){
		$indexday = strtotime('w', strtotime($tanggal));
		$indexday = date('w', $indexday); // urutan hari angka
		$addday = 6-$indexday;
		$weeknow = strtotime('+'.$addday.' day', strtotime($tanggal));
		$weeknow = date ('Y-m-d', $weeknow); // sabtu minggu ini
		$weeklast = strtotime('-6 day', strtotime($weeknow));
		$weeklast = date('Y-m-d', $weeklast); // senin minggu ini
		$nextweek = strtotime('+1 day', strtotime($weeknow));
		$nextweek = date('Y-m-d', $nextweek); // minggu minggu depan
		$alldata['day']['fromday'] = $weeklast;
		$alldata['day']['untilday'] = $weeknow;
		$alldata['day']['nextweek'] = $nextweek;
		$alldata['weeknow'] = $this->getwhere($weeknow, $weeklast);

		$weeknow = strtotime('-1 day', strtotime($weeklast));
		$weeknow = date('Y-m-d', $weeknow);
		$alldata['day']['lastweek'] = $weeknow; // sabtu minggu lalu
		$weeklast = strtotime('-6 day', strtotime($weeknow));
		$weeklast = date('Y-m-d', $weeklast);
		$alldata['weeklast'] = $this->getwhere($weeknow, $weeklast);
		return $alldata;
	}
	private function setwhere($weeknow, $weeklast){
		$this->db->select('*');
		$this->db->where('tanggal <=', $weeknow);
		$this->db->where('tanggal >=', $weeklast);
		$this->db->order_by('tanggal', 'desc');
	}
	private function getwhere($weeknow, $weeklast){
		$this->setwhere($weeknow, $weeklast);
		$vhpin = $this->db->get('hp_in')->result_array();
		$this->setwhere($weeknow, $weeklast);
		$vhpout = $this->db->get('hp_out')->result_array();
		$this->setwhere($weeknow, $weeklast);
		$vservisdone = $this->db->get('servis_out')->result_array();
		$this->setwhere($weeknow, $weeklast);
		$vservisreturn = $this->db->get('servis_return')->result_array();
		$this->setwhere($weeknow, $weeklast);
		$vacc = $this->db->get('accesoris')->result_array();
		$week['vhpin'] = $vhpin;
		$week['vhpout'] = $vhpout;
		$week['vservisdone'] = $vservisdone;
		$week['vservisreturn'] = $vservisreturn;
		$week['vacc'] = $vacc;
		return $week;
	}

	public function submitalldata($datainput){
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

	public function gethpin($id){
		$query = $this->db->get_where('hp_in', array('id' => $id));
		return $query->result_array();
	}

	public function gethpout($id){
		$query = $this->db->get_where('hp_out', array('id' => $id));
		return $query->result_array();
	}
	public function getservin($id){
		$query = $this->db->get_where('servis_return', array('id' => $id));
		return $query->result_array();
	}
	public function getservout($id){
		$query = $this->db->get_where('servis_out', array('id' => $id));
		return $query->result_array();
	}
	public function getacc($id){
		$query = $this->db->get_where('accesoris', array('id' => $id));
		return $query->result_array();
	}
	
}

?>
