<?php

class Database extends CI_Model
{
  public function oneweekdata($tanggal)
  {
    $indexday                   = strtotime($tanggal); // jumlah detik sampai $tanggal
    $indexday                   = date('w', $indexday); // urutan hari  dalam angka
    $addday                     = 6 - $indexday; //mendapat urutan hari mulai dari 0
    $weeknow                    = strtotime('+' . $addday . ' day', strtotime($tanggal));
    $weeknow                    = date('Y-m-d', $weeknow); // sabtu dari seminggu ini
    $weeklast                   = strtotime('-6 day', strtotime($weeknow));
    $weeklast                   = date('Y-m-d', $weeklast); // minggu dari seminggu ini
    $nextweek                   = strtotime('+1 day', strtotime($weeknow));
    $nextweek                   = date('Y-m-d', $nextweek); // minggu  dalam minggu depan
    $alldata['day']['fromday']  = $weeklast; //minggu
    $alldata['day']['untilday'] = $weeknow; //sabtu
    $alldata['day']['nextweek'] = $nextweek; //minggu depan
    $alldata['weeknow']         = $this->getwhere($weeknow, $weeklast); //minggu ini minggu sampai sabtu

    $weeknow                    = strtotime('-1 day', strtotime($weeklast)); //minggu lalu
    $weeknow                    = date('Y-m-d', $weeknow);
    $alldata['day']['lastweek'] = $weeknow; // sabtu minggu lalu
    $weeklast                   = strtotime('-6 day', strtotime($weeknow));
    $weeklast                   = date('Y-m-d', $weeklast);
    $alldata['weeklast']        = $this->getwhere($weeknow, $weeklast); //minggu lalu minggu sampai sabtu
    $weeknow                    = strtotime('+6 day', strtotime($nextweek));
    $weeknow                    = date('Y-m-d', $weeknow);
    $weeklast                   = $nextweek;
    $alldata['weeknext']        = $this->getwhere($weeknow, $weeklast); //minggu depan mingu sampai sabtu
    $alldata['salesname']       = $this->getsalesname();
    return $alldata;
  }
  private function setwhere($weeknow, $weeklast, $table)
  {
    $this->db->select($table);
    $this->db->where('tanggal <=', $weeknow);
    $this->db->where('tanggal >=', $weeklast);
    $this->db->order_by('tanggal', 'desc');
  }
  private function getwhere($weeknow, $weeklast)
  {
    $this->setwhere($weeknow, $weeklast, 'id, tanggal, merk, tipe, imei, sales');
    $vhpin = $this->db->get('hp_in')->result_array();
    $this->setwhere($weeknow, $weeklast, 'id, tanggal, merk, tipe, imei, sales');
    $vhpout = $this->db->get('hp_out')->result_array();
    $this->setwhere($weeknow, $weeklast, 'id, tanggal, merk, tipe, imei, teknisi');
    $vservisdone = $this->db->get('servis_out')->result_array();
    $this->setwhere($weeknow, $weeklast, 'id, tanggal, merk, tipe, imei, teknisi');
    $vservisreturn = $this->db->get('servis_return')->result_array();
    $this->setwhere($weeknow, $weeklast, 'id, tanggal, nama');
    $vacc                  = $this->db->get('accesoris')->result_array();
    $week['vhpin']         = $vhpin;
    $week['vhpout']        = $vhpout;
    $week['vservisdone']   = $vservisdone;
    $week['vservisreturn'] = $vservisreturn;
    $week['vacc']          = $vacc;
    return $week;
  }
  private function getsalesname()
  {
    $this->db->select('*');
    $salesname = $this->db->get('sales')->result_array();
    return $salesname;
  }

}
