<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_ppdb extends CI_Model
{
    public function getdatasiswa($nisn)
    {
        $this->db->select('*,siswa.nisn as nisnsiswa');
        $this->db->from('siswa');
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->where('siswa.nisn', $nisn);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getsoal($nisn)
    {
        if ($this->cek_nilai_mb($nisn)) {
            $this->load->model('M_ajax', 'ajax');
            $daftar_soal = $this->ajax->ambil_data_minat_bakat($nisn)[0]['list_soal'];
            $q = "SELECT * FROM core_soal WHERE id IN (" . $daftar_soal . ") ORDER BY FIELD(id," . $daftar_soal . ")";
            $query = $this->db->query($q);
            return $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('core_soal');
            $this->db->limit(5);
            $this->db->order_by('id', 'RANDOM');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    function cek_nilai_mb($nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_mb');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();

        if ($query >= 1) {
            return true;
        } else {
            return false;
        }
    }

}