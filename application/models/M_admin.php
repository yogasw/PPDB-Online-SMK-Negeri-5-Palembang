<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_admin extends CI_Model
{
    function show_data()
    {
        return $this->db->query("SELECT * FROM siswa");
    }

    public function getdatasiswa($nisn)
    {
        $this->db->select('*,siswa.nisn as nisnsiswa');
        $this->db->from('siswa');
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->join("nilai_usbn", 'siswa.nisn=nilai_usbn.nisn', 'left');
        $this->db->where('siswa.nisn', $nisn);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsoal()
    {
        $this->db->select('*');
        $this->db->from('core_soal');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_soal()
    {
        $this->db->select('*');
        $this->db->from('core_soal');
        $this->db->order_by('id', 'asc');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }

}