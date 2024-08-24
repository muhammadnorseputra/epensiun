<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

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
		$this->load->model([
			'ModelPensiun' => 'pensiun',
			'ModelPensiunInbox' => 'inbox',
			'ModelApi' => 'api'
		]);
	}

	public function index()
	{
		$statistik = postApi('http://silka.balangankab.go.id/services/statistik', []);
		$jumlah_usulan = $this->pensiun->JmlByUsulInbox();
		$jumlah_selesai_skpd = $this->pensiun->JmlByUsulSelesaiBySKPD();
		$jumlah_selesai = $this->pensiun->JmlByUsulSelesai();

		$tms = $this->api->jmlUsulByStatus('SELESAI_TMS')->num_rows();
		$btl = $this->api->jmlUsulByStatus('SELESAI_BTL')->num_rows();
		$catatan = $this->api->catatanByKesalahan()->result();
		
		$listunor = postApi('http://silka.balangankab.go.id/services/statistik/listunor', [], 'GET');
		// Charts
		$charts = [
			'bup' => $this->pensiun->JmlByJenis(1)->num_rows(),
			'jadu' => $this->pensiun->JmlByJenis(2)->num_rows(),
			'aps' => $this->pensiun->JmlByJenis(3)->num_rows(),
			'udzur' => $this->pensiun->JmlByJenis(4)->num_rows(),
			'mpp' => $this->pensiun->JmlByJenis(5)->num_rows(),
			'tms' => $tms,
			'btl' => $btl,
			'total_kesalahan' => ($tms + $btl),
			'catatan' => $catatan
		];
		$data = [
			'title' => 'Dashboard | Integrated Pensiun ASN',
			'content' => 'pages/dashboard',
			'statistik' => $statistik,
			'jumlah_usulan' => $jumlah_usulan->num_rows(),
			'jumlah_selesai' => $jumlah_selesai->num_rows(),
			'jumlah_selesai_skpd' => $jumlah_selesai_skpd->num_rows(),
			'charts' => $charts,
			'listunor' => $listunor,
		];

		$this->load->view('layouts/app', $data);
	}

	protected function bulan($bln_db, $bln_now) {
		return $bln_db == $bln_now ? @count($bln_db) : 0;
	}

	protected function getJumlaUsul($unorid,$bulan) {
		$query = $this->api->jmlUsulByBulan($unorid,$bulan)->num_rows();
		return $query !== 0 ? $query : 0;
	}

	public function chartUsulPensiunByPeriode()
	{
		$unorid = $this->input->post('unorid');
		$db = $this->api->jmlUsulByUnor($unorid)->row();
		$data = [
			'nama_unit_kerja' => !empty($db->nama_unit_kerja) ? $db->nama_unit_kerja : 'Nama Unit Organisasi/SKPD/SOPD',
			'row' => [
				"Jan" => $this->getJumlaUsul($unorid, 1),
				"Feb" => $this->getJumlaUsul($unorid, 2),
				"Mar" => $this->getJumlaUsul($unorid, 3),
				"Apr" => $this->getJumlaUsul($unorid, 4),
				"May" => $this->getJumlaUsul($unorid, 5),
				"Jun" => $this->getJumlaUsul($unorid, 6),
				"Jul" => $this->getJumlaUsul($unorid, 7),
				"Aug" => $this->getJumlaUsul($unorid, 8),
				"Sep" => $this->getJumlaUsul($unorid, 9),
				"Oct" => $this->getJumlaUsul($unorid, 10),
				"Nov" => $this->getJumlaUsul($unorid, 11),
				"Dec" => $this->getJumlaUsul($unorid, 12),
			]
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}