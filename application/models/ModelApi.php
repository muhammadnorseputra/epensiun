<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class ModelApi extends CI_Model {
    public function detail($nip) {
        $this->db->select('u.*,uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul=uj.id');
        $this->db->where('u.nip', $nip);
        // $this->db->where_in('u.is_status', ['SELESAI', 'SELESAI_ARSIP']);
        return $this->db->get();
    }
}