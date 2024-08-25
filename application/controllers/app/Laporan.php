<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek session login
		cek_session();	
		// cek session level
		if($this->session->userdata('level') !== 'ADMIN') {
			return show_404();
		}
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
        $req = [
            'url' => 'http://silka.balangankab.go.id/services/PegawaiWithBasicAuth/getSKPD?nip=199204072015032002&role=ADMIN',
            'headers' => [
                'apiKey' => 'bkpsdm6811',
                'Authorization' => 'Basic QmFsYW5nYW5rYWI6Ymtwc2RtQDIwMjI='
            ]
           ];
  
        $skpd = httpclient($req);

		$data = [
            'title' => 'Laporan Pengantar Usul | Integrated Pensiun ASN',
            'content' => 'pages/laporan/pengantar_usul',
            'data' => $this->laporan->getDaftarPengantarUsulPensiun(),
            'skpd' => json_decode($skpd['body'], true)
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
