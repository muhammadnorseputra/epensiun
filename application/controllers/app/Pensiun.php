<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

	public function apitest()
	{
		$req = postApi('http://silka.balangankab.go.id/services/pensiun/profile', ['nip' => '197812042005012009']);
		echo $req;
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
		$nip = $this->input->post('nip');
		$db = $this->pensiun->getWhere('usul', ['nip' => $nip]);
		$template = "";
		if ($db->num_rows() > 0) {
			$usul = $db->row();
			if($usul->is_status === 'SKPD') {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									Usulan Masih Dalam Tahap "<strong>DIUSULKAN SKPD</strong>"
								</div>
							</div>';
			} elseif ($usul->is_status === 'BKPSDM') {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									<div class="d-flex flex-column justify-content-center align-items-center gap-3">
									<img src="'.base_url('template/assets/images/svg/verify.svg').'" class="w-75 w-md-50 rounded mb-6" alt="Verify Status">
									<h3>TAHAP VERIFIKASI</h3>
									<span>Usulan Masih Dalam Tahap "<strong>VERIFIKASI BKPSDM</strong>"</span>
									</div>
								</div>
							</div>';
			} elseif($usul->is_status === 'SELESAI') {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									Usulan Pensiun Telah "<strong>SELESAI & SK Sudah Terbit</strong>". <br> Silahkan Ke Kantor BKPSDM untuk pengambilan SK
								</div>
							</div>';
			} elseif($usul->is_status === 'TTD_SK') {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									Usulan Pensiun masih dalam tahap menunggu "<strong>TTD BUPATI BALANGAN</strong>"
								</div>
							</div>';
			} elseif($usul->is_status === 'SELESAI_ARSIP') {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									SK Telah Diterima Yang Bersangkutan
								</div>
							</div>';
			} else {
				$template .= '<div class="card shadow-none border">
								<div class="card-body">
									Ops, usulan sepertinya <strong>Tidak Memenuhi Syarat</strong> atau <strong>Berkas Tidak Lengkap</strong>. <br> Silahkan hubungi SKPD terkait !
								</div>
							</div>';
			}

			echo json_encode($template);
			return false;
		}

		$template = 'Usulan "<strong>' . $nip . '</strong>" Tidak Ditemukan !';

		echo json_encode($template);
	}

	public function carinip()
	{
		$nip = $this->input->post('nip');
		$req = postApi('http://silka.balangankab.go.id/services/pensiun/profile', ['nip' => $nip, 'session' => $this->session->userdata('nip')]);
		echo $req;
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
				'token' => generateRandomString(18),
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
				'message' => 'Pengantar Berhasil Dibuat',
				'redirect' => base_url('/app/pensiun/buatusul?step=2&nip=' . $nip . '&token=' . $isToken)
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

		$cekusul = $this->pensiun->cekusulasn('usul', $post['nip'], $post['jns_pensiun']);

		// jika nip sudah ada pada database dan token tidak kosong
		if (($cekusul->num_rows() > 0 && $cekusul->row()->token !== $post['token'])) {
			$msg = [
				'status' => false,
				'message' => 'ASN Yang Bersangkutan Sudah Pernah Diusulkan Pensiun '.$cekusul->row()->jenis_usul.'!',
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
				'rediract' => base_url('/app/pensiun/buatusul?step=3&nip=' . $post['nip'] . '&token=' . $post['token'])
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
				'message' => 'ASN Yang Bersangkutan Sudah Pernah Diusulkan Pensiun '.$cekusul->row()->jenis_usul.'!',
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
