<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 03/09/2018
 * Time: 14.25
 */
class M_datasiswa extends CI_Model{
    function show_datasiswa(){
        return $this->db->query("SELECT * FROM hasil");
    }
}