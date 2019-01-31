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

        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_un');

        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_mb');
        return true;
    }

    function multi_delete($data)
    {
        foreach ($data as $val) {
            $this->db->where('nisn', $val);
            $this->db->delete('siswa');

            $this->db->where('nisn', $val);
            $this->db->delete('nilai_un');

            $this->db->where('nisn', $val);
            $this->db->delete('nilai_mb');
        }
        return true;
    }

    function city($parent_id)
    {
        $this->db->select('*');
        $this->db->from('core_city');
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('description', 'Asc');
        $query = $this->db->get();
        return $query;
    }

    function update_siswa($data)
    {
        $this->db->update_batch('siswa', $data, 'nisn');
    }

    function tambah_siswa($data)
    {
        $this->db->insert_batch('siswa', $data);
    }

    function tambah_nilai_un($data)
    {
        $this->db->insert_batch('nilai_un', $data);
    }

    function tambah_nilai_usbn($data)
    {
        $this->db->insert_batch('nilai_usbn', $data);
    }

    function getsoal()
    {
        $this->db->select('*');
        $this->db->from('m_soal');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getjawaban($id)
    {
        $this->db->select('id,bobot,jawaban');
        $this->db->from('core_soal');
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function insert_nilai_mb($data, $nisn)
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

    function getwawancara($nisn)
    {
        $this->db->select('siswa.nisn as nisn_siswa,siswa.nama_lengkap,
        nilai_wawancara.penampilan_fisik,nilai_wawancara.sopan_santun,
        nilai_wawancara.prestasi_akademin,nilai_wawancara.daya_tangkap,
        nilai_wawancara.percaya_diri,,nilai_wawancara.motivasi,
        nilai_wawancara.prestasi_kerja,nilai_wawancara.emosi');
        $this->db->from('siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->join('nilai_wawancara', 'siswa.nisn = nilai_wawancara.nisn', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_nilai_wawancara($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_wawancara');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();

        if ($query >= 1) {
            unset($data['nisn']);
            unset($data['nama']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_wawancara', $data);
        } else {
            unset($data['nama']);
            $this->db->insert('nilai_wawancara', $data);
        }
    }

    function ambil_data_psikologi($nisn)
    {
        $this->db->select('siswa.nisn as nisn_siswa,siswa.nama_lengkap,
        nilai_psikologi.kecerdasan,nilai_psikologi.kesehatan');
        $this->db->from('siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->join('nilai_psikologi', 'siswa.nisn = nilai_psikologi.nisn', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function kirim_data_psikologi($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_psikologi');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();
        if ($query >= 1) {
            unset($data['nisn']);
            unset($data['nama']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_psikologi', $data);
        } else {
            unset($data['nama']);
            $this->db->insert('nilai_psikologi', $data);
        }
    }

    function ambil_data_minat_bakat($nisn)
    {
        $this->db->select('*,siswa.nisn as nisn_siswa,siswa.nama_lengkap');
        $this->db->from('siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->join('nilai_mb', 'siswa.nisn = nilai_mb.nisn', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function kirim_data_minat_bakat($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_mb');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();
        if ($query >= 1) {
            unset($data['nisn']);
            unset($data['nama']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_mb', $data);
        } else {
            unset($data['nama']);
            $this->db->insert('nilai_mb', $data);
        }
    }

    function reset_nilai_minat_bakat($nisn)
    {
        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_mb');
        return true;
    }

    function aktifkan_nilai_minat_bakat($nisn, $data)
    {
        $this->db->insert('nilai_mb', $data);
        return true;
    }

    function cek_nisn($nisn)
    {
        $this->db->select("nisn");
        $this->db->from('siswa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();
        if ($query >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function hapus_soal($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('core_soal');
        return true;
    }

    function multi_delete_soal($values)
    {
        if (is_array($values) || is_object($values)) {
            foreach ($values as $value) {
                $this->db->where('id', $value);
                $this->db->delete('core_soal');
            }
        }

        return true;
    }

    function kirim_data_soal($data, $id)
    {
        $this->db->select("*");
        $this->db->from('core_soal');
        $this->db->where('id', $id);
        $query = $this->db->count_all_results();

        if ($query >= 1) {
            unset($data['id']);
            $this->db->where('id', $id);
            $this->db->update('core_soal', $data);
        } else {
            $this->db->insert('core_soal', $data);
        }
    }

    function ambil_data_soal($id)
    {
        $this->db->select('*');
        $this->db->from('core_soal');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function hapus_admin($username)
    {
        $this->db->where('username', $username);
        $this->db->delete('admin');
        return true;
    }

    function kirim_data_admin($data, $username)
    {
        $this->db->select("*");
        $this->db->from('admin');
        $this->db->where('username', $username);
        $query = $this->db->count_all_results();


        if ($query >= 1) {
            unset($data['username']);
            $this->db->where('username', $username);
            $this->db->update('admin', $data);
        } else {
            $this->db->insert('admin', $data);
        }
    }

    function ambil_data_admin($username)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function login_admin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        if ($this->db->count_all_results() >= 1) {
            $this->db->from('admin');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get();
            $hasil = $query->result_array();
            return $output = array("status" => true, "level" => "admin", "username" => $hasil[0]['username'], "name" => $hasil[0]['name'], "jurusan" => $hasil[0]['jurusan']);
        } else {
            return $output = array("status" => false);
        }
    }

    function login_siswa($username, $password)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('nisn', $username);
        if ($this->db->count_all_results() >= 1) {
            $this->db->from('siswa');
            $this->db->where('nisn', $username);
            $query = $this->db->get();
            $hasil = $query->result_array();
            return $output = array("status" => true, "level" => "siswa", "username" => $hasil[0]['nisn'], "name" => $hasil[0]['nama_lengkap'], "jurusan" => $hasil[0]['jurusan']);
        } else {
            return $output = array("status" => false);
        }
    }

    function ambil_data_pengaturan($id)
    {
        $this->db->select('*');
        $this->db->from('pengaturan');
        $this->db->where('nama_pengaturan', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function kirim_data_pengaturan($data, $id)
    {
        $this->db->select("*");
        $this->db->from('pengaturan');
        $this->db->where('nama_pengaturan', $id);

        $query = $this->db->count_all_results();
        if ($query >= 1) {
            $this->db->where('nama_pengaturan', $id);
            $this->db->update('pengaturan', $data);
        } else {
            $this->db->insert('pengaturan', $data);
        }
    }

}