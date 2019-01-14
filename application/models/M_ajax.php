<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 14.39
 */
class M_ajax extends CI_Model
{
    function hapus_siswa($nisn){
            $this->db->where('nisn', $nisn);
             $this->db->delete('siswa');
             return true;
    }
    public function city($parent_id){
        $this->db->select('*');
        $this->db->from('core_city');
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('description', 'Asc');
        $query = $this->db->get();
        return $query;
    }

    public function update_siswa($data)
    {
        $this->db->update_batch('siswa', $data, 'nisn');
    }

    public function tambah_siswa($data)
    {
        $this->db->insert_batch('siswa', $data);
    }

    public function tambah_nilai_un($data)
    {
        $this->db->insert_batch('nilai_un', $data);
    }
}