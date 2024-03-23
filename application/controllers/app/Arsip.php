<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session();
        $this->load->model(['ModelArsip' => 'arsip']);
    }

    public function list()
    {
        $data = [
            'title' => 'Arsip | Integrated Pensiun ASN',
            'content' => 'pages/arsip',
        ];

        $this->load->view('layouts/app', $data);
    }

    public function ajax()
    {
        $db = $this->arsip->make_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($db as $r) {

            $path_picture = !empty($r->url_photo) ? $r->url_photo : base_url('template/assets/images/avatar/avatar.jpg');
            $no++;
            $row = array();
            $row[] = "<strong>" . $r->nomor_sk . "</strong><br>" . @date_indo($r->tanggal_sk);
            $row[] = "<strong>" . $r->nama_jenis . "</strong> <br> <div class='text-nowrap'>" . $r->keterangan . "</div>";
            $row[] = '<div class="d-flex align-items-start">
                    <div>
                        <div class="avatar avatar-md">
                            <img src="' . $path_picture . '" alt="' . $r->nama . '" class="rounded-circle"/>
                        </div>
                    </div>
                    <div class="ms-3 lh-1">
                        <h5 class="mb-1">
                            <strong>' . $r->nip . '</strong> <br>
                            <a href="'.$r->url_sk.'" target="_blank" class="text-inherit">' . $r->nama . '</a> <br>
							<span class="text-secondary">' . $r->nama_unit_kerja . '</span>
                        </h5>
                    </div>
                </div>';

            $row[] = !empty($r->usia_pensiun) ? $r->usia_pensiun . " Tahun" : '';
            $row[] = '<a href="' . $r->url_berkas . '" target="_blank" class="btn btn-sm btn-light"><i class="bi bi-link me-2"></i> Berkas</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->arsip->make_count_all(),
            "recordsFiltered" => $this->arsip->make_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
        
    /* End of file  app/Arsip.php */
