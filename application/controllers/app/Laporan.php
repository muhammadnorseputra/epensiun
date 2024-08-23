<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session();
        $this->load->model(['ModelLaporan' => 'laporan']);
    }
	public function usul_pensiun()
	{
		$data = [
            'title' => 'Laporan Usul Pensiun | Integrated Pensiun ASN',
            'content' => 'pages/laporan/usul_pensiun',
            'data' => $this->laporan->getDaftarUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}
   
   public function pengantar_usul()
	{
		$data = [
            'title' => 'Laporan Pengantar Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/pengantar_usul',
            'data' => $this->laporan->getDaftarPengantarUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}
   
   public function verval_usul()
	{
		$data = [
            'title' => 'Laporan Verifikasi dan Validasi Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/verval_usul',
            'data' => $this->laporan->getDaftarVervalUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}
	public function tanda_terima_sk_pensiun()
	{
		$data = [
            'title' => 'Laporan Tanda Terima Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/tanda_terima_sk_pensiun',
            'data' => $this->laporan->getDaftarTandaTerimaUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}
	public function trend_kesalahan_usulan()
	{
		$data = [
            'title' => 'Laporan Trend Kesalahan Usulan | Integrated Pensiun ASN',
            'content' => 'pages/laporan/trend_kesalahan_usulan',
            'data' => $this->laporan->getTrendKesalahanUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}


}
        
    /* End of file  app/Arsip.php */
