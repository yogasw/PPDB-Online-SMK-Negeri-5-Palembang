<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 11.46
 */
class Pmb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pmb');
        $this->load->helper('site_helper');
    }

    public function pendaftaran()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_pmb->show_data();
        $this->load->view('pmb/pendaftaran',$x);
        $this->load->view('admin/template/footer');
    }

    public function wawancara()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_pmb->show_data();
        $this->load->view('pmb/wawancara', $x);
        $this->load->view('admin/template/footer');
    }

    public function psikologi()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_pmb->show_data();
        $this->load->view('pmb/psikologi', $x);
        $this->load->view('admin/template/footer');
    }

    public function ubahdata_siswa()
    {
        $nisn = $this->input->get('nisn');
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $x['data'] = $this->m_pmb->getdatasiswa($nisn);
        $this->load->view('pmb/ubah_data_siswa', $x);
        $this->load->view('admin/template/footer');
    }

    public function quizzes()
    {
        $x['data'] = $this->m_pmb->getsoal();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('pmb/quizzes', $x);
        $this->load->view('admin/template/footer');
    }

    public function tambahdata_siswa()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('pmb/tambah_data_siswa');
        $this->load->view('admin/template/footer');
    }

}