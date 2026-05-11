<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Referensi extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		// cek session level
		if($this->session->userdata('level') !== 'ADMIN') {
			return show_404();
		}
	}

    public function index()
    {
    }

    protected function dbGetUsulJenis() {
        $this->db->select('*');
        $this->db->from('usul_jenis');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    protected function dbGetUsulJenisById($id) {
        $this->db->select('*');
        $this->db->from('usul_jenis');
        $this->db->order_by('id', 'desc');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }


    public function jenis_pensiun() { 
        $data = [
            'title' => 'Jenis Pensiun | Referensi',
            'content' => 'pages/ref_jenis_pensiun',
            'datares' => $this->dbGetUsulJenis()
        ];

        $this->load->view('layouts/app', $data);
    }

    public function getJenisPensiun() {
        $id = $this->input->post('id');
        $row = $this->dbGetUsulJenisById($id);
        echo json_encode($row);
    }

    public function updateJenisPensiun() {
        $post = $this->input->post();
        $update = [
            'nama' => $post['nama'],
            'keterangan' => $post['keterangan'],
            'kelompok' => $post['kelompok'],
            'is_aktif' => $post['is_aktif']
        ];
        $db = $this->db->update('usul_jenis', $update, ['id' => $post['id']]);
        if($db) {
            $msg = ['status' => true, 'message' => 'Berhasil Diperbaharui'];
        } else {
            $msg = ['status' => false, 'message' => 'Gagal Diperbaharui'];
        }
        
        redirect(base_url('app/referensi/jenis_pensiun'),'refresh');
        
        echo json_encode($msg);
    }
}
        
    /* End of file  Referensi.php */
