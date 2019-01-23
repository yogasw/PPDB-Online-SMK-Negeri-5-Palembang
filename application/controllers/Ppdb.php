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
    }

    public function pendaftaran()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->show_data();
        $this->load->view('ppdb/pendaftaran', $x);
        $this->load->view('admin/template/footer');
    }

    public function wawancara()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->show_data();
        $this->load->view('ppdb/wawancara', $x);
        $this->load->view('admin/template/footer');
    }

    public function psikologi()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->show_data();
        $this->load->view('ppdb/psikologi', $x);
        $this->load->view('admin/template/footer');
    }

    public function ubahdata_siswa()
    {
        $nisn = $this->input->get('nisn');
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_ppdb->getdatasiswa($nisn);
        $this->load->view('ppdb/ubah_data_siswa', $x);
        $this->load->view('admin/template/footer');
    }

    public function minat_bakat()
    {
        $x['data'] = $this->m_ppdb->getsoal();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/minat_bakat', $x);
        $this->load->view('admin/template/footer');
    }

    public function tambahdata_siswa()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('ppdb/tambah_data_siswa');
        $this->load->view('admin/template/footer');
    }

}