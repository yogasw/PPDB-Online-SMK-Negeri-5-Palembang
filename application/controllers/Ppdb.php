<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 11.46
 */
class Ppdb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ppdb');
        $this->load->helper('site_helper');
        $this->load->library('Pdf');
    }

    function pendaftaran()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/pendaftaran');
        $this->load->view('admin/template/footer');
    }

    function home()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/home');
        $this->load->view('admin/template/footer');
    }
    function wawancara()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->show_data();
        $this->load->view('ppdb/wawancara', $x);
        $this->load->view('admin/template/footer');
    }

    function psikologi()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->show_data();
        $this->load->view('ppdb/psikologi', $x);
        $this->load->view('admin/template/footer');
    }

    function ubahdata_siswa()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $nisn = $this->session->userdata('username');
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->getdatasiswa($nisn);
        $this->load->view('ppdb/ubah_data_siswa', $x);
        $this->load->view('admin/template/footer');
    }

    function minat_bakat()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $this->load->model('m_ajax');

        $nisn = $this->session->userdata("username");

        $x['data'] = $this->m_ppdb->getsoal($nisn);

        if (($this->m_ajax->ambil_data_minat_bakat($nisn)[0]['list_jawaban']) != "") {
            $x['jawaban'] = jawaban_to_array($this->m_ajax->ambil_data_minat_bakat($nisn)[0]['list_jawaban']);
        }

        //mengambil daftar soal yang sudah di acak serta isi waktu selesai dan mulai
        if (!$this->m_ppdb->cek_nilai_mb($nisn)) {
            $soal = array();
            foreach ($x['data'] as $u) {
                array_push($soal, $u['id']);
            }
            $list_soal = array_to_coma($soal);

            //Mengambil waktu mulai dan waktu selesai
            $tgl_mulai = date('Y-m-d H:i:s');
            $tgl_selesai = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +10 minutes"));

            //Menghitung waktu selesai jika data sudah ada
            //$hasil = selisih_waktu($tgl_mulai, $tgl_selesai);

            $data = [
                'nisn' => $nisn,
                'list_soal' => $list_soal,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai
            ];

            $this->m_ajax->insert_nilai_mb($data, $nisn);
        }

        //ambil sisa waktu dari database
        $this->load->model('M_ajax', 'ajax');
        $data = $this->ajax->ambil_data_minat_bakat($nisn)[0];

        $selesai = $data['tgl_selesai'];
        $mulai = $data['tgl_mulai'];

        //log_app("Waktu Mulai : ".$data['tgl_mulai']." Waktu Selesai : ".$data['tgl_selesai']." Siswa Waktu : ".sisa_waktu($selesai));
        $x['waktu'] = sisa_waktu($mulai, $selesai);

        if ($x['waktu'] == 0) {
            Redirect(base_url() . "home", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/minat_bakat', $x);
        $this->load->view('admin/template/footer');
    }

    function tambahdata_siswa()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/tambah_data_siswa');
        $this->load->view('admin/template/footer');
    }

    function cetak_bukti()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $nisn = $this->session->userdata('username');
        $this->pdf->cetak_bukti($this->m_ppdb->getdatasiswa($nisn)[0]);
    }
}