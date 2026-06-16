<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{
    public function show_unauthorized(
        $message = 'Anda tidak memiliki hak akses untuk mengakses halaman ini.',
        $status_code = 401,
        $heading = '401 Unauthorized'
    ) {
        $templates_path = config_item('error_views_path');
        if (empty($templates_path)) {
            $templates_path = VIEWPATH . 'errors' . DIRECTORY_SEPARATOR;
        }

        if (is_cli()) {
            $message = "\t" . (is_array($message) ? implode("\n\t", $message) : $message);
            $template = 'cli' . DIRECTORY_SEPARATOR . 'error_general';
        } else {
            set_status_header($status_code);
            $template = 'html' . DIRECTORY_SEPARATOR . 'error_unauthorized';
        }

        if (ob_get_level() > $this->ob_level + 1) {
            ob_end_flush();
        }

        ob_start();

        include($templates_path . $template . '.php');

        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
        exit(4);
    }
}
