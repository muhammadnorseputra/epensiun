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
            $this->db->where_not_in('usul.is_status', ['SELESAI','SELESAI_ARSIP']);
            $this->db->where_not_in('up.fid_jenis_usul', ['2','3','4','5']);
        }
        $this->db->where_not_in('usul.is_status', ['SELESAI_TMS','SELESAI_BTL']);
        return $this->db->get();
    }

    public function JmlByJenis($jns) 
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul = uj.id');
        $this->db->where('up.fid_jenis_usul', $jns);
        // $this->db->where_not_in('up.fid_jenis_usul', ['5']);
        $this->db->where_in('up.is_status', ['SELESAI','SELESAI_ARSIP']);
        return $this->db->get();
    }

    public function JmlByUsulSelesai()
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->where_in('up.is_status', ['SELESAI','SELESAI_ARSIP']);
        return $this->db->get(); 
    }

    public function JmlByUsulInbox()
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->where_in('up.is_status', ['SKPD','BKPSDM']);
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

    public function getWhereIn($table, $whr)
    {
        $this->db->where_in($whr);
        return $this->db->get($table);
    }

}

/* End of file Pensiun.php */

?>