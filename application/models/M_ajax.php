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

    public function getsoal()
    {
        $this->db->select('*');
        $this->db->from('m_soal');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getjawaban($id)
    {
        $this->db->select('id,bobot,jawaban');
        $this->db->from('core_soal');
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_nilai_mb($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_mb');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();

        if ($query >= 1) {
            unset($data['nisn']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_mb', $data);
        } else {
            $this->db->insert('nilai_mb', $data);
        }
    }

    public function getwawancara($nisn)
    {
        $this->db->select('siswa.nisn,siswa.nama_lengkap,
        nilai_wawancara.penampilan_fisik,nilai_wawancara.sopan_santun,
        nilai_wawancara.prestasi_akademin,nilai_wawancara.daya_tangkap,
        nilai_wawancara.percaya_diri,,nilai_wawancara.motivasi,
        nilai_wawancara.prestasi_kerja,nilai_wawancara.emosi');
        $this->db->from('siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->join('nilai_wawancara', 'siswa.nisn = nilai_wawancara.nisn', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        log_app(print_r($query, true));
        return $query->result_array();
    }
}