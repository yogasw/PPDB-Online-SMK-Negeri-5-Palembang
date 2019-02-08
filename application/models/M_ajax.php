<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 14.39
 */
class M_ajax extends CI_Model
{
    function hapus_siswa($nisn)
    {
        $this->db->where('nisn', $nisn);
        $this->db->delete('siswa');

        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_un');

        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_tpa');
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
            $this->db->delete('nilai_tpa');
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

    function insert_nilai_tpa($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_tpa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();

        if ($query >= 1) {
            unset($data['nisn']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_tpa', $data);
        } else {
            $this->db->insert('nilai_tpa', $data);
        }
    }



    function ambil_data_tpa($nisn)
    {
        $this->db->select('*,siswa.nisn as nisn_siswa,siswa.nama_lengkap');
        $this->db->from('siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->join('nilai_tpa', 'siswa.nisn = nilai_tpa.nisn', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function kirim_data_tpa($data, $nisn)
    {
        $this->db->select("*");
        $this->db->from('nilai_tpa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->count_all_results();
        if ($query >= 1) {
            unset($data['nisn']);
            unset($data['nama']);
            $this->db->where('nisn', $nisn);
            $this->db->update('nilai_tpa', $data);
        } else {
            unset($data['nama']);
            $this->db->insert('nilai_tpa', $data);
        }
    }

    function reset_nilai_tpa($nisn)
    {
        $this->db->where('nisn', $nisn);
        $this->db->delete('nilai_tpa');
        return true;
    }

    function aktifkan_nilai_tpa($nisn, $data)
    {
        $this->db->insert('nilai_tpa', $data);
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
        $this->db->delete('user');
        return true;
    }

    function kirim_data_admin($data, $username)
    {
        $this->db->select("*");
        $this->db->from('user');
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
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function login_admin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        if ($this->db->count_all_results() >= 1) {
            $this->db->from('user');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get();
            $hasil = $query->result_array();
            if (count($hasil) == 0) {
                return $output = array("status" => false, "msg" => "ada");
            } else {
                return $output = array("status" => true, "level" => $hasil[0]['level'], "username" => $hasil[0]['username'], "name" => $hasil[0]['name']);
            }

        } else {
            return $output = array("status" => false, "msg" => "none");
        }
    }

    function login_siswa($username, $password)
    {
        $this->db->select('*');
            $this->db->from('siswa');
            $this->db->where('nisn', $username);
        $this->db->where('tanggal_lahir', $password);
            $query = $this->db->get();
            $hasil = $query->result_array();
        if (count($hasil) >= 1) {
            $data = array(
                'username' => $hasil[0]['nisn'],
                'password' => $hasil[0]['tanggal_lahir'],
                'name' => $hasil[0]['nama_lengkap'],
                'level' => 'siswa'
            );

            $this->db->insert("user", $data);
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

    function cek_verifikasi($nisn)
    {
        $this->db->select("no_peserta");
        $this->db->from('siswa');
        $this->db->where('nisn', $nisn);
        if ($this->db->get()->row()->no_peserta == "") {
            return false;
        } else {
            return true;
        }

    }

    function no_peserta_terahir()
    {
        $this->db->select('no_peserta');
        $this->db->from('siswa');
        $this->db->order_by("no_peserta", "DESC");
        $this->db->limit(1);
        $no = $this->db->get()->row();
        if ($no->no_peserta == "") {
            return get_setting("tahun_ajaran_ppdb") . '0000';
        } else {
            return $no->no_peserta;
        }
    }

    function ganti_password($username, $password, $passowrd_baru)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->set('password', $passowrd_baru);
        $this->db->update('user');
        if ($this->db->affected_rows()) {
            return true;
            log_app("berhasil");
        } else {
            log_app("gagal");
            return false;
        }


    }

    function simpan_hasil($data)
    {
        $this->db->empty_table("hasil");
        $this->db->insert_batch('hasil', $data);
    }

    function batalkan_pengumuman()
    {
        $this->db->empty_table("hasil");
    }

}