<?php
defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use \GuzzleHttp\Exception\RequestException;
class Oauth extends CI_Controller
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

        $this->load->helper('cookie');
	}

    public function authorize() {
        $query = [
            'client_name' => 'epensiun',
            'client_id' => '0194cb1f-fa3f-7dc3-a78e-85bf30f85ddf',
            'redirect_uri' => base_url("/oauth/sso/callback"),
            'response_type' => 'code'
        ];
        $query_build = http_build_query($query);
        redirect("http://localhost:3000/oauth/sso/authorize?".$query_build);
    }

    public function userinfo()
    {

    }

    public function callback() {


        $post = [
            'code' => base64_decode($this->input->get('code')),
        ];

        $client = new Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$options = [
			'headers' => [
				'apiKey' => $this->config->item('X-API-KEY'),
				'Content-Type' => 'application/json'
			],
            'json' => $post
		];

        $promise = $client->postAsync('oauth/sso/code_verify', $options);
        $promise->then(
            function ($response) {
                $raw = json_decode($response->getBody()->getContents());
                if(empty($code) && !$raw->status) {
                    return show_error("Unauthorized", 401, $raw->message);
                }
                $data = [
                    'nip' => $raw->data->user->nip,
                    'nama_lengkap' => $raw->data->user->nama_lengkap,
                    'username' => $raw->data->user->user_nama,
                    'level' => $raw->data->user->level,
                    'picture' => $raw->data->user->picture,
                    'tmtbup' => $raw->data->user->tmtbup,
                    'pangkat' => $raw->data->user->pegawai->nama_pangkat,
                    'jabatan' => $raw->data->user->pegawai->nama_jabatan,
                    'tgl_lahir' => $raw->data->user->pegawai->tgl_lahir,
                    'jenkel' => $raw->data->user->pegawai->jenis_kelamin,
                    'unker' => $raw->data->user->pegawai->unker,
                    'unker_id' => $raw->data->user->pegawai->unker_id,
                    'access_token' => $raw->data->access_token
                ];
                $this->session->set_userdata($data);
                return redirect("/");
            },
            function (RequestException $exception) {
                $this->output->set_header('Content-Type: application/json; charset=utf-8');
                $err = $exception->getResponse()->getBody()->getContents();
                echo  $err;
            }
        );
        
        // Tunggu semua promise selesai (jika dalam konteks multi-request)
        Utils::settle([$promise])->wait();
    }


    public function logout()
    {
        $data = array('nip', 'username', 'csrf_token', 'access_token', 'level');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect(base_url('/'));
    }
}