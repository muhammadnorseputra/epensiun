<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPensiun extends CI_Model {

    public function getJenisPensiun()
    {
        return $this->db->get('usul_jenis');
    }

    public function cekusulasn($tbl,$nip,$jns) {
        $this->db->select('usul.nip,usul.token,up.fid_jenis_usul,uj.nama as jenis_usul');
        $this->db->from($tbl);
        $this->db->join('usul_pengantar as up', 'usul.token=up.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul=uj.id');
        $this->db->where('usul.nip', $nip);
        if($jns === '1') {
            $this->db->where_not_in('usul.is_status', ['SELESAI','SELESAI_ARSIP']);
            $this->db->where_not_in('up.fid_jenis_usul', ['2','3','4','5']);
        }
        $this->db->where_not_in('usul.is_status', ['SELESAI_TMS','SELESAI_BTL']);
        return $this->db->get();
    }

    public function JmlByJenis($jns) 
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->join('usul_jenis as uj', 'up.fid_jenis_usul = uj.id');
        $this->db->where('up.fid_jenis_usul', $jns);
        // $this->db->where_not_in('up.fid_jenis_usul', ['5']);
        $this->db->where_in('up.is_status', ['SELESAI','SELESAI_ARSIP']);
        return $this->db->get();
    }

    public function JmlByUsulSelesai()
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->where_in('up.is_status', ['SELESAI','SELESAI_ARSIP']);
        return $this->db->get(); 
    }

    public function JmlByUsulInbox()
    {
        $this->db->select('u.nip');
        $this->db->from('usul as u');
        $this->db->join('usul_pengantar as up', 'up.token=u.token');
        $this->db->where_in('up.is_status', ['SKPD','BKPSDM']);
        return $this->db->get(); 
    }

    private function cekValueDate($val) {
        return !empty($val) ? $val : '';
    }

    public function timeline($usul,$is_status) {
		$selected_usul = $is_status === 'SKPD' ? 'selected' : '';
		$selected_verify = $is_status === 'BKPSDM' ? 'selected' : '';
		$selected_approve = $is_status === 'TTD_SK' ? 'selected' : '';
		$selected_ttd = $is_status === 'TTD_SK' ? 'selected' : '';
		$selected_selesai = $is_status === 'SELESAI' ? 'selected' : '';
		$selected_arsip = $is_status === 'SELESAI_ARSIP' ? 'selected' : '';
		return '
		<div class="cd-horizontal-timeline loaded">
			<div class="timeline">
				<div class="events-wrapper">
					<div class="events" style="width: 100%;">
						<ol>
							<li><a href="#0" style="left: 10px;" class="'.$selected_usul.' fw-bold">Usul <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->created_at, 0, 10))) . '</span></a></li>
							<li><a href="#0" style="left: 150px;" class="'.$selected_verify.' fw-bold">Verify  <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->verify_at, 0, 10))) . '</span></a></li>
							<li><a href="#0" style="left: 300px;" class="'.$selected_approve.' fw-bold">Approve  <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->approve_at, 0, 10))) . '</span></a></li>
							<li><a href="#0" style="left: 450px;" class="'.$selected_ttd.' fw-bold">TTD SK <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->approve_at, 0, 10))) . '</span></a></li>
							<li><a href="#0" style="left: 600px;" class="'.$selected_selesai.' fw-bold">Selesai <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->approve_at, 0, 10))) . '</span></a></li>
							<li><a href="#0" style="left: 720px;" class="'.$selected_arsip.' fw-bold">Diserahkan <br> <span class="small fw-normal">' . $this->cekValueDate(@date_indo(substr($usul->arsip_at, 0, 10))) . '</span></a></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		';
	}
    
    public function insert($table, $data) 
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $whr)
    {
        $this->db->where($whr);
        return $this->db->update($table, $data);
    }

    public function getWhere($table, $whr)
    {
        return $this->db->get_where($table, $whr);
    }

    public function getWhereIn($table, $whr)
    {
        $this->db->where_in($whr);
        return $this->db->get($table);
    }

}

/* End of file Pensiun.php */

?>