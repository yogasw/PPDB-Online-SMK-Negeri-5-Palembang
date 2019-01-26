<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 12/12/2018
 * Time: 23.03
 */

if (!function_exists('log_all')) {
    function log_all()
    {
        if (ENVIRONMENT == 'testing') {

        } else {
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
}

if (!function_exists('log_app')) {
    /**
     * Menampilkan Log
     *
     *
     * @param   String $string Input Text
     */
    function log_app($string)
    {
        if (ENVIRONMENT == 'testing') {

        } else {
            log_message('error', $string);
        }

    }
}

if (!function_exists('description_lokasi')) {
    function description_lokasi($id)
    {

        if ($id == "") {
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

if (!function_exists('bitly')) {
    function bitly($link)
    {
        $api = "http://api.bitly.com/v3/shorten?login=mryoga12345&apiKey=R_68b7f7e7f55c41fcbfbcf9f6c76b5fe0&longUrl=" . $link;
        $result = json_decode(file_get_contents($api), true);
        $status_code = ($result['status_code']);
        $url = ($result['data']['url']);
        if ($status_code == '200') {
            return $url;
        } else {
            return false;

        }
    }
}
if (!function_exists('hash_ci')) {
    function hash_ci($string)
    {
        return md5(sha1($string));
    }
}

if (!function_exists('post_to_coma')) {
    function post_to_coma($string)
    {
        $answer = array();
        foreach ($string as $key => $value) {
            array_push($answer, $key . ":" . $value);
        }
        return rtrim(implode(',', $answer), ',');
    }
}

if (!function_exists('array_to_coma')) {
    function array_to_coma($string)
    {
        $answer = array();
        foreach ($string as $key => $value) {
            array_push($answer, $value);
        }
        return rtrim(implode(',', $answer), ',');
    }
}

if (!function_exists('jawaban_to_array')) {
    function jawaban_to_array($data)
    {
        $hasil = explode(",", $data);
        foreach ($hasil as $value) {
            $text = explode(":", $value);
            $answer[$text[0]] = $text[1];
        }

        return $answer;
    }
}


if (!function_exists('post_to_array')) {
    function post_to_array($string)
    {
        $answer = array();
        foreach ($string as $key => $value) {
            $answer[] = array("key" => $key, "value" => $value);
        }
        return $answer;
    }

}

if (!function_exists('sisa_waktu')) {

    function sisa_waktu($tgl_mulai, $tgl_selesai)
        /**
         * Menampilkan Log
         *
         *
         * @param   DateTime $tgl_mulai Waktu Mulai
         * @param   DateTime $tgl_selesai Waktu Selesai
         * @return  int
         */
    {


        //Menghitung waktu yang di berikan
        $d1 = new DateTime($tgl_mulai);
        $d2 = new DateTime($tgl_selesai);
        $interval = $d2->diff($d1);
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');
        $waktu1 = $hours * 60 + $minutes;


        //Menghitung waktu kelewat
        $d11 = new DateTime($tgl_mulai);
        $d22 = new DateTime(date('Y-m-d H:i:s'));
        $interval2 = $d22->diff($d11);
        $hours2 = $interval2->format('%h');
        $minutes2 = $interval2->format('%i');
        $waktu2 = $hours2 * 60 + $minutes2;

        if ($waktu2 > $waktu1) {
            return 60;
        } else {
            //return $waktu1 - $waktu2;
            return 60;
        }
    }
}

