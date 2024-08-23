<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \PhpOffice\PhpWord\TemplateProcessor;

class Inbox extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session();
        if($this->session->userdata('level') !== 'ADMIN' && $this->session->userdata('level') !== 'USER') {
            return show_404();
        }
        $this->load->model(['ModelPensiunInbox' => 'inbox']);
    }

    public function usul()
    {
        $data = [
            'title' => 'Inbox | Integrated Pensiun ASN',
            'content' => 'pages/inbox'
        ];

        $this->load->view('layouts/app', $data);
    }

    public function getJumlahUsulByStatus() {
        $jumlah_pengantar = $this->inbox->getJumlah('usul_pengantar', ['is_status' => 'SKPD','created_by_unorid' => $this->session->userdata('unker_id')]);
        $jumlah_usul = $this->inbox->getJumlah('usul', ['is_status' => 'SKPD','created_by_unorid' => $this->session->userdata('unker_id')]);
        $jumlah_verify = $this->inbox->getJumlah('usul', ['is_status' => 'BKPSDM','created_by_unorid' => $this->session->userdata('unker_id')]);
        $jumlah_ttd = $this->inbox->getJumlah('usul', ['is_status' => 'TTD_SK','created_by_unorid' => $this->session->userdata('unker_id')]);
        $data = [
            'jumlah_pengantar' => @$jumlah_pengantar->num_rows(),
            'jumlah_usul' => @$jumlah_usul->num_rows(),
            'jumlah_verify' => @$jumlah_verify->num_rows(),
            'jumlah_ttd' => @$jumlah_ttd->num_rows(),
        ];
        $this->output->set_header('Content-Type: Application/json');
        echo json_encode($data);
    }

    public function ajax()
    {
        $db = $this->inbox->make_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($db as $r) {

            $statusNoApprove = $r->is_status === "SELESAI_TMS" ? "TMS" : "BTL";
            
            if($r->is_status === 'SKPD') {
                $status = '<span class="badge bg-secondary px-3 py-2"><i class="bi bi-check-circle-fill me-2"></i>DIUSULKAN</span>';
                $button = '<a class="btn btn-secondary btn-sm" href="'.base_url('/app/pensiun/buatusul?step=1&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-pencil"></i> <br> EDIT</a>
                <button type="button" class="btn btn-danger btn-sm" onclick="Hapus(\''.$r->token_pengantar.'\')"><i class="bi bi-trash"></i> <br> HAPUS</button>';
            } elseif($r->is_status === 'CETAK_USUL') {
                $status = '<span class="badge bg-info px-3 py-2"><i class="bi bi-printer-fill"></i> CETAK USUL</span>';
                $button = '<a class="btn btn-info btn-sm" href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-eye me-2"></i> DETAIL</a>';
            } elseif($r->is_status === 'KIRIM_USUL') {
                $status = '<span class="badge bg-info px-3 py-2"><i class="bi bi-send-check"></i> KIRIM USUL</span>';
                $button = '<a class="btn btn-info btn-sm" href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-eye me-2"></i> DETAIL</a>';
            } elseif($r->is_status === 'BKPSDM') {
                $status = '<span class="badge bg-primary px-3 py-2"><i class="bi bi-lock-fill"></i> VERIFIKASI BKPSDM</span>';
                $button = '<a class="btn btn-success btn-sm" href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-eye me-2"></i> DETAIL</a>';
            }  elseif($r->is_status === 'TTD_SK') {
                $status = '<span class="badge bg-warning px-3 py-2"><i class="bi bi-patch-check-fill"></i> MENUNGGU TTD SK</span>';
                $button = '<a class="btn btn-success btn-sm" href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-eye me-2"></i> DETAIL</a>';
            }  elseif($r->is_status === 'SELESAI_TMS' || $r->is_status === 'SELESAI_BTL') {
                $status = '<span class="badge bg-danger px-3 py-2"><i class="bi bi-x-lg me-2"></i> '.$statusNoApprove.'</span>';
                $button = '<a class="btn btn-success btn-sm" href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-pencil"></i></a>  <button onclick="DetailNotApprove(\''.$r->token_pengantar.'\')" class="btn btn-warning btn-sm" type="button"><i class="bi bi-info-circle-fill"></i></button>';
            }  else {
                $status = '';
                $button = '<a class="btn btn-secondary btn-sm" href="'.base_url('/app/pensiun/buatusul?step=1&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'"><i class="bi bi-pencil"></i> <br> EDIT</a>
                <button type="button" class="btn btn-danger btn-sm" onclick="Hapus(\''.$r->token_pengantar.'\')"><i class="bi bi-trash"></i> <br> HAPUS</button>';
            }

            $path_picture = !empty($r->url_photo) ? $r->url_photo : base_url('template/assets/images/avatar/avatar.jpg');

            $no++;
            $row = array();
            $row[] = "<strong>".$r->nomor."</strong><br>".date_indo($r->tanggal);
            $row[] = "<strong>".$r->nama_jenis."</strong> <br>".$r->keterangan;
            $row[] = '<div class="d-flex align-items-center">
                    <div>
                        <div class="avatar avatar-md">
                            <img src="' . $path_picture . '" alt="' . $r->nama . '" class="rounded-circle"/>
                        </div>
                    </div>
                    <div class="ms-3 lh-1">
                        <h5 class="mb-1">
                            <strong>' . $r->nip . '</strong> <br>
                            <a href="'.base_url('/app/pensiun/buatusul?step=3&nip='.$r->nip.'&token='.$r->token_pengantar.'&jenis='.$r->fid_jenis_usul).'" class="text-inherit">' . $r->nama . '</a>
                        </h5>
                    </div>
                </div>';

            $row[] = !empty($r->usia_pensiun) ? $r->usia_pensiun ." Tahun" : '';
            $row[] = $status;
            $row[] = $button;
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->inbox->make_count_all(),
            "recordsFiltered" => $this->inbox->make_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function cetakusul()
    {
        $token = $this->input->post('token');
        $db = $this->inbox->update('usul', ['is_status' => 'KIRIM_USUL'], ['token' => $token]);
        if($db) {
            $this->inbox->update('usul_pengantar', ['is_status' => 'KIRIM_USUL'], ['token' => $token]);
            echo json_encode(['url' => base_url("/app/inbox/print/".$token), 'status' => true, 'msg' => 'Success Created']);
        } else {
            echo json_encode(['url' => base_url("/app/inbox/usul"), 'status' => false, 'msg' => 'Proses Cetak Gagal']);
        }
    }

    public function print($token) {
        $data = $this->inbox->getUsulanPensiun($token);
        $templateProcessor = new TemplateProcessor('template/words/surat-permohonan-pensiun.docx');
        $templateProcessor->setValues([
			'NAMA_UNIT_SATKER' => ucwords(strtolower($this->session->userdata('unker'))),
            'NAMA' => namagelar($data->gelar_depan,$data->nama,$data->gelar_belakang),
            'TEMPAT_TANGGAL_LAHIR' => $data->tmp_lahir.", ".date_indo($data->tgl_lahir),
            'NIP' => polanip($data->nip),
            'PANGKAT' => $data->nama_pangkat." (". $data->nama_golru .")",
            'JABATAN' => $data->nama_jabatan,
            'NAMA_UNIT_KERJA' => $data->nama_unit_kerja,
			'ALAMAT' => $data->alamat,
            'JENIS_PENSIUN' => $data->jenis_keterangan." (". $data->jenis_nama .")",
			'USIA_PENSIUN' => $data->usia_pensiun,
			'TGL_CETAK' => date_indo(date('Y-m-d')),
            // 'TMT_PENSIUN' => mediumdate_indo($data->tmt_pensiun)
		]);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header("Content-Disposition: attachment; filename=USULPEN-".$data->nip."-".$data->nama.".docx");
		$templateProcessor->saveAs('php://output');
    }

    public function hapus()
    {
        $token = $this->input->post('token');
        $db = $this->inbox->hapus('usul_pengantar', ['token' => $token]);
        if($db)
        {
            $this->inbox->hapus('usul', ['token' => $token]);
            $msg = [
                'status' => true,
                'message' => 'Usul Berhasil Dihapus'
            ];
        } else {
            $msg = [
                'status' => false,
                'message' => 'Usul Gagal Dihapus'
            ];
        }

        echo json_encode($msg);
    }

    public function catatan() 
    {
        $token = $this->input->get('token');
        $db = $this->inbox->getCatatan('usul', ['token' => $token])->row();
        echo $db->catatan;
    }
}

/* End of file Inbox.php */
