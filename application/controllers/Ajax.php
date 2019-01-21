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
            $this->db->like("no_peserta", $search);
            $this->db->or_like('nisn', $search);
            $this->db->or_like('nama_lengkap', $search);
            $this->db->or_like('asal_sekolah', $search);
            $this->db->or_like('jurusan', $search);
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length, $start);
        /*Urutkan dari alphabet paling terkahir*/

        switch ($order) {
            case 1 :
                $orderby = 'no_peserta';
                break;
            case 2 :
                $orderby = 'nisn';
                break;
            case 3 :
                $orderby = 'nama_lengkap';
                break;
            case 4 :
                $orderby = 'asal_sekolah';
                break;
            case 5 :
                $orderby = 'jurusan';
                break;
            default :
                $orderby = 'nama_lengkap';
        }
        $this->db->order_by($orderby, $dir);
        $query = $this->db->get('siswa');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        if ($search != "") {
            $this->db->like("no_peserta", $search);
            $this->db->or_like('nisn', $search);
            $this->db->or_like('nama_lengkap', $search);
            $this->db->or_like('asal_sekolah', $search);
            $this->db->or_like('jurusan', $search);
            $jum = $this->db->get('siswa');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            $output['data'][] = array($nomor_urut, $data['no_peserta'], $data['nisn'], $data['nama_lengkap'], $data['asal_sekolah'], $data['jurusan']);
            $nomor_urut++;
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
                    array_push($data,
                        '<option value=' . $row->id . '>' . $row->description . '</option>'
                    );
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
            'negara' => (string)$_POST['negara'],
            'kota' => (string)$_POST['kota'],
        );

        $this->m_ajax->update_siswa($data);
        $respon = array(
            "nama_lengkap" => (string)$_POST['nama_lengkap'],
            "status" => true
        );

        echo json_encode($respon);
    }

    function tambah_siswa()
    {
        header('Content-type: application/json');
        $data[] = array(
            'nama_lengkap' => strtoupper((string)$_POST['nama_lengkap']),
            'no_peserta' => (string)$_POST['no_peserta'],
            'nisn' => (string)$_POST['nisn'],
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
            'negara' => (string)$_POST['negara'],
            'kota' => (string)$_POST['kota'],
        );

        $nilai_un[] = array(
            'nisn' => (string)$_POST['nisn'],
            'ipa' => (string)$_POST['nilai_ipa'],
            'ips' => (string)$_POST['nilai_ips'],
            'bhs_indonesia' => (string)$_POST['nilai_bhs_indonesia'],
            'bhs_inggris' => (string)$_POST['nilai_bhs_inggris']
        );
        $this->m_ajax->tambah_nilai_un($nilai_un);
        $this->m_ajax->tambah_siswa($data);
        $respon = array(
            "nama_lengkap" => (string)$_POST['nama_lengkap'],
            "status" => true
        );

        echo json_encode($respon);
    }

    function kirim_quiz()
    {
        $nisn = '141420213';
        $jumlah_benar = 0;
        $jumlah_bobot = 0;
        $nilai = 0;
        $status = "selesai";
        $jawaban = post_to_array($_POST);

        foreach ($jawaban as $row) {
            $benar = $this->m_ajax->getjawaban($row['key']);
            if ((strtolower($benar->jawaban)) == strtolower($row['value'])) {
                $nilai = $nilai + 1;
                $jumlah_bobot = $jumlah_bobot + $benar->bobot;
                $jumlah_benar = $jumlah_benar + 1;
            }
        }

        $data = array(
            'nisn' => $nisn,
            'list_jawaban' => post_to_coma($_POST),
            'jml_benar' => $jumlah_benar,
            'nilai' => $nilai,
            'nilai_bobot' => $jumlah_bobot,
            'tgl_mulai' => date('Y-m-d H:i:s'),
            'tgl_selesai' => $date = date('Y-m-d H:i:s'),
            'status' => $status
        );
        $this->m_ajax->insert_nilai_mb($data, $nisn);
    }

    function ambil_data_wawancara()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->m_ajax->getwawancara($nisn);
        print_r(json_encode($data));
    }

    function kirim_data_wawancara()
    {
        log_all();
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

    function ambil_data_minat_bakat()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->m_ajax->ambil_data_minat_bakat($nisn);
        print_r(json_encode($data));
    }

    function kirim_data_minat_bakat()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->kirim_data_minat_bakat($_POST, $nisn);
    }

    function reset_nilai_minat_bakat()
    {
        $nisn = $this->input->post('nisn');
        $this->m_ajax->reset_nilai_minat_bakat($nisn);

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
                case 2 :
                    $mapel = "IPS";
                    break;
                case 3 :
                    $mapel = "Bahasa Indonesia";
                    break;
                case 4 :
                    $mapel = "Bahasa Inggris";
                    break;
                case 5 :
                    $mapel = "Matematika";
                    break;
                default:
                    $mapel = "Dll";
                    break;
            }
            $output['data'][] = array($nomor_urut, $data['id'], $mapel, $data['soal'], $data['bobot'], $data['gambar']);
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
            $this->db->or_like('jurusan', $search);
            $jum = $this->db->get('admin');
            $output['recordsTotal'] = $output['recordsFiltered'] = $jum->num_rows();
        }


        $nomor_urut = $start + 1;
        foreach ($query->result_array() as $data) {
            $output['data'][] = array($nomor_urut, $data['name'], $data['username'], $data['jurusan']);
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    function cek_nisn()
    {
        $nisn = $this->input->post("nisn");
        $hasil = $this->m_ajax->cek_nisn($nisn);
        log_app($nisn . " " . $hasil);
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
        log_all();
        log_app($username);
        $data = $this->m_ajax->ambil_data_admin($username);
        print_r(json_encode($data));
    }

    function hapus_admin()
    {
        $id = $this->input->post('username');
        $this->m_ajax->hapus_admin($id);

    }
}