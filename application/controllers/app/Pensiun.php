<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensiun extends CI_Controller {

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
		$this->load->model(['ModelPensiun' => 'pensiun']);
		
    }

	public function apitest() 
	{
		$req = postApi('http://silka.balangankab.go.id/services/pensiun/profile', ['nip' => '197812042005012009']);
		echo $req;
	}

	public function carinip()
	{
		$nip = $this->input->post('nip');
		$req = postApi('http://silka.balangankab.go.id/services/pensiun/profile', ['nip' => $nip]);
		echo $req;
	}

    public function buatusul()
    {
		$getToken = isset($_GET['token']);
        if($getToken) {
            $detail = $this->pensiun->getWhere('usul_pengantar', ['token' => $_GET['token']])->row();
        }

		$data = [
			'title' => 'Buat Usul Pensiun | Integrated Pensiun ASN',
			'content' => 'pages/buatusul',
			'jenis_pensiun' => $this->pensiun->getJenisPensiun(),
			'detail' => @$detail
		];

        $this->load->view('layouts/app', $data);
    }

	public function buatpengantar()
	{
		$post = $this->input->post();

		$token = $post['token'];

		if(!empty($token)) {
			$data = [
				'fid_jenis_usul' => $post['jenis_pensiun'],
				'nomor' => $post['nomor_usul'],
				'tanggal' => formatToSQL($post['tgl_usul'])
			];
			$db = $this->pensiun->update('usul_pengantar', $data, ['token' => $token]);
            $isToken = $token;
		} else {
			$data = [
				'token' => generateRandomString(18),
				'fid_jenis_usul' => $post['jenis_pensiun'],
				'nomor' => $post['nomor_usul'],
				'tanggal' => formatToSQL($post['tgl_usul']),
				'created_by' => $this->session->userdata('nip')
			];
			$db = $this->pensiun->insert('usul_pengantar', $data);
			$isToken = $data['token'];
		}

		if($db)
		{
			$msg = [
				'status' => true,
				'message' => 'Pengantar Berhasil Dibuat',
				'redirect' => base_url('/app/pensiun/buatusul?step=2&token='.$isToken)
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'Pengantar Gagal Dibuat',
				'redirect' => null
			];
		}

		echo json_encode($msg);
	}
}