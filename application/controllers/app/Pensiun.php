<?php
defined('BASEPATH') or exit('No direct script access allowed');

use UUID\UUID;

class Pensiun extends CI_Controller
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
		$this->load->model(['ModelPensiun' => 'pensiun']);
	}

	// public function apitest()
	// {
	// 	$req = postApi('http://silka.balangankab.go.id/services/pensiun/profile', ['nip' => '197812042005012009']);
	// 	echo $req;
	// }

	public function syarat()
	{
		$jns = $this->input->get('id');
		if ($jns === '1') {
			return $this->load->view('pra-berkas/bup');
		}

		if ($jns === '2') {
			return $this->load->view('pra-berkas/jadu');
		}

		if ($jns === '3') {
			return $this->load->view('pra-berkas/aps');
		}

		if ($jns === '4') {
			return $this->load->view('pra-berkas/udzur');
		}

		if ($jns === '5') {
			return $this->load->view('pra-berkas/mpp');
		}

		echo "<div class='my-6 gap-6 d-flex flex-column justify-content-center align-items-center'><i class='bi bi-bell-slash-fill fs-1 text-danger me-2'></i> Page Not Found !</div>";
	}

	public function cekusul()
	{
		$data = [
			'title' => 'Cek Usul Pensiun | Integrated Pensiun ASN',
			'content' => 'pages/cekusul'
		];

		$this->load->view('layouts/app', $data);
	}

	public function cekusul_proses()
	{
		// filter pencarian berdasarkan NIP dan Kewenangan Akun UMPEG
		$nip = $this->input->post('nip');
		$db = $this->pensiun->getWhere('usul', ['nip' => $nip, 'created_by_unorid' => $this->session->userdata('unker_id')]);
		
		if ($db->num_rows() > 0) {
			$usul = $db->row();
			$template = $this->load->view('pages/statususul', ['usul' => $usul]);
			return false;
		}

		$template = '<i class="bi bi-x-circle-fill text-danger me-2"></i> Usulan "<strong>' . $nip . '</strong>" Tidak Ditemukan !';

		echo json_encode($template);
	}

	public function carinip()
	{
		$client = new \GuzzleHttp\Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$nip = $this->input->post('nip');
		$endpoint = "pns/".$nip."/pensiun";
		
		$headers = [
			'headers' => [
				'apiKey' => $this->config->item('X-API-KEY'),
				'Authorization' => 'Bearer '.$this->session->userdata('access_token'),
				'Accept' => 'application/json',
				'Content-Type' => 'multipart/form-data'
			]
		];

		try {
			$result = $client->request('GET', $endpoint, $headers);
			echo $result->getBody();
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			// Menangkap error jika ada
			$err = $e->getResponse()->getBody()->getContents();
			echo $err;
		}
	}

	protected function CekGreenItem($nip)
	{
		$client = new \GuzzleHttp\Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$endpoint = "pns/".$nip."pensiun/cek-file";
		
		$headers = [
			'headers' => [
				'apiKey' => $this->config->item('X-API-KEY'),
				'Authorization' => 'Bearer '.$this->session->userdata('access_token'),
				'Accept' => 'application/json',
				'Content-Type' => 'application/json'
			]
		];

		try {
			$result = $client->request('GET', $endpoint, $headers);
			return $result->getBody();
		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			// Menangkap error jika ada
			$err = $e->getResponse()->getBody()->getContents();
			return $err;
		}
	}

	public function buatusul()
	{
		$getToken = isset($_GET['token']);
		if ($getToken) {
			$detail = $this->pensiun->getWhere('usul_pengantar', ['token' => $_GET['token']])->row();
			$usul = $this->pensiun->getWhere('usul', ['token' => $_GET['token']])->row();
		}
		
		$data = [
			'title' => 'Buat Usul Pensiun | Integrated Pensiun ASN',
			'content' => 'pages/buatusul',
			'jenis_pensiun' => $this->pensiun->getJenisPensiun(),
			'detail' => @$detail,
			'usul' => @$usul,
		];

		$this->load->view('layouts/app', $data);
	}

	public function buatpengantar()
	{
		$post = $this->input->post();

		$token = $post['token'];

		$getNip = $this->pensiun->getWhere('usul', ['token' => $token]);
		$nip = $getNip->num_rows() > 0 ? $getNip->row()->nip : '';

		// cek duplicate nomor
		$ceknomor = $this->pensiun->getWhere('usul_pengantar', ['nomor' => $post['nomor_usul']]);
		if ($ceknomor->num_rows() > 0 && $ceknomor->row()->token !== $token) {
			$msg = [
				'status' => false,
				'message' => 'Nomor Pengantar Sudah Pernah Digunakan !',
				'redirect' => null
			];
			echo json_encode($msg);
			return false;
		}

		if (!empty($token)) {
			$data = [
				'fid_jenis_usul' => $post['jenis_pensiun'],
				'nomor' => $post['nomor_usul'],
				'tanggal' => formatToSQL($post['tgl_usul']),
				'created_by_unorid' => $this->session->userdata('unker_id')
			];
			$db = $this->pensiun->update('usul_pengantar', $data, ['token' => $token]);
			$isToken = $token;
		} else {
			$data = [
				'token' => Uuid::uuid4()->toString(),
				'fid_jenis_usul' => $post['jenis_pensiun'],
				'nomor' => $post['nomor_usul'],
				'tanggal' => formatToSQL($post['tgl_usul']),
				'created_by' => $this->session->userdata('nip'),
				'created_by_unorid' => $this->session->userdata('unker_id')
			];
			$db = $this->pensiun->insert('usul_pengantar', $data);
			$isToken = $data['token'];
		}

		if ($db) {
			$msg = [
				'status' => true,
				'message' => 'Pengantar Berhasil Disimpan',
				'redirect' => base_url('/app/pensiun/buatusul?step=2&nip=' . $nip . '&token=' . $isToken)
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'Pengantar Gagal Disimpan',
				'redirect' => null
			];
		}

		echo json_encode($msg);
	}

	public function simpanasn()
	{
		$post = $this->input->post();

		if ($post['token'] === "") {
			$msg = [
				'status' => false,
				'message' => 'Pengantar Tidak Ditemukan !',
				'rediract' => null
			];
			echo json_encode($msg);
			return false;
		}

		// $cekperemajaan = postApi('http://silka.balangankab.go.id/services/pensiun/profile/cekfile', ['nip' => $post['nip']]);
		// $peremajaan = json_decode($cekperemajaan);

		// if($peremajaan->data->no_ktp === false || $peremajaan->data->no_npwp === false || $peremajaan->data->file_rekening === false || $peremajaan->data->file_ktp === false || $peremajaan->data->file_npwp === false) {
		// 	$msg = [
		// 		'status' => false,
		// 		'message' => 'Data belum diremajakan pada SILKa Online.',
		// 		'data' => $peremajaan->data
		// 	];
		// 	echo json_encode($msg);
		// 	return false;
		// }


		$cekusul = $this->pensiun->cekusulasn('usul', $post['nip'], $post['jns_pensiun']);

		// jika nip sudah ada pada database dan token tidak kosong
		if (($cekusul->num_rows() > 0 && @$cekusul->row()->token != $post['token'])) {
			$msg = [
				'status' => false,
				'message' => 'ASN Yang Bersangkutan Sudah Pernah Diusulkan Pensiun ' . @$cekusul->row()->jenis_usul . '!',
				'rediract' => null
			];
			echo json_encode($msg);
			return false;
		}

		

		$cektoken = $this->pensiun->getWhere('usul', ['token' => $post['token']]);
		if ($cektoken->num_rows() > 0) {
			$data = [
				'nip' => $post['nip'],
				'nama' => $post['nama'],
				'gelar_depan' => $post['gelar_depan'],
				'gelar_belakang' => $post['gelar_belakang'],
				'id_unit_kerja' => $post['id_unit_kerja'],
				'nama_golru' => $post['nama_golru'],
				'nama_jabatan' => $post['nama_jabatan'],
				'nama_pangkat' => $post['nama_pangkat'],
				'nama_unit_kerja' => $post['nama_unit_kerja'],
				'alamat' => $post['alamat'],
				'tgl_lahir' => $post['tgl_lahir'],
				'tmp_lahir' => $post['tmp_lahir'],
				'usia_pensiun' => $post['usia_pensiun'],
				'url_photo' => $post['url_photo'],
				'update_by' => $this->session->userdata('nip'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'token' => $post['token']
			];
			$db = $this->pensiun->update('usul', $data, $whr);
			$msg['message'] = 'Data ASN Berhasil Diperbaharui';
		} else {
			$data = [
				'token' => $post['token'],
				'nip' => $post['nip'],
				'nama' => $post['nama'],
				'gelar_depan' => $post['gelar_depan'],
				'gelar_belakang' => $post['gelar_belakang'],
				'id_unit_kerja' => $post['id_unit_kerja'],
				'nama_golru' => $post['nama_golru'],
				'nama_jabatan' => $post['nama_jabatan'],
				'nama_pangkat' => $post['nama_pangkat'],
				'nama_unit_kerja' => $post['nama_unit_kerja'],
				'alamat' => $post['alamat'],
				'tgl_lahir' => $post['tgl_lahir'],
				'tmp_lahir' => $post['tmp_lahir'],
				'usia_pensiun' => $post['usia_pensiun'],
				'url_photo' => $post['url_photo'],
				'created_by' => $this->session->userdata('nip'),
				'created_by_unorid' => $this->session->userdata('unker_id')
			];
			$db = $this->pensiun->insert('usul', $data);
			$msg['message'] = 'ASN Berhasil Ditambahkan';
		}


		if ($db) {
			$msg = [
				'status' => true,
				'rediract' => base_url('/app/pensiun/buatusul?step=3&nip=' . $post['nip'] . '&token=' . $post['token'] . '&jenis=' . $post['jns_pensiun'])
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'ASN Gagal Ditambahkan',
				'rediract' => null
			];
		}
		echo json_encode($msg);
	}

	public function kirimusulan()
	{
		$post = $this->input->post();

		$cekusul = $this->pensiun->cekusulasn('usul', $post['nip'], $post['jns_pensiun']);

		// jika nip sudah ada pada database dan token tidak kosong
		if (($cekusul->num_rows() > 0 && $cekusul->row()->token !== $post['token'])) {
			$msg = [
				'status' => false,
				'message' => 'ASN Yang Bersangkutan Sudah Pernah Diusulkan Pensiun ' . $cekusul->row()->jenis_usul . '!',
				'rediract' => null
			];
			echo json_encode($msg);
			return false;
		}

		$eviden = $post['eviden'];

		$data = [
			'url_berkas' => $eviden,
			'is_status' => 'BKPSDM'
		];

		$whr = ['token' => $post['token']];

		$db = $this->pensiun->update('usul', $data, $whr);
		if ($db) {
			$this->pensiun->update('usul_pengantar', ['is_status' => 'BKPSDM'], $whr);
			$msg = [
				'status' => true,
				'message' => 'Usulan Berhasil Dikirim',
				'rediract' => base_url('/app/inbox/usul')
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'Usulan Gagal Dikirim',
				'rediract' => null
			];
		}
		echo json_encode($msg);
	}
}
