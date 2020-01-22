<?php

class Carimodel extends CI_Model
{
  private $tipename = array('hp_in', 'hp_out', 'servis_out', 'servis_return', 'accesoris');
  public function getdata($keyword)
  {
    $returndata  = null;
    $arrkeyword  = json_decode($keyword, true);
    $isdataexist = false;
    switch ($arrkeyword['tipe']) {
      case 'hm':
        $returndata = $this->getDataItem($this->tipename[0], $arrkeyword);
        break;
      case 'hk':
        $returndata = $this->getDataItem($this->tipename[1], $arrkeyword);
        break;
      case 'ss':
        $returndata = $this->getDataItem($this->tipename[2], $arrkeyword);
        break;
      case 'sr':
        $returndata = $this->getDataItem($this->tipename[3], $arrkeyword);
        break;
      case 'acc':
        $returndata = $this->getDataItem($this->tipename[4], $arrkeyword);
        break;
      case 'all':
        $returndata = $this->getAlldata($arrkeyword);
        break;
      default:
        # code...
        break;
    }
    return $returndata;
  }

  private function getDataItem($tipe, $arrkeyword)
  {
    $returndata     = array();
    $tipenamelenght = count($this->tipename);
    for ($i = 0; $i < $tipenamelenght; $i++) {
      $returndata[$this->tipename[$i]] = null;
    }
    $iskeywordexist = false;
    $this->db->select('*');
    $this->db->order_by('tanggal', 'DESC');
    if ($tipe == 'accesoris') {
      if (!is_null($arrkeyword['kw1'])) {
        if ($arrkeyword['kw1'] != '') {
          $this->db->like('nama', $arrkeyword['kw1']);
          $iskeywordexist = true;
        }
      }
    } else {
      if (!is_null($arrkeyword['kw1'])) {
        if ($arrkeyword['kw1'] != '') {
          $this->db->where('merk', $arrkeyword['kw1']);
          $iskeywordexist = true;
        }
      }
      if (!is_null($arrkeyword['kw2'])) {
        if ($arrkeyword['kw2'] != '') {
          $this->db->where('tipe', $arrkeyword['kw2']);
          $iskeywordexist = true;
        }
      }
      if (!is_null($arrkeyword['kw3'])) {
        if ($arrkeyword['kw3'] != '') {
          $this->db->group_start();
          $this->db->where('imei', $arrkeyword['kw3']);
          if (($tipe == 'servis_out') || ($tipe == 'servis_return')) {
            $this->db->or_like('kerusakan', $arrkeyword['kw3']);
          }
          $this->db->group_end();
          $iskeywordexist = true;
        }
      }
    }
    if ($iskeywordexist) {
      $resultitem = $this->db->get($tipe)->result_array();
      $resultsize = count($resultitem);
      if ($resultsize > 0) {
        $returndata[$tipe] = $resultitem;
      }
    }
    return $returndata;
  }

  private function getAlldata($keyword)
  {
    $returndata     = array();
    $tipenamelenght = count($this->tipename);
    for ($i = 0; $i < $tipenamelenght; $i++) {
      $returndata[$this->tipename[$i]] = null;
    }
    if (!is_null($keyword['kw1'])) {
      if ($keyword['kw1'] != '') {
        for ($j = 0; $j < $tipenamelenght; $j++) {
          $itemdata     = $this->getItem($this->tipename[$j], $keyword['kw1']);
          $sizeitemdata = count($itemdata);
          if ((!is_null($itemdata)) && ($sizeitemdata > 0)) {
            $returndata[$this->tipename[$j]] = $itemdata;
          }
        }
      }
    }
    return $returndata;
  }

  private function getItem($tipe, $keyword)
  {
    $returndata  = null;
    $index       = 0;
    $columnsname = array();
    $query       = $this->db->query("SHOW columns FROM $tipe");
    foreach ($query->result_array() as $row) {
      array_push($columnsname, $row['Field']);
    }
    $this->db->select('*');
    $this->db->order_by('tanggal', 'DESC');
    foreach ($columnsname as $value) {
      if ($index == 0) {
        $this->db->like($value, $keyword);
      } else {
        $this->db->or_like($value, $keyword);
      }
      $index += 1;
    }
    $returndata = $this->db->get($tipe)->result_array();
    return $returndata;
  }

}
