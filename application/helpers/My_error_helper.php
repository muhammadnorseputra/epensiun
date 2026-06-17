<?php defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('show_unauthorized')) {
    function show_unauthorized(
        $message = 'Anda tidak memiliki hak akses untuk mengakses halaman ini.',
        $status_code = 401,
        $heading = '401 Unauthorized'
    ) {
        $EXT = &load_class('Exceptions', 'core');

        $EXT->show_unauthorized(
            $message,
            $status_code,
            $heading
        );
    }
}
