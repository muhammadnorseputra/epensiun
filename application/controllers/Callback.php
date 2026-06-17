<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Callback extends CI_Controller
{
    public function index()
    {
        return $this->load->view('result-status', $this->session->userdata('sso'));
    }
}
