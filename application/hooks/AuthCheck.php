<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthCheck {

    public function check_login() {
        $ci = get_instance();
        // Daftar controller yang tidak perlu dicek session
        $allowed_controllers = array('oauth', 'auth', 'welcome', 'trackingusul');

        // Ambil nama controller yang sedang diakses
        $controller = $ci->router->fetch_class();

        // Jika controller tidak ada dalam daftar yang diizinkan, cek session
        if (!in_array($controller, $allowed_controllers)) {
            // Cek apakah session 'nip' ada dan CSRF bernilai TRUE
            if ($ci->session->userdata('nip') === null || $ci->session->userdata('nip') === '' || !$ci->session->csrf_token) {
                // Redirect ke halaman login jika tidak ada session
                return redirect(base_url('/'));
            }
        }
    }
}