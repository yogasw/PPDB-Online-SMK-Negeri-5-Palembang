<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_pmb extends CI_Model
{
    function show_data(){
        return $this->db->query("SELECT * FROM siswa");
    }

    public function getdatasiswa($nisn)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->where('siswa.nisn', $nisn);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsoal()
    {
        $this->db->select('*');
        $this->db->from('m_soal');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }
}