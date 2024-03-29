<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class ModelArsip extends CI_Model {
                        
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
    $this->db->where_in('u.is_status', ['SELESAI_ARSIP','SELESAI_TMS','SELESAI_BTL']);
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
    $this->db->where_in('u.is_status', ['SELESAI_ARSIP','SELESAI_TMS','SELESAI_BTL']);
    return $this->db->count_all_results();
}
// -------------------------------- end-datatable --------------------------//                            
                        
}
                        
/* End of file ModelArsip.php */
    
                        