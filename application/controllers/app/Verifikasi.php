<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
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
		// cek session level
		if($this->session->userdata('level') !== 'ADMIN') {
			return show_404();
		}
		$this->load->model(['ModelPensiun' => 'pensiun', 'ModelPensiunVerifikasi' => 'verify']);
	}

	public function list()
	{
		$data = [
			'title' => 'Verifikasi | Integrated Pensiun ASN',
			'content' => 'pages/verifikasi',
		];

		$this->load->view('layouts/app', $data);
	}

	public function ajax()
	{
		$db = $this->verify->make_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($db as $r) {

			if ($r->is_status === 'SKPD') {
				$status = '<span class="badge bg-secondary px-3 py-2"><i class="bi bi-check-circle-fill me-2"></i>DIUSULKAN</span>';
			} elseif ($r->is_status === 'BKPSDM') {
				$status = '<span class="badge bg-primary px-3 py-2"><i class="bi bi-lock-fill me-2"></i> VERIFIKASI BKPSDM</span>';
			} elseif ($r->is_status === 'TTD_SK') {
				$status = '<span class="badge bg-warning px-3 py-2"><i class="bi bi-patch-check-fill me-2"></i> MENUNGGU TTD SK</span>';
			} elseif ($r->is_status === 'SELESAI') {
				$status = '<span class="badge bg-success px-3 py-2"><i class="bi bi-patch-check-fill me-2"></i> APPROVED</span>';
			} elseif ($r->is_status === 'SELESAI_TMS' || $r->is_status === 'SELESAI_BTL') {
				$status = '<span class="badge bg-danger px-3 py-2"><i class="bi bi-x-circle-fill me-2"></i> '.$r->is_status.'</span>';
			} else {
				$status = '';
			}

			if($r->nomor_sk !== '' && @$r->tanggal_sk !== '') {
				$detail_sk = 'Nomor : <span class="fw-bold">'.$r->nomor_sk.'</span>  Tanggal : <span class="fw-bold">'.@date_indo($r->tanggal_sk).'</span>';
			} else {
				$detail_sk = '-';
			}

			$button = '
			<div class="dropdown dropstart">
				<a class="text-muted text-primary-hover border-secondary border-primary-hover btn btn-sm"
					href="#"
					role="button"
					id="dropdownTeamOne"
					data-bs-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xxs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> Options
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
					<button class="dropdown-item" type="button" onclick="UbahStatus(\''.$r->token.'\')"><i class="bi bi-patch-check-fill text-primary me-2"></i> Verifikasi</button>
			';
			
			if($r->is_status === 'TTD_SK' || ($r->nomor_sk !== null && $r->tanggal_sk !== null)) {
				$button .= '<button class="dropdown-item" type="button" onclick="Approve(\''.$r->token.'\')"><i class="bi bi-check-circle-fill me-2 text-success"></i>Approve</button>';
			}

			if($r->is_status === 'SELESAI') {
				$button .= '<button type="button" class="dropdown-item" onclick="Arsip(\''.$r->token.'\')"><i class="bi bi-archive me-2 text-warning"></i>Arsipkan</button>';
			}

			if($r->is_status === 'SELESAI') {
				$button .= '<a class="dropdown-item" href="'.$r->url_sk.'" target="_blank"><i class="bi bi-download me-2 text-success"></i>Download SK</a>';
			}

			$button .='
				</div>
			</div>';

			$path_picture = $r->url_photo ?? base_url('template/assets/images/avatar/user-pns.png');

			$no++;
			$row = array();
			$row[] = "<strong>" . $r->nomor . "</strong><br>" . @date_indo($r->tanggal);
			$row[] = "<strong>" . $r->nama_jenis . "</strong> <br> <div>" . $r->keterangan."</div>";
			$row[] = '<div class="d-flex align-items-start">
                    <div>
                        <div class="avatar avatar-md">
                            <img src="' . $path_picture . '" alt="' . $r->nama . '" class="rounded-circle"/>
                        </div>
                    </div>
                    <div class="ms-3 lh-1">
                        <h5 class="mb-1">
                            <strong>' . $r->nip . '</strong> <br>
                            <a href="' . base_url('/app/pensiun/buatusul?step=3&nip=' . $r->nip . '&token=' . $r->token_pengantar.'&jenis='.$r->fid_jenis_usul) . '" class="text-inherit">' . $r->nama . '</a> <br>
							<span class="text-secondary">'.$r->nama_unit_kerja.'</span>
                        </h5>
                    </div>
                </div>';

			$row[] = !empty($r->usia_pensiun) ? $r->usia_pensiun . " Tahun" : '';
			$row[] = $status;
			$row[] = $detail_sk;
			$row[] = '<a href="'.$r->url_berkas.'" target="_blank" class="btn btn-sm btn-light"><i class="bi bi-link me-2"></i> Berkas</a> ('.$r->url_berkas.')';
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->verify->make_count_all(),
			"recordsFiltered" => $this->verify->make_count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function geteviden()
	{
		$client = new \GuzzleHttp\Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$nip = $this->input->get('nip');
		$endpoint = "pns/".$nip."/pensiun/cek-file";
		
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

	public function getprofileasn()
	{
		$token = $this->input->get('token');
		$db = $this->db->select('*')->from('usul')->where('token', $token)->get();
		if($db->num_rows() > 0) {
			$db->row()->nama_jenis = $this->verify->getJenisUsul($token);
			$data = [
				'status' => true,
				'message' => 'Data Ditemukan !',
				'data' => $db->row()
			];
			echo json_encode($data);
			return false;
		}

		$data = [
			'status' => false,
			'message' => 'Data Tidak Ditemukan !',
			'data' => null
		];
		echo json_encode($data);
	}

	public function ubahstatus()
	{
		$post = $this->input->post();
		
		$whr = [
			'token' => $post['token']
		];

		$tgl_meninggal = !empty($post['tglmeninggal']) ? formatToSQL($post['tglmeninggal']) : null;

		if($post['status'] === 'TTD_SK') {
			$data = [
				'is_status' => $post['status'],
				'nomor_sk' => $post['nomorsk'],
				'tanggal_sk' => formatToSQL($post['tanggalsk']),
				'tgl_meninggal' => $tgl_meninggal,
				'tmt_pensiun' => formatToSQL($post['tmt_pensiun']),
				'nama_penerima' => $post['namakeluarga'],
				'hub_keluarga' => $post['hubkeluarga'],
				'tgl_lahir_penerima' => formatToSQL($post['tgl_lahir_penerima']),
				'alamat_pensiun' => $post['alamat_pensiun'],
				'catatan' => $post['note'],
				'verify_at' => date('Y-m-d H:i:s'),
				'verify_by' => $this->session->userdata('nip')
			];
		} elseif($post['status'] === 'SELESAI_TMS' || $post['status'] === 'SELESAI_BTL') {
			$data = [
				'is_status' => $post['status'],
				'catatan' => $post['catatan'],
				'nomor_sk' => null,
				'tanggal_sk' => null,
				'tgl_meninggal' => null,
				'tmt_pensiun' => null,
				'nama_penerima' => null,
				'hub_keluarga' => null,
				'tgl_lahir_penerima' => null,
				'alamat_pensiun' => null,
				'verify_at' => date('Y-m-d H:i:s'),
				'verify_by' => $this->session->userdata('nip')
			];
		} else {
			$data = [
				'is_status' => $post['status'],
				'verify_at' => date('Y-m-d H:i:s'),
				'verify_by' => $this->session->userdata('nip')
			];
		}

		$db = $this->pensiun->update('usul', $data, $whr);
		if($db)
		{
			$this->pensiun->update('usul_pengantar', ['is_status' => $post['status']], $whr);
			$msg = [
				'status' => true,
				'message' => 'Usulan berhasil diproses'
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'Usulan gagal diproses'
			];
		}
		echo json_encode($msg);
	}

	public function approve()
	{
		$post = $this->input->post();
		
		$baseUrlApi = 'http://silka.balangankab.go.id';

		$file = $_FILES['filesk'];
		$curlFile = new \CURLFile($file['tmp_name'],$file['type'],$file['name']);
		$postapi = [
			'nip' => $post['nip'],
			'file' => $curlFile
		];

		$fileupload = Upload($baseUrlApi."/services/pensiun/upload/skpensiun",$postapi);
		$doupload = json_decode($fileupload);

		if($doupload->status === true)
		{

			$data = [
				'approve_at' => formatToSQLDateTime($post['tanggal_approve']),
				'approve_by' => $this->session->userdata('nip'),
				'url_sk' => $baseUrlApi."/fileskpensiun/".$doupload->data->orig_name,
				'is_status' => 'SELESAI'
			];

			$whr = [
				'token' => $post['token']
			];
			
			$msg = $doupload;
			$this->pensiun->update('usul', $data, $whr);
			$this->pensiun->update('usul_pengantar', ['is_status' => 'SELESAI'], $whr);
		} else {
			$msg = $doupload;
		}
		echo json_encode($msg);
	}

	public function arsipkan() 
	{
		$token = $this->input->post('token');
		$data = [
			'is_status' => 'SELESAI_ARSIP',
			'arsip_at' => formatToSQLDateTime($this->input->post('tanggal_archive')),
			'arsip_by' => $this->session->userdata('nip'),
			'diterima_oleh' => $this->input->post('tanda_penerima')
		];

		$whr = [
			'token' => $token
		];
		
		$db = $this->pensiun->update('usul', $data, $whr);
		if($db)
		{
			$this->pensiun->update('usul_pengantar', ['is_status' => 'SELESAI_ARSIP'], $whr);
			$msg = [
				'status' => true,
				'message' => 'Usulan & SK telah diarsipkan'
			];
		} else {
			$msg = [
				'status' => false,
				'message' => 'Usulan gagal diarsipkan'
			];
		}
		echo json_encode($msg);
	}
}
