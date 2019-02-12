<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 14.08
 */
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('site_helper');
        $this->load->model('m_ajax');
    }

    function ambil_data_pendaftaran()
    {

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw = $_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length = $_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start = $_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search = $_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order = $_REQUEST['order'][0]["column"];
        $dir = $_REQUEST['order'][0]["dir"];

        /*Menghitung total desa didalam database*/
        $total = $this->db->count_all_results("siswa");

        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output = array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw'] = $draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data'] = array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian*/
        if ($search != "") {
            $this->db->like("siswa.no_peserta", $search);
            $this->db->or_like('siswa.nisn', $search);
            $this->db->or_like('siswa.nama_lengkap', $search);
            $this->db->or_like('siswa.asal_sekolah', $search);
            $this->db->or_like('siswa.jurusan', $search);
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        switch ($order) {
            case 1 :
                $orderby = 'siswa.no_peserta';
                break;
            case 2 :
                $orderby = 'siswa.nisn';
                break;
            case 3 :
                $orderby = 'siswa.nama_lengkap';
                break;
            case 4 :
                $orderby = 'siswa.asal_sekolah';
                break;
            case 5 :
                $orderby = 'siswa.jurusan';
                break;
            default :
                $orderby = 'siswa.nama_lengkap';
        }
        $this->db->select('*,siswa.nisn as nisnsiswa');
        $this->db->order_by($orderby, $dir);
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->join("nilai_usbn", 'siswa.nisn=nilai_usbn.nisn', 'left');
        $filter = strtoupper($this->session->userdata("filter_jurusan"));
        if ($filter != "") {
            $this->db->where("siswa.jurusan", $filter);
        }

        $query = $this->db->get('siswa');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        if ($search != "") {
            $this->db->where("siswa.jurusan", $search);
            $this->db->or_like("siswa.no_peserta", $search);
            $this->db->or_like('siswa.nisn', $search);
            $this->db->or_like('siswa.nama_lengkap', $search);
            $this->db->or_like('siswa.asal_sekolah', $search);
            $this->db->or_like('siswa.jurusan', $search);
            $jum = $this->db->get('siswa');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            if ($filter != "") {
                if ($data['jurusan'] == $filter) {
                    $un = round(($data['ipa'] + $data['matematika'] + $data['bhs_indonesia'] + $data['bhs_inggris']) / 4, 2);
                    $usbn = round(($data['pai'] + $data['pkn'] + $data['ips']) / 3, 2);
                    $output['data'][] = array($nomor_urut, $data['no_peserta'], $data['nisnsiswa'], $data['nama_lengkap'], $data['asal_sekolah'], $data['jurusan'], $un, $usbn);
                    $nomor_urut++;
                }
            } else {
                $un = round(($data['ipa'] + $data['matematika'] + $data['bhs_indonesia'] + $data['bhs_inggris']) / 4, 2);
                $usbn = round(($data['pai'] + $data['pkn'] + $data['ips']) / 3, 2);
                $output['data'][] = array($nomor_urut, $data['no_peserta'], $data['nisnsiswa'], $data['nama_lengkap'], $data['asal_sekolah'], $data['jurusan'], $un, $usbn);
                $nomor_urut++;
            }
        }
        echo json_encode($output);
    }

    function ambil_data_pendaftaran_tpa()
    {
        $filter = strtoupper($this->session->userdata("filter_jurusan"));

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw = $_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length = $_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start = $_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search = $_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order = $_REQUEST['order'][0]["column"];
        $dir = $_REQUEST['order'][0]["dir"];

        /*Menghitung total desa didalam database*/
        $total = $this->db->count_all_results("siswa");

        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output = array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw'] = $draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data'] = array();

        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian*/
        if ($search != "") {
            $this->db->like("siswa.no_peserta", $search);
            $this->db->or_like('siswa.nisn', $search);
            $this->db->or_like('siswa.nama_lengkap', $search);
            $this->db->or_like('siswa.asal_sekolah', $search);
            $this->db->or_like('siswa.jurusan', $search);
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        switch ($order) {
            case 1 :
                $orderby = 'siswa.no_peserta';
                break;
            case 2 :
                $orderby = 'siswa.nisn';
                break;
            case 3 :
                $orderby = 'siswa.nama_lengkap';
                break;
            case 4 :
                $orderby = 'siswa.asal_sekolah';
                break;
            case 5 :
                $orderby = 'siswa.jurusan';
                break;
            default :
                $orderby = 'siswa.nama_lengkap';
        }
        $this->db->select("*,siswa.nisn as nisn_siswa");
        $this->db->order_by($orderby, $dir);
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->join("nilai_usbn", 'siswa.nisn=nilai_usbn.nisn', 'left');
        $this->db->join("nilai_tpa", 'siswa.nisn=nilai_tpa.nisn', 'left');
        if ($filter != "") {
            $this->db->where("siswa.jurusan", $filter);
        }
        $query = $this->db->get('siswa');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        if ($search != "") {
            $this->db->like("siswa.no_peserta", $search);
            $this->db->or_like('siswa.nisn', $search);
            $this->db->or_like('siswa.nama_lengkap', $search);
            $this->db->or_like('siswa.asal_sekolah', $search);
            $this->db->or_like('siswa.jurusan', $search);
            $jum = $this->db->get('siswa');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }

        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            if (isset($data['no_peserta'])) {
                {
                    if ($filter != "") {
                        if ($filter == $data['jurusan']) {
                            $this->db->where("siswa.jurusan", $filter);
                            $un = round(($data['ipa'] + $data['matematika'] + $data['bhs_indonesia'] + $data['bhs_inggris']) / 4, 2);
                            $usbn = round(($data['pai'] + $data['pkn'] + $data['ips']) / 3, 2);
                            $output['data'][] = array($data['status'], $nomor_urut, $data['no_peserta'], $data['nisn_siswa'], $data['nama_lengkap'], $data['asal_sekolah'], $data['jurusan'], $un, $usbn);
                            $nomor_urut++;
                        }
                    } else {
                        $this->db->where("siswa.jurusan", $filter);
                        $un = round(($data['ipa'] + $data['matematika'] + $data['bhs_indonesia'] + $data['bhs_inggris']) / 4, 2);
                        $usbn = round(($data['pai'] + $data['pkn'] + $data['ips']) / 3, 2);
                        $output['data'][] = array($data['status'], $nomor_urut, $data['no_peserta'], $data['nisn_siswa'], $data['nama_lengkap'], $data['asal_sekolah'], $data['jurusan'], $un, $usbn);
                        $nomor_urut++;
                    }
                }
            }
        }
        echo json_encode($output);
    }

    function hapus_siswa()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->hapus_siswa($nisn);

    }

    function data_lokasi()
    {
        header('Content-type: application/json');
        $parent_id = $_POST['parent_id'];
        if ($parent_id != "") {
            $query = $this->m_ajax->city($parent_id);
            $data = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    array_push($data, '<option value=' . $row->id . '>' . $row->description . '</option>');
                }
            }
            echo json_encode($data);
        }
    }

    function ubahdata_siswa()
    {
        header('Content-type: application/json');

        $data[] = array(
            'nama_lengkap' => strtoupper((string)$_POST['nama_lengkap']),
            'no_peserta' => (string)$_POST['no_peserta'],
            'tahun_ajaran' => (string)$_POST['tahun_ajaran'],
            'nisn' => (string)$_POST['nisn'],
            'tahun_lulus' => (string)$_POST['tahun_lulus'],
            'jurusan' => strtoupper((string)$_POST['jurusan']),
            'asal_sekolah' => strtoupper((string)$_POST['asal_sekolah']),
            'jk' => strtoupper((string)$_POST['jk']),
            'agama' => (string)$_POST['agama'],
            'tempat_lahir' => strtoupper((string)$_POST['tempat_lahir']),
            'tanggal_lahir' => (string)$_POST['tanggal_lahir'],
            'no_hp' => (string)$_POST['no_hp'],
            'email' => strtolower((string)$_POST['email']),
            'alamat' => strtoupper((string)$_POST['alamat']),
            'negara' => (string)$_POST['negara'],
            'provinsi' => (string)$_POST['provinsi'],
            'kota' => (string)$_POST['kota'],
        );

        $this->m_ajax->update_siswa($data);
        $respon = array(
            "nama_lengkap" => (string)$_POST['nama_lengkap'],
            "status" => true
        );

        echo json_encode($respon);
    }

    function verifikasi($id)
    {
        header('Content-type: application/json');

        $no_peserta = $this->m_ajax->cek_verifikasi($id);
        if ($no_peserta) {
            echo("Sudah");
        } else {
            $data[] = array(
                'nisn' => $id,
                'no_peserta' => $this->m_ajax->no_peserta_terahir() + 1
            );
            $this->m_ajax->update_siswa($data);
        }
    }

    function tambah_siswa()
    {
        header('Content-type: application/json');
        $data[] = array(
            'nama_lengkap' => strtoupper((string)$_POST['nama_lengkap']),
            //'no_peserta' => (string)$_POST['no_peserta'],
            'nisn' => (string)$_POST['nisn'],
            'tahun_ajaran' => (string)$_POST['tahun_ajaran'],
            'tahun_lulus' => (string)$_POST['tahun_lulus'],
            'jurusan' => strtoupper((string)$_POST['jurusan']),
            'asal_sekolah' => strtoupper((string)$_POST['asal_sekolah']),
            'jk' => (string)$_POST['jk'],
            'agama' => (string)$_POST['agama'],
            'tempat_lahir' => strtoupper((string)$_POST['tempat_lahir']),
            'tanggal_lahir' => (string)$_POST['tanggal_lahir'],
            'no_hp' => (string)$_POST['no_hp'],
            'email' => strtolower((string)$_POST['email']),
            'alamat' => strtoupper((string)$_POST['alamat']),
            'negara' => (string)$_POST['negara'],
            'provinsi' => (string)$_POST['provinsi'],
            'kota' => (string)$_POST['kota']
        );
        $nilai_un[] = array(
            'nisn' => (string)$_POST['nisn'],
            'ipa' => (string)$_POST['nilai_ipa'],
            'matematika' => (string)$_POST['nilai_matematika'],
            'bhs_indonesia' => (string)$_POST['nilai_bhs_indonesia'],
            'bhs_inggris' => (string)$_POST['nilai_bhs_inggris']
        );
        $nilai_usbn[] = array(
            'nisn' => (string)$_POST['nisn'],
            'pai' => (string)$_POST['nilai_pai'],
            'pkn' => (string)$_POST['nilai_pkn'],
            'ips' => (string)$_POST['nilai_ips']
        );
        $error = [];

        foreach ($data[0] as $data_key => $data_isi) {
            if ($data_key == "nama_lengkap" && !is_text($data_isi)) {
                $error[] = "Isi Form Nama huruf a-z";
            } elseif ($data_key == "nisn" && !is_nomor($data_isi)) {
                $error[] = "Isi Form NISN dengan angka";
            } elseif ($data_key == "tahun_ajaran" && !is_nomor($data_isi)) {
                $error[] = "Isi Form Tahun Ajaran dengan angka";
            } elseif ($data_key == "tahun_lulus" && !is_nomor($data_isi)) {
                $error[] = "Isi Form NISN dengan angka";
            } elseif ($data_key == "jurusan" && $data_isi == "") {
                $error[] = "Isi Form Terlebih dahulu jurusan";
            } elseif ($data_key == "asal_sekolah" && $data_isi == "") {
                $error[] = "Isi Form Asal Sekolah";
            } elseif ($data_key == "jk" && $data_isi == "") {
                $error[] = "Isi Form Jenis Kelamin";
            } elseif ($data_key == "agama" && $data_isi == "") {
                $error[] = "isi Form Agama";
            } elseif ($data_key == "tempat_lahir" && $data_isi == "") {
                $error[] = "Isi Form Tempat Lahir";
            } elseif ($data_key == "no_hp" && !is_nomor($data_isi)) {
                $error[] = "Isi Form No HP. dengan angka";
            } elseif ($data_key == "alamat" && $data_isi == "") {
                $error[] = "Isi Form Alamat";
            } elseif ($data_key == "provinsi" && $data_isi == "") {
                $error[] = "Isi Form Provinsi";
            } elseif ($data_key == "negara" && $data_isi == "") {
                $error[] = "Isi Form Negara";
            } elseif ($data_key == "kota" && $data_isi == "") {
                $error[] = "Isi Form Kota";
            }
        }
        foreach ($nilai_un[0] as $un_key => $un_isi) {
            if ($un_key == "ipa" && !is_nomor($un_isi)) {
                $error[] = "Isi Form Nilai IPA dengan angka";
            } elseif ($un_key == "matematika" && !is_nomor($un_isi)) {
                $error[] = "Isi Form Nilai Matematika dengan angka";
            } elseif ($un_key == "bhs_indonesia" && !is_nomor($un_isi)) {
                $error[] = "Isi Form Nilai Bahasa Indonesia dengan angka";
            } elseif ($un_key == "bhs_inggris" && !is_nomor($un_isi)) {
                $error[] = "Isi Form Nilai Bahasa Inggris dengan angka";
            }
        }
        foreach ($nilai_usbn[0] as $usbn_key => $usbn_isi) {
            if ($usbn_key == "pai" && !is_nomor($usbn_isi)) {
                $error[] = "Isi Form Nilai PAI dengan angka";
            } elseif ($usbn_key == "pkn" && !is_nomor($usbn_isi)) {
                $error[] = "Isi Form Nilai PKN dengan angka";
            } elseif ($usbn_key == "ips" && !is_nomor($usbn_isi)) {
                $error[] = "Isi Form Nilai IPS dengan angka";
            }
        }

        if (count($error) >= 1) {

            $respon = array(
                "status" => false,
                "log" => implode("<br>", $error)

            );
        } else {
            $respon = array(
                "nama_lengkap" => (string)$_POST['nama_lengkap'],
                "status" => true,
                "log" => "Berhasil"
            );
            $this->m_ajax->tambah_nilai_usbn($nilai_usbn);
            $this->m_ajax->tambah_nilai_un($nilai_un);
            $this->m_ajax->tambah_siswa($data);
        }


        echo json_encode($respon);
    }

    function kirim_data_tpa()
    {
        //Deklarasi variable
        $nisn = $this->session->userdata('username');
        $jumlah_benar = 0;
        $nilai = 0;
        $status = "1";
        $jawaban = $_POST;
        //mengambil id soal, id mapel, jawaban
        $this->load->model('m_ppdb');
        $soal = $this->m_ppdb->getsoal($nisn);
        foreach ($soal as $value) {
            $kunci_jawaban[$value['id']] = array(
                'id_mapel' => $value['id_mapel'],
                'jawaban' => $value['jawaban']
            );
        }

        //mencocokan jawaban dengan kuci jawaban
        foreach ($jawaban as $key => $value) {
            if ((strtolower($kunci_jawaban[$key]['jawaban'])) == strtolower($value)) {
                $nilai = $nilai + 1;
                $jumlah_benar = $jumlah_benar + 1;
                //$jumlah_bobot = $jumlah_bobot + $benar->bobot;
            }
        }


        $data = array(
            'nisn' => $nisn,
            'list_jawaban' => post_to_coma($_POST),
            'jml_benar' => $jumlah_benar,
            'nilai' => $nilai,
            //'nilai_bobot' => $jumlah_bobot,
            'tgl_mulai' => date('Y-m-d H:i:s'),
            'tgl_selesai' => $date = date('Y-m-d H:i:s'),
            'status' => $status
        );

        $this->m_ajax->insert_nilai_tpa($data, $nisn);
    }

    function ambil_data_wawancara()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->m_ajax->getwawancara($nisn);
        print_r(json_encode($data));
    }

    function kirim_data_wawancara()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->insert_nilai_wawancara($_POST, $nisn);
    }

    function ambil_data_psikologi()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->m_ajax->ambil_data_psikologi($nisn);
        print_r(json_encode($data));
    }

    function kirim_data_psikologi()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->kirim_data_psikologi($_POST, $nisn);
    }

    function multi_delete()
    {
        $answer = $_POST;
        $answer = array();
        foreach ($_POST as $key => $value) {
            $this->m_ajax->multi_delete($value);
        }

    }

    function ambil_data_tpa()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->m_ajax->ambil_data_tpa($nisn);
        print_r(json_encode($data));
    }

    function kirim_data_tpa_admin()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->kirim_data_tpa($_POST, $nisn);
    }

    function reset_nilai_tpa()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->reset_nilai_tpa($nisn);

    }

    function aktifkan_nilai_tpa()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->aktifkan_nilai_tpa($nisn, $_POST);

    }

    function get_all_soal()
    {

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw = $_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length = $_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start = $_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search = $_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order = $_REQUEST['order'][0]["column"];
        $dir = $_REQUEST['order'][0]["dir"];

        switch ($order) {
            case 5 :
                $orderby = 'id';
                break;
            case 6 :
                $orderby = 'soal';
                break;
            default :
                $orderby = 'soal';
        }

        /*Menghitung total desa didalam database*/
        $total = $this->db->count_all_results("core_soal");
        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output = array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw'] = $draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data'] = array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian */
        if ($search != "") {
            $this->db->like("id", $search);
            $this->db->or_like('soal', $search);

        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        $this->db->order_by($order, $dir);
        $query = $this->db->get('core_soal');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu */

        if ($search != "") {
            $this->db->like("id", $search);
            $this->db->or_like('soal', $search);
            $jum = $this->db->get('core_soal');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            switch ($data['id_mapel']) {
                case 1 :
                    $mapel = "IPA";
                    break;
                case 3 :
                    $mapel = "Bahasa Indonesia";
                    break;
                case 4 :
                    $mapel = "Bahasa Inggris";
                    break;
                case 2 :
                    $mapel = "Matematika";
                    break;
                default:
                    $mapel = "Dll";
                    break;
            }
            $output['data'][] = array($nomor_urut, $data['id'], $mapel, $data['soal']);
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    function get_all_admin()
    {

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw = $_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length = $_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start = $_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search = $_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order = $_REQUEST['order'][0]["column"];
        $dir = $_REQUEST['order'][0]["dir"];

        switch ($order) {
            case 1 :
                $orderby = 'name';
                break;
            case 2 :
                $orderby = 'username';
                break;
            case 3 :
                $orderby = 'jurusan';
                break;
            default :
                $orderby = 'name';
        }

        /*Menghitung total desa didalam database*/
        $total = $this->db->count_all_results("admin");
        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output = array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw'] = $draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data'] = array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian */
        if ($search != "") {
            $this->db->like("username", $search);
            $this->db->or_like('name', $search);

        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        $this->db->order_by($order, $dir);
        $query = $this->db->get('admin');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu */

        if ($search != "") {
            $this->db->like("username", $search);
            $this->db->or_like('name', $search);
            $jum = $this->db->get('admin');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            $output['data'][] = array($nomor_urut, $data['name'], $data['username']);
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    function cek_nisn()
    {
        $nisn = $this->input->post("nisn");
        $hasil = $this->m_ajax->cek_nisn($nisn);
        if ($hasil) {
            print_r("true");
        } else {
            print_r("false");
        }
    }

    function hapus_soal()
    {
        $id = $this->input->post('id');
        $this->m_ajax->hapus_soal($id);

    }

    function multi_delete_soal()
    {

        foreach ($_POST as $key => $value) {
            $this->m_ajax->multi_delete_soal($value);
        }

    }

    function kirim_data_soal()
    {
        $id = $this->input->post('id');
        $this->m_ajax->kirim_data_soal($_POST, $id);
    }

    function cek_no_soal()
    {
        $id = $this->input->post("id");
        $hasil = $this->m_ajax->cek_no_soal($id);
        if ($hasil) {
            print_r("true");
        } else {
            print_r("false");
        }
    }

    function ambil_data_soal()
    {
        $id = $this->input->post('id');
        $data = $this->m_ajax->ambil_data_soal($id);
        print_r(json_encode($data));
    }

    function kirim_data_admin()
    {
        $id = $this->input->post('username');
        $this->m_ajax->kirim_data_admin($_POST, $id);
    }

    function ambil_data_admin()
    {
        $username = $this->input->post('username');
        $data = $this->m_ajax->ambil_data_admin($username);
        print_r(json_encode($data));
    }

    function hapus_admin()
    {
        $id = $this->input->post('username');
        $this->m_ajax->hapus_admin($id);

    }

    function login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if ($this->m_ajax->login_admin($username, $password)['status']) {
            $output = ($this->m_ajax->login_admin($username, $password));
            $this->session->set_userdata($output);
        } else if ($output = ($this->m_ajax->login_siswa($username, $password))) {
            $this->session->set_userdata($output);
        } else {
            $output = array("status" => false);
        }
        echo json_encode($output);
    }

    function logout()
    {
        $this->session->sess_destroy();
        Redirect(base_url() . "login", false);
    }

    function get_pengaturan()
    {

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw = $_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length = $_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start = $_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search = $_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order = $_REQUEST['order'][0]["column"];
        $dir = $_REQUEST['order'][0]["dir"];

        switch ($order) {
            case 1 :
                $orderby = 'nama_pengaturan';
                break;
            case 2 :
                $orderby = 'isi';
                break;
            default :
                $orderby = 'nama_pengaturan';
        }

        /*Menghitung total desa didalam database*/
        $total = $this->db->count_all_results("pengaturan");
        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output = array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw'] = $draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data'] = array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian */
        if ($search != "") {
            $this->db->like("nama_pengaturan", $search);
            $this->db->or_like('isi', $search);

        }
        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        $this->db->order_by($order, $dir);
        $query = $this->db->get('pengaturan');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu */

        if ($search != "") {
            $this->db->like("nama_pengaturan", $search);
            $this->db->or_like('isi', $search);
            $jum = $this->db->get('pengaturan');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            $output['data'][] = array($nomor_urut, $data['nama_pengaturan'], $data['isi']);
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    function ambil_data_pengaturan()
    {
        $id = $this->input->post('nama_pengaturan');
        $data = $this->m_ajax->ambil_data_pengaturan($id);
        switch ($data[0]['nama_pengaturan']) {
            case 'ahir_ppdb' :
                $data[0] += ['tipe' => "date"];
                break;
            case 'mulai_ppdb' :
                $data[0] += ['tipe' => "date"];
                break;
            case 'tahun_ajaran_ppdb':
                $data[0] += ['tipe' => "number"];
                break;
            default :
                $data[0] += ['tipe' => "text"];
                break;
        };
        print_r(json_encode($data));
    }

    function kirim_data_pengaturan()
    {
        $id = $this->input->post('nama_pengaturan');
        $this->m_ajax->kirim_data_pengaturan($_POST, $id);
    }

    function ambil_data_hasil($umumkan = "")
    {
        print_r($umumkan);
        $output = array();
        $output['data'] = array();
        $this->db->join("nilai_un", 'siswa.nisn=nilai_un.nisn', 'left');
        $this->db->join("nilai_tpa", 'siswa.nisn=nilai_tpa.nisn', 'left');
        $this->db->join("nilai_usbn", 'siswa.nisn=nilai_usbn.nisn', 'left');
        $this->db->where('siswa.no_peserta is NOT NULL', NULL, FALSE);
        $filter = strtoupper($this->session->userdata("filter_jurusan"));
        if ($umumkan == "ya") {
        } else {
            if ($filter != "") {
                $this->db->where("siswa.jurusan", $filter);
            }
        }
        $query = $this->db->get('siswa');
        $nomor_urut = 1;

        $bobot_spk = ['20', '10', '70'];

        foreach ($query->result_array() as $data) {
            $un = (($data['ipa'] * 3) + ($data['matematika'] * 4) + ($data['bhs_inggris'] * 3) + ($data['bhs_indonesia'] * 1)) / 11;
            $usbn = (($data['pai'] + $data['pkn'] + $data['ips']) / 3);
            $tpa = $data['nilai'];

            if (isset($usbn) && isset($tpa)) {
                $nilai_spk = [$un, $usbn, $tpa];
                $total = spk_smart($nilai_spk, $bobot_spk);
            } else {
                $total = 0;
            }

            $status = null;

            $output['data'][] = array(
                $nomor_urut,
                /** Data Diri */
                $data['no_peserta'],
                $data['nisn'],
                $data['nama_lengkap'],
                $data['asal_sekolah'],
                $data['jurusan'],
                $data['jk'],
                //$data['tahun_lulus']

                /** Nilai UN */
                $data['bhs_indonesia'],
                $data['bhs_inggris'],
                $data['matematika'],
                $data['ipa'],
                round($un, 4),

                /** Nilai USBN */
                $data['pai'],
                $data['pkn'],
                $data['ips'],
                round($usbn, 4),

                /** NIlai Potensial Akademik */
                round($tpa, 4),

                /**total hasil perhitungan metode SMART*/
                $total,
                $status
            );
            $nomor_urut++;
        }

        foreach ($output as $hasil) {
            foreach ($hasil as $key => $isi) {
                $sort_nomor_urut[$key] = $isi[0];
                $sort_no_peserta[$key] = $isi[1];
                $sort_nisn[$key] = $isi[2];
                $sort_nama_lengkap[$key] = $isi[3];
                $sort_asal_sekolah[$key] = $isi[4];
                $sort_jurusan[$key] = $isi[5];
                $sort_jk[$key] = $isi[6];
                $sort_bhs_indonesia[$key] = $isi[7];
                $sort_bhs_inggris[$key] = $isi[8];
                $sort_matematika[$key] = $isi[9];
                $sort_ipa[$key] = $isi[10];
                $sort_rata_rata_un[$key] = $isi[11];
                $sort_pai[$key] = $isi[12];
                $sort_pkn[$key] = $isi[13];
                $sort_ips[$key] = $isi[14];
                $sort_rata_rata_usbn[$key] = $isi[15];
                $sort_tpa[$key] = $isi[16];
                $sort_hasil[$key] = $isi[17];
                $sort_status[$key] = $isi[18];
            }
        }
        if (count($hasil) >= 1) {
            array_multisort($sort_hasil, SORT_DESC, $hasil);
        }

        /** @var  $status array ket : akuntansi, administrasiperkantoran, pemasaran, animasi, multimedia, tp4 */
        $status = array(
            'akuntansi' => 0,
            'administrasiperkantoran' => 0,
            'pemasaran' => 0,
            'animasi' => 0,
            'multimedia' => 0,
            'tp4' => 0
        );

        /**
         * Menghitung Lulus Atau Tidak
         */
        foreach ($hasil as $i => $ii) {
            $hasil[$i][0] = $i + 1;
            $hasil[$i][17] = round($hasil[$i][17], 4);
            $jurusan = strtolower($hasil[$i][5]);
            if ($jurusan == 'akuntansi') {

                $status['akuntansi'] = $status['akuntansi'] + 1;
                if ($status['akuntansi'] <= get_setting('max_akuntansi')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } elseif ($jurusan == 'administrasiperkantoran') {

                $status['administrasiperkantoran'] = $status['administrasiperkantoran'] + 1;
                if ($status['administrasiperkantoran'] <= get_setting('max_administrasiperkantoran')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } elseif ($jurusan == 'pemasaran') {

                $status['pemasaran'] = $status['pemasaran'] + 1;
                if ($status['pemasaran'] <= get_setting('max_pemasaran')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } elseif ($jurusan == 'animasi') {

                $status['animasi'] = $status['animasi'] + 1;
                if ($status['animasi'] <= get_setting('max_animasi')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } elseif ($jurusan == 'multimedia') {

                $status['multimedia'] = $status['multimedia'] + 1;
                if ($status['multimedia'] <= get_setting('max_multimedia')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } elseif ($jurusan == 'tp4') {

                $status['tp4'] = $status['tp4'] + 1;
                if ($status['tp4'] <= get_setting('max_tp4')) {
                    $hasil[$i][18] = "Diterima";
                } else {
                    $hasil[$i][18] = "Ditolak";
                }
            } else {
                $hasil[$i][18] = "Ditolak";
            }
        }
        $newhasil['data'] = $hasil;

        /**
         * Simpan Hasil Ke DB Hasil Jika Di umumkan
         */
        if ($umumkan == "ya") {
            $simpan_hasil = array();
            foreach ($hasil as $i_a => $ii_a) {
                $simpan_hasil1 = array(
                    'nisn' => $hasil[$i_a][2],
                    'no_peserta' => $hasil[$i_a][1],
                    'nama' => $hasil[$i_a][3],
                    'jurusan' => $hasil[$i_a][5],
                    'total_nilai' => $hasil[$i_a][17],
                    'status' => $hasil[$i_a][18]
                );
                array_push($simpan_hasil, $simpan_hasil1);
            }
            $this->m_ajax->simpan_hasil($simpan_hasil);
        }
        /**
         * Buat JSON Untuk Datables
         */
        echo json_encode($newhasil);
    }

    function ganti_password()
    {
        $username = $this->session->userdata("username");
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru_1');
        if ($this->m_ajax->ganti_password($username, $password_lama, $password_baru)) {
            $output = array("status" => true);
        } else {
            $output = array("status" => false);
        }

        echo json_encode($output);
    }

    function batalkan_pengumuman()
    {
        $this->m_ajax->batalkan_pengumuman();
    }

    function kirim_soal()
    {
        $soal = $this->input->post("soal");
        $kunci = $this->input->post("jawaban");
        $jawaban_a = $this->input->post("a");
        $jawaban_b = $this->input->post("b");
        $jawaban_c = $this->input->post("c");
        $id_mapel = $this->input->post("id_mapel");

        $array_soal = array($jawaban_a, $jawaban_b, $jawaban_c, $kunci);
        shuffle($array_soal);
        $simpan_hasil = array();
        switch (array_search($kunci, $array_soal)) {
            case 0:
                $jawaban = 'a';
                break;
            case 1:
                $jawaban = 'b';
                break;
            case 2:
                $jawaban = 'c';
                break;
            case 3:
                $jawaban = 'd';
                break;
        }
        $simpan_hasil1 = array(
                'id' => $this->m_ajax->no_soal(),
                'id_mapel' => $id_mapel,
                'soal' => $soal,
                'opsi_a' => $array_soal[0],
                'opsi_b' => $array_soal[1],
                'opsi_c' => $array_soal[2],
                'opsi_d' => $array_soal[3],
                'jawaban' => $jawaban,
                'key' => base64_encode($soal)
            );

        array_push($simpan_hasil, $simpan_hasil1);
        if($this->m_ajax->cek_soal_duplikat($soal) == "1"){
            $this->m_ajax->isert_soal($simpan_hasil);
            $this->m_ajax->cek_soal_duplikat($soal);
        }
    }

}