<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPensiunInbox extends CI_Model
{
    // set table
    protected $table = 'usul_pengantar AS up';
    //set column field database for datatable orderable
    protected $column_order = array(null);
    //set column field database for datatable searchable 
    protected $column_search = array('u.nip','u.nama');
    // default order 
    protected $order = array('up.id' => 'desc');
    // default select 
    protected $select_table = array('u.*','up.fid_jenis_usul','up.token AS token_pengantar','up.nomor','up.tanggal','uj.nama AS nama_jenis','uj.keterangan');

    private function _datatables()
    {

        $this->db->select($this->select_table);
        $this->db->from($this->table);
        $this->db->join('usul AS u', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where_in('up.is_status', ['SKPD','BKPSDM','TTD_SK','SELESAI_TMS','SELESAI_BTL']);
        $this->db->where('up.created_by_unorid', $this->session->userdata('unker_id'));
        $this->db->where('up.created_by', $this->session->userdata('nip'));
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if (@$_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function make_datatables()
    {
        $this->_datatables();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function make_count_filtered()
    {
        $this->_datatables();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function make_count_all()
    {
        $this->db->select($this->select_table);
        $this->db->from($this->table);
        $this->db->join('usul AS u', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where_in('up.is_status', ['SKPD','BKPSDM','TTD_SK']);
        $this->db->where('up.created_by_unorid', $this->session->userdata('unker_id'));
        $this->db->where('up.created_by', $this->session->userdata('nip'));
        return $this->db->count_all_results();
    }
    // -------------------------------- end-datatable --------------------------//

    public function TopUsulanPensiunByUnkerId()
    {
        $this->db->select('u.nama,u.nip,u.url_photo,u.is_status,u.nomor_sk,u.tanggal_sk,u.arsip_at,uj.nama AS jenis_pensiun');
        $this->db->from('usul AS u');
        $this->db->join('usul_pengantar AS up', 'u.token=up.token', 'left');
        $this->db->join('usul_jenis AS uj', 'up.fid_jenis_usul=uj.id', 'left');
        $this->db->where_in('u.is_status', ['SELESAI','SELESAI_ARSIP']);
        $this->db->where('u.created_by_unorid', $this->session->userdata('unker_id'));
        $this->db->order_by('u.id', 'desc');
        $this->db->limit(5);
        return $this->db->get();
    }

    public function getJumlah($tbl, $whr)
    {
        return $this->db->get_where($tbl, $whr);
    }

    public function getCatatan($tbl, $whr)
    {
        $this->db->select('catatan');
        $this->db->from('usul');
        $this->db->where($whr);
        $this->db->where_in('is_status', ['SELESAI_BTL','SELESAI_TMS']);
        return $this->db->get();
    }

    public function hapus($tbl, $whr) {
        $this->db->where($whr);
        return $this->db->delete($tbl);
        
    }
}

/* End of file Pensiun.php */
