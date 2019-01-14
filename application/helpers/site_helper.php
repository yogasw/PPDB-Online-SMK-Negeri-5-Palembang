<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 12/12/2018
 * Time: 23.03
 */

if ( ! function_exists('log_all'))
{
    function log_all()
    {
        log_message('error', "________________________________________________ START LOG ________________________________________________");
        $log1 = print_r(apache_request_headers(), true);
        $log2 = ($_SERVER['REQUEST_METHOD']);
        $log3 = print_r($_REQUEST, true);
        $log4 = print_r(apache_response_headers(), true);
        log_message('error', "________________________________________________  REQUEST   ________________________________________________");
        log_message('error', $log1);
        log_message('error', $log2 . " = " . $log3 . " ");
        log_message('error', "________________________________________________  REPONSE   ________________________________________________");
        log_message('error', $log4);
        log_message('error', '________________________________________________  END LOG  ________________________________________________');

    }
}

if ( ! function_exists('log_app'))
{
    function log_app($string)
    {
       log_message('error',$string);

    }
}

if ( ! function_exists('description_lokasi')) {
    function description_lokasi($id)
    {
        log_app($id);
        if ($id=="") {
            return ("...");
        } else {
            $ci =& get_instance();
            $ci->db->select('description');
            $ci->db->from('core_city');
            $ci->db->where("id", $id);
            $ci->db->limit(1);
            $query = $ci->db->get();
            $hasil = $query->row();
            return ($hasil->description);
        }
    }
}

if ( ! function_exists('bitly')) {
    function bitly($link)
    {
        log_app($link);
        $api = "http://api.bitly.com/v3/shorten?login=mryoga12345&apiKey=R_68b7f7e7f55c41fcbfbcf9f6c76b5fe0&longUrl=" . $link;
        $result = json_decode(file_get_contents($api), true);
        $status_code = ($result['status_code']);
        $url = ($result['data']['url']);
        if ($status_code == '200') {
            return $url;
        } else {
            log_app(print_r($result,true));
            return false;

        }
    }
}
if ( ! function_exists('hash_ci')) {
    function hash_ci($string)
    {
     return md5(sha1($string));
    }
}