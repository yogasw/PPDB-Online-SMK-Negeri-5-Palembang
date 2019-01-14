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
        $this->load->view('admin/template_new/header');
        $this->load->view('admin/template_new/sidebar');
        $x['data'] = $this->m_pmb->show_data();
        $this->load->view('pmb/pendaftaran',$x);
        $this->load->view('admin/template_new/footer');
    }

    public function ubahdata_siswa()
    {
        $nisn = $this->input->get('nisn');
        $this->load->view('admin/template_new/header');
        $this->load->view('admin/template_new/sidebar');
        $x['data'] = $this->m_pmb->getdatasiswa($nisn);
        $this->load->view('pmb/data_siswa', $x);
        $this->load->view('admin/template_new/footer');
    }

    public function tambahdata()
    {
        $this->load->view('admin/template_new/header');
        $this->load->view('admin/template_new/sidebar');
        //  $x['data'] = $this->m_pmb->getdatasiswa();
        //$this->load->view('pmb/data_siswa',$x);
        $this->load->view('admin/template_new/footer');
    }
}