<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPensiun extends CI_Model {

    public function getJenisPensiun()
    {
        return $this->db->get('usul_jenis');
    }

    public function cekusulasn($tbl,$nip,$jns) {
        $this->db->select('usul.nip,usul.token,up.fid_jenis_usul,uj.nama as jenis_usul');
        $this->db->from($tbl);
        $this->db->join('usul_pengantar as up', 'usul.token=up.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul=uj.id');
        $this->db->where('usul.nip', $nip);
        if($jns === '1') {
            $this->db->where_not_in('usul.is_status', ['TTD_SK','SELESAI']);
        }
        $this->db->where_not_in('usul.is_status', ['SELESAI_TMS','SELESAI_BTL']);
        return $this->db->get();
    }

    public function insert($table, $data) 
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $whr)
    {
        $this->db->where($whr);
        return $this->db->update($table, $data);
    }

    public function getWhere($table, $whr)
    {
        return $this->db->get_where($table, $whr);
    }

}

/* End of file Pensiun.php */

?>