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
        if (ENVIRONMENT == 'production') {

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
        if (ENVIRONMENT == 'production') {

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
    function spk_smart($nilai_un, $nilai_usbn, $nilai_tpa)
    {

        /**
         * Langkah 1 : Menentukan Jumlah Kriteria dari Setiap Keputusan
         *
         * kriteria : NIlai UN, NIlai USBN, NIlai TPA
         *
         */
            $c_un = null;
            $c_usbn = null;
            $c_tpa = null;

        /**
         * Langkah 2 :  sistem secara default memberikan skala 0-100
         * berdasarkan prioritas yang telah diinputkan kemudian dilakukan normalisasi.
         * untuk mencari Wj
         */
            $c_un = 45;
            $c_usbn = 25;
            $c_tpa = 15;
            $c_total = $c_un + $c_usbn + $c_tpa;

            //Normalisasi dengan rumus Wj/ΣWj
            $wj_un = $c_un/$c_total;
            $wj_usbn = $c_usbn/$c_total;
            $wj_tpa = $c_tpa/$c_total;

        /**
         * Langkah 3 :  memberikan nilai kriteria untuk setiap alternatif.
         */
            $n_un = $nilai_un;
            $n_usbn = $nilai_usbn;
            $n_tpa = $nilai_tpa;

        /**
         * hitung nilai utility untuk setiap kriteria masing-masing.
         * Ui(ai) = 100*((Cmax-Cout i) / (Cmax-Cmin))
         */
            $u_un = 100*((100-$n_un)/100-0);
            $u_usbn = 100*((100-$n_usbn)/100-0);
            $u_tpa = 100*((100-$n_tpa)/100-0);

        /**
         * Langkah 5: hitung nilai akhir masing-masing.
         * U(ai) = Σ m j=1 Wj*Ui(ai)
         */
            $h_un = $wj_un * $u_un;
            $h_usbn = $wj_usbn * $u_usbn;
            $h_tpa = $wj_tpa * $u_tpa;

            $hasil_ahir  = $h_un + $h_usbn + $h_tpa;

            $simulasi = array (
                "C1"=>"Nilai UN",
                "C2"=>"Nilai USBN",
                "C3"=>"Nilai TPA",
                "Bobot C1 "=> $wj_un,
                "Bobot C2 "=> $wj_usbn,
                "Bobot C3 "=> $wj_tpa,
                "Isi Nilai C1 "=> $n_un,
                "Isi Nilai C2 "=> $n_usbn,
                "Isi Nilai C3 "=> $n_tpa,
                "Utility C1 "=> $u_un,
                "Utility C2 "=> $u_usbn,
                "Utility C3 "=> $u_tpa,
                "Wj*Ui(ai) C1" => $h_un,
                "Wj*Ui(ai) C2" => $h_usbn,
                "Wj*Ui(ai) C3" => $h_tpa,
                "Hasil Ahir" => $hasil_ahir
            );
        return $hasil_ahir;
    }

}

if (!function_exists('get_name_jurusan')) {
    function get_name_jurusan($kd_jurusan)
    {
        /** @var  $status array ket : akuntansi, administrasiperkantoran, pemasaran, animasi, , tp4 */
        $hasil = null;
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

/** pilihan warna : default, primary, info, success, warning, danger, rose */
if (!function_exists('rubah_warna')) {
    function rubah_warna()
    {
        echo "success";
    }
}

/** pilihan warna : default, primary, info, success, warning, danger, rose */
if (!function_exists('rubah_warna2')) {
    function rubah_warna2()
    {
        echo "primary";
    }
}

/** pilihan warna : default, primary, info, success, warning, danger, rose */
if (!function_exists('rubah_warna3')) {
    function rubah_warna3()
    {
        echo "warning";
    }
}

/** pilihan warna : default, primary, info, success, warning, danger, rose */
if (!function_exists('rubah_warna4')) {
    function rubah_warna4()
    {
        echo "danger";
    }
}

