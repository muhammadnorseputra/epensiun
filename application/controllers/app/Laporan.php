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
   
   public function verifikasi_usul()
	{
		$data = [
            'title' => 'Laporan Verifikasi Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/verifikasi_usul',
            'data' => $this->laporan->getDaftarVerifikasiUsulPensiun()
        ];

        $this->load->view('layouts/app', $data);
	}
	public function approve_usul()
	{
		$data = [
            'title' => 'Laporan Approve Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/approve_usul',
            'data' => $this->laporan->getDaftarApproveUsulPensiun()
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
	public function tanda_terima_sk_pensiun()
	{
		$data = [
            'title' => 'Laporan Tanda Terima SK Pensiun | Integrated Pensiun ASN',
            'content' => 'pages/laporan/tanda_terima_sk_pensiun',
        ];

        $this->load->view('layouts/app', $data);
	}
	public function trend_jenis_usulan()
	{
		$data = [
            'title' => 'Laporan Trend Jenis Usulan Pensiun | Integrated Pensiun ASN',
            'content' => 'pages/laporan/trend_jenis_usulan',
        ];

        $this->load->view('layouts/app', $data);
	}
	public function trend_periode_usulan()
	{
		$data = [
            'title' => 'Laporan Trend Periode Usulan Pensiun | Integrated Pensiun ASN',
            'content' => 'pages/laporan/trend_periode_usulan',
        ];

        $this->load->view('layouts/app', $data);
	}
	
}
        
    /* End of file  app/Arsip.php */
