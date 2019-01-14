<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_pendaftaran extends CI_Model{
    function show_data(){
        return $this->db->query("SELECT * FROM siswa");
    }

    function add_jurusan($id_jurusan, $nama_jurusan){
        return $this->db->query("INSERT INTO jurusan VALUES ('".$id_jurusan."','".$nama_jurusan."')");
    }
    function edit_jurusan($id_jurusan, $nama_jurusan){
         $query = "UPDATE jurusan SET id_jurusan ='".$id_jurusan."', nama_jurusan= '".$nama_jurusan."' WHERE id_jurusan = '".$id_jurusan."'";
         return $this->db->query($query);
    }
    function hapus_jurusan($id_jurusan){
         $query = "DELETE FROM jurusan WHERE id_jurusan = '".$id_jurusan."'";
         return $this->db->query($query);
    }
    public function getdatasiswa()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $query = $this->db->get();
        return $query->result_array();
    }
}