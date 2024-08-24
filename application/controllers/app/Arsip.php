<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek session login
		cek_session();	
		// cek session level
		if($this->session->userdata('level') !== 'ADMIN') {
			return show_404();
		}
        $this->load->model(['ModelArsip' => 'arsip', 'ModelPensiun' => 'pensiun']);
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
            $button = '
			<div class="dropdown dropstart">
				<a class="text-muted text-primary-hover border-secondary border-primary-hover btn btn-sm"
					href="#"
					role="button"
					id="dropdownTeamOne"
					data-bs-toggle="dropdown"
					aria-haspopup="true"
					aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-xxs"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> 
                    More
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
					<a target="_blank" class="dropdown-item" type="button" href="'.$r->url_berkas.'"><i class="bi bi-link text-primary me-2"></i>Berkas Usul</a>
			';

			if($r->is_status === 'SELESAI_ARSIP') {
                $button .= '<button type="button" class="dropdown-item" onclick="UnArsip(\''.$r->token.'\')"><i class="bi bi-arrow-counterclockwise me-2 text-warning"></i>Unarsip</button>';
				$button .= '<a class="dropdown-item" href="'.$r->url_sk.'" target="_blank"><i class="bi bi-download me-2 text-success"></i>Download SK</a>';
			}

			$button .='
				</div>
			</div>';

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
            $row[] = $button;
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

    public function unarchive() {
        $token = $this->input->post('token');
        $db = $this->pensiun->update('usul', ['is_status' => 'SELESAI'], ['token' => $token]);
        if($db) {
            $this->pensiun->update('usul_pengantar', ['is_status' => 'SELESAI'], ['token' => $token]);
            $msg = [
                'status' => true,
                'message' => 'Usulan berhasil di unarchive.'
            ];
        } else {
            $msg = [
                'status' => false,
                'message' => 'Usulan gagal di unarchive.'
            ];
        }
        echo json_encode($msg);
    }
}
        
    /* End of file  app/Arsip.php */
