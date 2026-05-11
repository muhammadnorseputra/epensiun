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
		$this->load->helper('statususul');
	}

	public function index()
	{
		$this->load->view('/cekstatus');
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

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('cekstatus'));
		} else {
			if ($this->input->post('captcha') !== $this->session->userdata('captcha')) {
				$this->session->set_flashdata('error', 'Kode keamanan (CAPTCHA) tidak sesuai.');
				redirect(base_url('cekstatus'));
			} else {
				// Lakukan pengecekan status usulan berdasarkan NIP
				$nip = $this->input->post('nip');
				// Logika pengecekan status usulan di sini
				$db = $this->db->select('is_status, nip, diterima_oleh, arsip_at')->from('usul')->where('nip', $nip)->get();
				if ($db->num_rows() > 0) {
					$usul = $db->row();
					$this->session->set_flashdata('success', 'Data usulan ditemukan.');
					$this->session->set_userdata('usul', $usul);
					redirect(base_url('cekstatus'));
				} else {
					$this->session->set_flashdata('error', 'Data usulan tidak ditemukan.');
					redirect(base_url('cekstatus'));
				}
			}
		}
	}
}
