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
            return 0;
        } else {
            return $waktu1 - $waktu2;
        }
    }
}

/**
 * indo_date
 * @return string
 */
if (!function_exists('indo_date')) {
    function indo_date($date)
    {
        if (is_valid_date($date)) {
            $parts = explode("-", $date);
            $result = $parts[2] . ' ' . bulan($parts[1]) . ' ' . $parts[0];
            return $result;
        }
        return '';
    }
}

/**
 * is_valid_date
 * @return string
 */
if (!function_exists('is_valid_date')) {
    function is_valid_date($date)
    {
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
            return checkdate($parts[2], $parts[3], $parts[1]) ? true : false;
        }
        return false;
    }
}

/**
 * bulan
 * @return string
 */
if (!function_exists('bulan')) {
    function bulan($key = '')
    {
        $data = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'Nopember',
            '12' => 'Desember',
        ];
        return $key === '' ? $data : $data[$key];
    }
}

/**
 * get_setting
 * @return string
 */
if (!function_exists('get_setting')) {
    function get_setting($string)
    {
        $CI = get_instance();
        $CI->load->model('m_ajax');
        return $CI->m_ajax->ambil_data_pengaturan($string)[0]['isi'];
    }
}

/**
 * is_text
 * @return boolean
 */

if (!function_exists('is_text')) {
    function is_text($string)
    {
        $myString = str_replace(' ', '', $string);
        if (!isset($string)) {
            return false;
        } elseif (ctype_alpha($myString)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * is_text
 * @return boolean
 */

if (!function_exists('is_nomor')) {
    function is_nomor($string)
    {
        log_app("masuk" . $string);
        if ($string == "" || $string == " ") {
            return false;
        } elseif (ctype_digit($string)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * get_setting
 * @return string
 */
if (!function_exists('sort_arr_of_obj')) {
    function sort_arr_of_obj($array, $sortby, $direction = 'asc')
    {

        $sortedArr = array();
        $tmp_Array = array();

        foreach ($array as $k => $v) {
            $tmp_Array[] = strtolower($v->$sortby);
        }

        if ($direction == 'asc') {
            asort($tmp_Array);
        } else {
            arsort($tmp_Array);
        }

        foreach ($tmp_Array as $k => $tmp) {
            $sortedArr[] = $array[$k];
        }

        return $sortedArr;

    }
}

/**
 * get_setting
 * @return array
 */
if (!function_exists('spk_smart')) {
    function spk_smart($array_nilai, $array_bobot)
    {
        /** kriteria Nilai Rapot, Nilai Potensial Akademik */

        /**
         * Bobot Yang di tentukan,
         */

        /**
         * Menormalisasi Bobot
         */
        $normalisasi = [];
        foreach ($array_bobot as $isi) {
            array_push($normalisasi, ($isi / array_sum($array_bobot)));
        }


        /**
         * Menghitung Total Nilai
         */
        $hasil = 0;
        foreach ($array_nilai as $key => $val) {
            $hasil = $hasil + ($val * $normalisasi[$key]);
        }

        return $hasil;
    }
}

if (!function_exists('get_name_jurusan')) {
    function get_name_jurusan($kd_jurusan)
    {
        /** @var  $status array ket : akuntansi, administrasiperkantoran, pemasaran, animasi, , tp4 */
        $hasil = null;
        log_app(print_r($kd_jurusan), true);
        switch (strtolower($kd_jurusan)) {
            case 'akuntansi' :
                $hasil = 'AKUNTANSI DAN KEUANGAN LEMBAGA';
                break;
            case  'administrasiperkantoran' :
                $hasil = 'OTOMATISASI DAN TATA KELOLA PERKANTORAN';
                break;
            case 'pemasaran' :
                $hasil = 'BISNIS DARING DAN PEMASARAN';
                break;
            case 'animasi' :
                $hasil = 'ANIMASI';
                break;
            case 'multimedia' :
                $hasil = 'MULTIMEDIA';
                break;
            case 'tp4':
                $hasil = 'TEKNIK PRODUKSI PENYIARAN PROGRAM PERTELEVISIAN';
                break;
            default :
                $hasil = false;
                break;
        }

        return $hasil;
    }
}


