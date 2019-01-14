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
}