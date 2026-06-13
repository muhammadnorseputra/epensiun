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

    public function authorize()
    {
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
        // $host = str_contains($_SERVER['HTTP_HOST'], 'localhost') ? 'http://localhost:3000' : 'https://silka-sso.vercel.app';
        $host = 'https://silka-sso.vercel.app';
        redirect("{$host}/oauth/sso/authorize?{$query_build}");
    }

    private function getAccessToken(String $code)
    {
        $client = new Client([
            'base_uri' => $this->config->item('BASE_API_URL') . '/' . $this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
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


    private function revokeAccessToken(String $userid)
    {
        $client = new Client([
            'base_uri' => $this->config->item('BASE_API_URL') . '/' . $this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
            'timeout'  => $this->config->item('TIME_OUT'), // Timeout opsional
        ]);

        $options = [
            'headers' => [
                'apiKey' => $this->config->item('X-API-KEY'),
                'Authorization' => 'Bearer ' . $this->session->userdata('access_token'),
                'Content-Type' => 'application/json'
            ],
            'query' => [
                'user_id' => $userid
            ]
        ];

        // getAccessToken
        try {
            $promise = $client->request('DELETE', 'oauth/sso/revoke_token', $options);
            return json_decode($promise->getBody()->getContents());
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody()->getContents());
        }
    }

    public function callback()
    {

        $state = $this->input->get('state');
        if (!isset($state) || $state !== $this->session->userdata('state')) {
            $data = [
                'sso' => [
                    'message' => 'State Invalid',
                    'status' => false,
                    'data' => 'State Invalid'
                ]
            ];
            $this->session->set_userdata($data);
            return redirect("/callback");
        }

        $post = [
            'code' => $this->input->get('code'),
        ];

        $client = new Client([
            'base_uri' => $this->config->item('BASE_API_URL') . '/' . $this->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
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
                if (!isset($code) && !$raw->status) {
                    // return show_error($raw->message, 401, "Unauthorized");
                    $data = [
                        'sso' => [
                            'message' => 'Code Invalid',
                            'status' => false,
                            'data' => $raw->message
                        ]
                    ];
                    return false;
                }
                // exchange access_token with code
                $access_token = $this->getAccessToken($raw->data->code);
                if (!$access_token->status) {
                    // return show_error($access_token->message, 401, "Unauthorized");
                    $data = [
                        'sso' => [
                            'message' => 'Access Token Invalid',
                            'status' => false,
                            'data' => $access_token->message
                        ]
                    ];
                    return false;
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
                        'access_token' => $access_token->access_token,
                        'sso' => [
                            'message' => 'Login Berhasil',
                            'status' => true,
                            'data' => $decoded->data->nama_lengkap
                        ]
                    ];
                    $this->session->unset_userdata(['logout_title', 'logout_message', 'logout_status', 'logout_is']);
                } catch (ExpiredException $e) {
                    // provided JWT is trying to be used after "exp" claim.
                    $data = [
                        'sso' => [
                            'message' => 'Access Token : Expired',
                            'status' => false,
                            'data' => $e->getMessage()
                        ]
                    ];
                } catch (Exception $e) {
                    // provided JWT is trying to be used after "exp" claim.
                    $data = [
                        'sso' => [
                            'message' => 'Err Nework',
                            'status' => false,
                            'data' => $e->getMessage()
                        ]
                    ];
                }
                $this->session->set_userdata($data);
                return redirect("/callback");
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
        $revoke = $this->revokeAccessToken($this->session->userdata('nip'));


        if ($revoke->status === false) {
            return show_error($revoke->message ?? 'Sesi Anda Pada Aplikasi Telah Berakhir', 400, 'Logout');
        }

        $data = array('username', 'csrf_token', 'access_token', 'level');
        $this->session->unset_userdata($data);

        $this->session->set_tempdata([
            'logout_title' => 'Logout',
            'logout_message' => $revoke->message,
            'logout_status' => true,
            'logout_is' => 'danger'
        ], NULL, 60);

        redirect(base_url('/'));
    }
}
