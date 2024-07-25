<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelApi extends CI_Model
{
    public function detail($nip)
    {
        $this->db->select('u.*,uj.nama as nama_jenis,uj.keterangan as keterangan_jenis');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'u.token=up.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul=uj.id');
        $this->db->where('u.nip', $nip);
        // $this->db->where_in('u.is_status', ['SELESAI', 'SELESAI_ARSIP']);
        return $this->db->get();
    }

    public function jmlUsulByStatus($isStatus)
    {
        $this->db->select('id');
        $this->db->from('usul');
        $this->db->where('is_status', $isStatus);
        return $this->db->get();
    }

    public function catatanByKesalahan()
    {
        $this->db->select('catatan,is_status');
        $this->db->from('usul');
        $this->db->where_in('is_status', ['SELESAI_TMS', 'SELESAI_BTL']);
        return $this->db->get();
    }

    public function jmlUsulByUnor($unorid)
    {
        $this->db->select('id,id_unit_kerja,nama_unit_kerja,MONTH(created_at) as usul_bulan,YEAR(created_at) as usul_tahun', false);
        $this->db->from('usul');
            $this->db->where('id_unit_kerja', $unorid);

        return $this->db->get();
    }

    public function jmlUsulByBulan($unorid,$bulan)
    {
        $this->db->select('id,id_unit_kerja,nama_unit_kerja,MONTH(created_at) as usul_bulan,YEAR(created_at) as usul_tahun', false);
        $this->db->from('usul');
            $this->db->where('id_unit_kerja', $unorid);
        $this->db->where('MONTH(created_at)', $bulan);
        return $this->db->get();
    }
}