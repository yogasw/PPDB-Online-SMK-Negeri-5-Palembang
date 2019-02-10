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


    function home()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $nisn = $this->session->userdata('username');

        /** Nilai TPA */
        $nilai = $this->m_ppdb->lihat_nilai($nisn);
        if (isset($nilai->nilai)) {
            $jumlah_soal = count(explode(",", $nilai->list_soal));
            $x['nilai_tpa'] = array(
                "nisn" => $nilai->nisn,
                "jumlah_benar" => $nilai->jml_benar,
                "nilai" => $nilai->nilai,
                "jumlah_salah" => $jumlah_soal - $nilai->jml_benar,
                "jumlah_soal" => $jumlah_soal
            );
        } else {
            $x['nilai_tpa'] = false;
        }

        /** Jika Terjadi Error */
        $x['error'] = $this->input->get('error');

        /** Hasil Ujian */
        if (isset($this->m_ppdb->lihat_hasil($nisn)->status)){
            $x['hasil'] = $this->m_ppdb->lihat_hasil($nisn)->status;
        }else{
            $x['hasil'] = "";
        }


        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/home', $x);
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

    function tpa()
    {
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $this->load->model('m_ajax');

        $nisn = $this->session->userdata("username");

        $x['data'] = $this->m_ppdb->getsoal($nisn);
        if (($this->m_ajax->ambil_data_tpa($nisn)[0]['list_jawaban']) != "") {
            $x['jawaban'] = jawaban_to_array($this->m_ajax->ambil_data_tpa($nisn)[0]['list_jawaban']);
        }

        //mengambil daftar soal yang sudah di acak serta isi waktu selesai dan mulai
        if ($this->m_ppdb->cek_soal_status($nisn)) {
            if (!$this->m_ppdb->cek_nilai_tpa($nisn)) {
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

                $this->m_ajax->insert_nilai_tpa($data, $nisn);
            }
        }

        //ambil sisa waktu dari database
        $this->load->model('M_ajax', 'ajax');
        $data = $this->ajax->ambil_data_tpa($nisn)[0];

        $selesai = $data['tgl_selesai'];
        $mulai = $data['tgl_mulai'];

        //log_app("Waktu Mulai : ".$data['tgl_mulai']." Waktu Selesai : ".$data['tgl_selesai']." Siswa Waktu : ".sisa_waktu($selesai));
        $x['waktu'] = sisa_waktu($mulai, $selesai);

        if ($x['waktu'] == 0) {
            Redirect(base_url() . "home?error=soal", false);
        }
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/tpa', $x);
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
        ob_start();
        if ($this->session->userdata('level') != "siswa") {
            Redirect(base_url() . "login", false);
        }

        $nisn = $this->session->userdata('username');
        $this->pdf->cetak_kartu($this->m_ppdb->getdatasiswa($nisn)[0]);
    }

    function test($nisn)
    {
    }
}