<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class ModelLaporan extends CI_Model {
    public function getDaftarUsulPensiun()
    {
        $this->db->select('nama,nip,gelar_depan,gelar_belakang,created_at,nama_unit_kerja');
        $this->db->from('usul');
        return $this->db->get();
    }

    public function getDaftarPengantarUsulPensiun()
    {
        $this->db->select('*');
        $this->db->from('usul_pengantar');
        return $this->db->get();
    }

    public function getDaftarVerifikasiUsulPensiun()
    {
        $this->db->select('u.nip,u.nama,u.gelar_depan,u.gelar_belakang,u.verify_at,
        uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul AS u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where('u.is_status', 'BKPSDM'); // hanya status verifikasi bkpsdm
        return $this->db->get();
    }

    public function getDaftarApproveUsulPensiun()
    {
        $this->db->select('u.nip,u.nama,u.gelar_depan,u.gelar_belakang,u.verify_at,
        uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul AS u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where('u.is_status', 'APPROVE'); // hanya status approve bkpsdm
        return $this->db->get();
    }

    public function getTrendKesalahanUsulPensiun()
    {
        $this->db->select('nip,nama,gelar_depan,gelar_belakang,verify_at,catatan,is_status');
        $this->db->from('usul');
        $this->db->where_in('is_status', ['SELESAI_TMS','SELESAI_BTL']); // hanya status approve bkpsdm
        return $this->db->get();
    }
}
                    
/* End of file ModelLaporan.php */