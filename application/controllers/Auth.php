<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use \Firebase\JWT\SignatureInvalidException;
use \Firebase\JWT\BeforeValidException;

class Auth extends CI_Controller {

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
	 **/
	
	 public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		if($this->session->userdata('nip') != ''):
            redirect(base_url('app/dashboard'));
            return false;
        endif;
		$this->load->view('/auth');
	}
	
	public function cek_akun()
	{
		$true_token = $this->session->csrf_token;
        if($this->input->post('token') != $true_token):
            $this->output->set_status_header('403');
            $this->session->unset_userdata('csrf_token');
			echo json_encode([
				'status' => false,
				'message' => 'This request rejected'
			]);
            return false;
        endif;

		if(!empty($this->session->userdata('nip'))):
            return redirect(base_url('app/dashboard'));
        endif;

		$username = trim($this->security->xss_clean($this->input->post('username', true)));
        $password = trim($this->security->xss_clean($this->input->post('password', true)));

		$post = [
			'username' => $username,
			'password' => $password,
			'type' => $this->input->post('type', true),
		];

		$client = new \GuzzleHttp\Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$options = [
			'headers' => [
				'apiKey' => $this->config->item('X-API-KEY'),
				'Content-Type' => 'application/x-www-form-urlencoded'
			],
			'form_params' => $post
		];

		try {
			$request = $client->request('POST', 'auth', $options);
			$result = $request->getBody();
			$raw = json_decode($result);

			$access_token = $raw->data->token;

			JWT::$leeway = 60; // $leeway in seconds
			$decoded = JWT::decode($access_token, new Key("bkpsdm@6811", 'HS256'));

			if($raw->status) {
				echo json_encode([
					'status' => true,
					'message' => $raw->message,
					'redirect' => base_url('/app/dashboard')
				]);
				$data = [
					'nip' => $decoded->data->nip,
					'nama_lengkap' => $decoded->data->nama_lengkap,
					'username' => $decoded->data->user_nama,
					'level' => $decoded->data->level,
					'picture' => $decoded->data->picture,
					'tmtbup' => $decoded->data->tmtbup,
					'pangkat' => $decoded->data->pegawai->nama_pangkat,
					'jabatan' => $decoded->data->pegawai->nama_jabatan,
					'tgl_lahir' => $decoded->data->pegawai->tgl_lahir,
					'jenkel' => $decoded->data->pegawai->jenis_kelamin,
					'unker' => $decoded->data->pegawai->unker,
					'unker_id' => $decoded->data->pegawai->unker_id,
					'access_token' => $access_token
				];
				$this->session->set_userdata($data);
				return false;
			}
			
			echo $result;

		} catch (\GuzzleHttp\Exception\RequestException $e) {
			$this->output->set_header('Content-Type: application/json; charset=utf-8');
			// Menangkap error jika ada
			$err = $e->getResponse()->getBody()->getContents();
			echo $err;
		}

		// $req = postApi('http://silka.balangankab.go.id/services/v2/auth', $post);
		// $res = json_decode($req);
		
		// $access_token = $res->data->token;

		// JWT::$leeway = 60; // $leeway in seconds
		// $decoded = JWT::decode($access_token, new Key("bkpsdm@6811", 'HS256'));

		// if($res->status) {
		// 	echo json_encode([
		// 		'status' => true,
		// 		'message' => $res->message,
		// 		'redirect' => base_url('/app/dashboard')
		// 	]);
		// 	$data = [
		// 		'nip' => $decoded->data->nip,
		// 		'nama_lengkap' => $decoded->data->nama_lengkap,
		// 		'username' => $decoded->data->user_nama,
		// 		'level' => $decoded->data->level,
		// 		'picture' => $decoded->data->picture,
		// 		'tmtbup' => $decoded->data->tmtbup,
		// 		'pangkat' => $decoded->data->pegawai->nama_pangkat,
		// 		'jabatan' => $decoded->data->pegawai->nama_jabatan,
		// 		'tgl_lahir' => $decoded->data->pegawai->tgl_lahir,
		// 		'jenkel' => $decoded->data->pegawai->jenis_kelamin,
		// 		'unker' => $decoded->data->pegawai->unker,
		// 		'unker_id' => $decoded->data->pegawai->unker_id,
		// 		'access_token' => $access_token
		// 	];
		// 	$this->session->set_userdata($data);
		// 	return false;
		// }

		// echo $req;
	}

	public function forget()
	{
		$this->load->view('/forget');
	}

	public function logout()
    {
        $data = array('nip', 'username','csrf_token');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect(base_url('/'));
    }
}
