<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class CekStatus extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
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
        $this->load->helper('statususul');
        $this->load->helper('rate_limit');
    }

    public function index()
    {
        $this->load->view('cekstatus');
    }

    public function getImageCaptcha()
    {
        // Will build phrases of 5 characters, only digits
        $phraseBuilder = new PhraseBuilder(5, '0123456789');

        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $this->session->set_userdata('captcha', $builder->getPhrase());
        header("Content-type: image/jpeg");
        echo $builder
            ->build()
            ->output();
    }

    public function docek()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|max_length[18]|min_length[18]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|trim|numeric');

        $identifiers = [
            'ip:' . $this->input->ip_address()
        ];
        $max_attempts = 3;
        $block_minutes = 1;

        // Cek blokir rate-limit sebelum memproses
        if ($block = rate_limit_check($identifiers, $max_attempts, $block_minutes)) {
            $this->session->set_flashdata('error', rate_limit_message($block));
            $this->index();
            return;
        }

        if ($this->form_validation->run() == false) {
            rate_limit_fail($identifiers, $max_attempts, $block_minutes);
            $this->session->set_flashdata('error', validation_errors());
            $this->index();
        } else {
            if ($this->input->post('captcha') !== $this->session->userdata('captcha')) {
                rate_limit_fail($identifiers, $max_attempts, $block_minutes);
                $this->session->set_flashdata('error', 'Kode keamanan (CAPTCHA) tidak sesuai.');
                $this->index();
            } else {
                // Lakukan pengecekan status usulan berdasarkan NIP
                $nip = $this->input->post('nip');
                // Logika pengecekan status usulan di sini
                $db = $this->db->select('is_status, nip, diterima_oleh, arsip_at')->from('usul')->where('nip', $nip)->get();
                if ($db->num_rows() > 0) {
                    $usul = $db->row();
                    rate_limit_reset($identifiers);
                    $this->session->set_flashdata('success', 'Data usulan ditemukan.');
                    $this->session->set_userdata('usul', $usul);
                    $this->index();
                } else {
                    rate_limit_fail($identifiers, $max_attempts, $block_minutes);
                    $this->session->set_flashdata('error', 'Data usulan tidak ditemukan.');
                    $this->index();
                }
            }
        }
    }
}