<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class ModelLaporan extends CI_Model {
    public function getDaftarUsulPensiun($filter)
    {
        $this->db->select('nama,nip,gelar_depan,gelar_belakang,created_at,nama_unit_kerja');
        $this->db->from('usul');
        $this->db->where('YEAR(created_at)', $filter['tahun']);
        $this->db->where('MONTH(created_at)', $filter['bulan']);
        return $this->db->get();
    }

    public function getDaftarPengantarUsulPensiun($filter)
    {
        $this->db->select('*');
        $this->db->from('usul_pengantar');
        $this->db->where('YEAR(created_at)', $filter['tahun']);
        $this->db->where('MONTH(created_at)', $filter['bulan']);
        return $this->db->get();
    }

    public function getDaftarVervalUsulPensiun($filter)
    {
        $this->db->select('u.nip,u.nama,u.gelar_depan,u.gelar_belakang,u.verify_at,u.is_status,u.approve_at,
        uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul AS u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where('u.is_status', $filter['status']);    
        //$this->db->where_in('u.is_status', ['BKPSDM','TTD_SK','SELESAI']); // daftar status verifikasi dan approveval bkpsdm
        return $this->db->get();
    }

    public function getDaftarTandaTerimaUsulPensiun($filter)
    {
        $this->db->select('u.nip,u.nama,u.gelar_depan,u.gelar_belakang,u.diterima_oleh,u.arsip_at,u.nomor_sk,u.tanggal_sk,
        uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul AS u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where('u.is_status', 'SELESAI_ARSIP'); // hanya status ARSIP / SK Sudah Diterima
        $this->db->where('u.nip', $filter['nip']);
        return $this->db->get();
    }

    public function getTrendKesalahanUsulPensiun($filter)
    {
        $this->db->select('nip,nama,gelar_depan,gelar_belakang,verify_at,catatan,is_status');
        $this->db->from('usul');
        $this->db->where('is_status', $filter['jns_kesalahan']);  
        // $this->db->where_in('is_status', ['SELESAI_TMS','SELESAI_BTL']); // hanya status approve bkpsdm
        return $this->db->get();
    }
}
                    
/* End of file ModelLaporan.php */