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
		$jumlah_usulan = $this->pensiun->getWhere('usul', ['is_status' => 'SKPD']);
		$jumlah_selesai = $this->pensiun->getWhere('usul', ['is_status' => 'SELESAI']);
		$data = [
			'title' => 'Dashboard | Integrated Pensiun ASN',
			'content' => 'pages/dashboard',
			'statistik' => $statistik,
			'jumlah_usulan' => $jumlah_usulan->num_rows(),
			'jumlah_selesai' => $jumlah_selesai->num_rows(),
		];

        $this->load->view('layouts/app', $data);
    }

}