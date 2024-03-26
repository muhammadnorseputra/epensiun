<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import library dari RestController
use chriskacerguis\RestServer\RestController;

class Usul extends RestController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelApi' => 'api']);
  }

  private function cekValue($val) {
    return !empty($val) || $val !== null || $val !== "" ? $val : null;
}

  public function detail_post() {
    $nip = $this->query('nip');

    // cek apakah ada params nip pada query atau params request
    if($nip === null) {
      $this->response(
        [
          'status' => false,
          'status_color' => 'danger',
          'message' => 'Params NIP wajib ditambahkan !',
          'data' => null
        ],
        RestController::HTTP_BAD_REQUEST
      );
      return false;
    }

    // cek apakah ada params nip yang dimasukan berupa angka atau integer
    if(!is_numeric($nip)) {
      $this->response(
        [
          'status' => false,
          'status_color' => 'danger',
          'message' => 'NIP yang dimasukan tidak valid !',
          'data' => null
        ],
        RestController::HTTP_BAD_REQUEST
      );
      return false;
    }

    // jika params nip tidak kosong, maka cek di database apakah ada usulan dengan nip tersebut
    $db = $this->api->detail($nip);
    if($db->num_rows() > 0) {
      $row = $db->row();
      if($row->is_status === 'SELESAI' || $row->is_status === 'SELESAI_ARSIP'):
        $data = [
          '_id' => $row->id,
          'nip' => $row->nip,
          'nama' => $row->nama,
          'unker' => $row->nama_unit_kerja,
          'tgl_lahir' => $row->tgl_lahir,
          'tgl_meninggal' => $this->cekValue($row->tgl_meninggal),
          'jenis_pensiun' => $row->nama_jenis, 
          'keterangan_pensiun' => $row->keterangan_jenis, 
          'sk' => [
            'nomor_sk' => $row->nomor_sk,
            'tanggal_sk' => $row->tanggal_sk,
            'tmt' => $row->tmt_pensiun,
            'nama_penerima' => $row->nama_penerima,
            'tgl_lahir_penerima' => $row->tgl_lahir_penerima,
            'hubungan_keluarga' => strtolower($row->hub_keluarga),
            'alamat_pensiun' => $row->alamat_pensiun,
            'catatan' => $row->catatan
          ],
          'user' => [
            'created_at' => $row->created_at,
            'created_by' => $row->created_by,
            'update_at' => $this->cekValue($row->update_at),
            'update_by' => $this->cekValue($row->update_by),
            'verify_at' => $this->cekValue($row->verify_at),
            'verify_by' => $this->cekValue($row->verify_by),
            'approve_at' => $this->cekValue($row->approve_at),
            'approve_by' => $this->cekValue($row->approve_by),
            'arsip_at' => $this->cekValue($row->arsip_at),
            'arsip_by' => $this->cekValue($row->arsip_by)
          ]
        ];
        $response = [
          'status' => true,
          'status_color' => 'success',
          'message' => 'Usul Pensiun <strong>"'.$nip.'"</strong> '..' ditemukan pada database epensiun.',
          'data' => $data
        ];
        return $this->response($response, RestController::HTTP_OK);
      else:
        $response = [
          'status' => true,
          'status_color' => 'warning',
          'message' => 'Usul Pensiun <strong>"'.$nip.'"</strong> ditemukan pada database tetapi masih dalam tahap " . '.$row->is_status.' . " pada aplikasi epensiun.',
          'data' => null
        ];
        return $this->response($response, RestController::HTTP_BAD_REQUEST);
      endif;
    }

    // jika usulan dengan nip tidak ditemukan pada table usul database
    $this->response(
      [
        'status' => false,
        'status_color' => 'danger',
        'message' => 'Usulan "'.$nip.'" tidak ditemukan !',
        'data' => null,
      ],
      RestController::HTTP_NOT_FOUND
    );
  }
}

?>