<?php
defined('BASEPATH') || exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use \GuzzleHttp\Exception\RequestException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

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
        $state = Uuid::uuid7()->toString();
        $this->session->set_userdata(['state' => $state]);

        $query = [
            'client_name' => 'SimpunASN',
            'client_id' => '0194cb1f-fa3f-7dc3-a78e-85bf30f85ddf',
            'redirect_uri' => base_url("/oauth/sso/callback"),
            'response_type' => 'code',
            'state' => $state
        ];
        $query_build = http_build_query($query);
        $host = "https://silka-sso.vercel.app";
        // $host = "http://localhost:3000";
        redirect("{$host}/oauth/sso/authorize?{$query_build}");
    }
    
    private function getAccessToken(String $code)
    {
        $client = new Client([
			'base_uri' => $this->config->item('BASE_API_URL').'/'.$this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
    		'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
		]);

		$options = [
			'headers' => [
				'apiKey' => $this->config->item('X-API-KEY'),
			],
            'json' => [
                'code' => $code
            ]
		];

        // getAccessToken
        try {
            $promise = $client->request('POST', 'oauth/sso/access_token', $options);
            return json_decode($promise->getBody()->getContents());
        } catch (RequestException $exception) {
            $this->output->set_header('Content-Type: application/json');
            return $exception->getResponse()->getBody()->getContents();
        }
        
    }

    public function callback() {

        $state = $this->input->get('state');
        if(!isset($state) || $state !== $this->session->userdata('state'))
        {
            $this->output->set_header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'message' => 'State tidak sesuai'
            ]);
            return false;
        }

        $post = [
            'code' => $this->input->get('code'),
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
                if(!isset($code) && !$raw->status) {
                    return show_error($raw->message, 401, "Unauthorized");
                }
                // exchange access_token with code
                $access_token = $this->getAccessToken($raw->data->code);
                if(!$access_token->status) {
                    return show_error($access_token->message, 401, "Unauthorized");
                }

                // decoded access_token
                try {
                    JWT::$leeway = 60; // $leeway in seconds
                    $decoded = JWT::decode($access_token->access_token, new Key($this->config->item('SECRET_KEY'), 'HS256'));

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
                        'access_token' => $access_token->access_token
                    ];
                    $this->session->set_userdata($data);
                    return redirect("/");
                } catch (ExpiredException $e) {
                    // provided JWT is trying to be used after "exp" claim.
                    $this->output->set_header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($e);
                }
            },
            function (RequestException $exception) {
                $this->output->set_header('Content-Type: application/json; charset=utf-8');
                $err = $exception->getResponse()->getBody()->getContents();
                echo $err;
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