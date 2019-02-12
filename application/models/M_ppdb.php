<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_ppdb extends CI_Model
{
    function getdatasiswa($nisn)
    {
        $this->db->select('*,siswa.nisn as nisnsiswa');
        $this->db->from('siswa');
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->join("nilai_usbn", 'siswa.nisn=nilai_usbn.nisn', 'left');
        $this->db->where('siswa.nisn', $nisn);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getsoal($nisn)
    {
        $id_mapel = array(4,3,2,1);
        $limit    = array(25,20,30,25);
        if ($this->cek_nilai_tpa($nisn)) {
            $this->load->model('M_ajax', 'ajax');
            $daftar_soal = $this->ajax->ambil_data_tpa($nisn)[0]['list_soal'];
            $q = "SELECT * FROM core_soal WHERE id IN (" . $daftar_soal . ") ORDER BY FIELD(id," . $daftar_soal . ")";
            $query = $this->db->query($q);
            return $query->result_array();
        } else {
            $hasil = array();
            foreach ($id_mapel as $id => $isi) {
                $this->db->select("*");
                $this->db->from("core_soal");
                $this->db->where("id_mapel", $isi);
                $this->db->order_by("id", "RANDOM");
                $this->db->limit($limit[$id]);
                $hasil = array_merge($hasil, $this->db->get()->result_array());
            }
            return $hasil;
        }
    }

    function cek_nilai_tpa($nisn)
    {
        $q = "SELECT COUNT(list_soal) AS numrows FROM nilai_tpa WHERE nisn = " . $nisn;
        $query = $this->db->query($q);
        $hasil = $query->result_array()[0]['numrows'];
        if ($hasil >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function cek_soal_status($nisn)
    {
        $this->db->select("status");
        $this->db->from('nilai_tpa');
        $this->db->where('nisn', $nisn);
        $this->db->where('status', "1");
        $query = $this->db->count_all_results();
        if ($query >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function lihat_nilai($nisn)
    {
        $this->db->select('*');
        $this->db->from('nilai_tpa');
        $this->db->where('nisn', $nisn);
        $this->db->limit(1);
        return $nilai = $this->db->get()->row();
    }

    function lihat_hasil($nisn)
    {
        $this->db->select("*");
        $this->db->from("hasil");
        $this->db->where("nisn", $nisn);
        return $this->db->get()->row();
    }

    function test_acak_soal(){


        log_app(print_r($hasil,true));
        print_r(count($hasil));
    }
}