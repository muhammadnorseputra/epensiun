<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

class AuthCheck
{
    private function userInfo()
    {
        $ci = get_instance();
        $client = new Client([
            'base_uri' => $ci->config->item('BASE_API_URL') . '/' . $ci->config->item('BASE_API_PATH'), // Ganti dengan URL API Anda
            'timeout'  => $ci->config->item('TIME_OUT'), // Timeout opsional
        ]);

        $options = [
            'headers' => [
                'apiKey' => $ci->config->item('X-API-KEY'),
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'access_token' => $ci->session->userdata('access_token')
            ]
        ];

        // getAccessToken
        try {
            $promise = $client->request('POST', 'oauth/sso/userinfo', $options);
            return json_decode($promise->getBody()->getContents());
        } catch (RequestException $exception) {
            // $ci->output->set_header('Content-Type: application/json');
            return json_decode($exception->getResponse()->getBody()->getContents());
        }
    }

    public function check_login()
    {
        $ci = get_instance();
        // Daftar controller yang tidak perlu dicek session
        $allowed_controllers = array('oauth', 'auth', 'welcome', 'trackingUsul', 'cekstatus');

        // Ambil nama controller yang sedang diakses
        $controller = $ci->router->fetch_class();

        // Jika controller tidak ada dalam daftar yang diizinkan, cek session
        if (!in_array($controller, $allowed_controllers)) {
            // Cek apakah session 'nip' ada dan CSRF bernilai TRUE
            $user = $this->userInfo();

            if ($user->status === false || !$ci->session->csrf_token || $ci->session->userdata('nip') === null || $ci->session->userdata('nip') === '') {
                $data = array('nip', 'username', 'csrf_token', 'access_token', 'level');
                $ci->session->unset_userdata($data);
                // $ci->session->sess_destroy();

                $ci->session->set_tempdata([
                    'logout_title' => 'Logout',
                    'logout_message' => 'Sesi anda pada aplikasi telah berakhir (' . $user->message . ') ',
                    'logout_status' => true,
                    'logout_is' => 'danger'
                ], NULL, 60);

                return redirect(base_url('/'));
            }
        }
    }
}
