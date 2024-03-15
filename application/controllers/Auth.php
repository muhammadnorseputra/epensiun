<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
            show_error('This request rejected');
            return false;
        endif;

		if(!empty($this->session->userdata('nip'))):
            return redirect(base_url('app/dashboard'));
        endif;

		$username = trim($this->security->xss_clean($this->input->post('username', true)));
        $password = trim($this->security->xss_clean($this->input->post('password', true)));

		$post = [
			'type' => $this->input->post('type'),
			'username' => $username,
			'password' => $password
		];

		$req = postApi('http://silka.balangankab.go.id/services/auth/basic', $post);
		$res = json_decode($req);

		if($res->http_code === 200) {
			echo json_encode([
				'status' => true,
				'message' => $res->message,
				'redirect' => base_url('/app/dashboard')
			]);
			$data = [
				'nip' => $res->data->nip,
				'nama_lengkap' => $res->data->nama_lengkap,
				'username' => $res->data->user_nama,
				'level' => $res->data->level,
				'picture' => $res->data->picture,
				'tmtbup' => $res->data->tmtbup,
				'pangkat' => $res->data->pegawai->nama_pangkat,
				'jabatan' => $res->data->pegawai->nama_jabatan,
				'tgl_lahir' => $res->data->pegawai->tgl_lahir,
				'jenkel' => $res->data->pegawai->jenis_kelamin,
				'unker' => $res->data->pegawai->unker,
				'unker_id' => $res->data->pegawai->unker_id,
			];
			$this->session->set_userdata($data);
			return false;
		}
		echo $req;
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
