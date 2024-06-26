<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
		cek_session();
		$this->load->model(['ModelPensiun' => 'pensiun', 'ModelPensiunInbox' => 'inbox']);
    }

    public function index()
    {
		$statistik = postApi('http://silka.balangankab.go.id/services/statistik', []);
		$jumlah_usulan = $this->pensiun->JmlByUsulInbox();
		$jumlah_selesai = $this->pensiun->JmlByUsulSelesai();

		// Charts
		$charts = [
			'bup' => $this->pensiun->JmlByJenis(1)->num_rows(),
			'jadu' => $this->pensiun->JmlByJenis(2)->num_rows(),
			'aps' => $this->pensiun->JmlByJenis(3)->num_rows(),
			'udzur' => $this->pensiun->JmlByJenis(4)->num_rows(),
			'mpp' => $this->pensiun->JmlByJenis(5)->num_rows(),
		];
		$data = [
			'title' => 'Dashboard | Integrated Pensiun ASN',
			'content' => 'pages/dashboard',
			'statistik' => $statistik,
			'jumlah_usulan' => $jumlah_usulan->num_rows(),
			'jumlah_selesai' => $jumlah_selesai->num_rows(),
			'charts' => $charts
		];

        $this->load->view('layouts/app', $data);
    }

}