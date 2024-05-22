<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Referensi extends CI_Controller
{

    public function index()
    {
    }

    protected function dbGetUsulJenis() {
        $this->db->select('*');
        $this->db->from('usul_jenis');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }
    public function jenis_pensiun() { 
        $data = [
            'title' => 'Jenis Pensiun | Referensi',
            'content' => 'pages/ref_jenis_pensiun',
            'datares' => $this->dbGetUsulJenis()
        ];

        $this->load->view('layouts/app', $data);
    }
}
        
    /* End of file  Referensi.php */
