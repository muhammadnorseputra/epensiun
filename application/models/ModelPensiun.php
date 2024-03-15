<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPensiun extends CI_Model {

    public function getJenisPensiun()
    {
        return $this->db->get('usul_jenis');
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

}

/* End of file Pensiun.php */

?>