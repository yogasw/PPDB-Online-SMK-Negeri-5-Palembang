<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $data['menu'] = null;
    }

    public function index()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }

    public function home()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }

    public function datasiswa()
    {
        $this->load->model('m_datasiswa');
        $data_siswa['data'] = $this->m_datasiswa->show_datasiswa();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/data_siswa', $data_siswa);
        $this->load->view('admin/template/footer');
    }

    public function akun()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/akun');
        $this->load->view('admin/template/footer');
    }

    public function jurusan()
    {
        // didapat dari data ajax
        $type = $id = $this->input->post('type');
        if($type != "");
            log_message('error', 'TYPE : '.$type);
        {
            if ($type == "tambahdata")
            {
                $id = $this->input->post('id');
                $jurusan = $this->input->post('jurusan');
                $this->load->model('m_jurusan');
                $x['data'] = $this->m_jurusan->add_jurusan($id, $jurusan);
            } else if ($type == "editdata")
            {
                $id = $this->input->post('id');
                $jurusan = $this->input->post('jurusan');
                $this->load->model('m_jurusan');
                $x['data'] = $this->m_jurusan->edit_jurusan($id, $jurusan);
            } else if ($type == "hapusdata")
            {
                $id = $this->input->post('id');
                $this->load->model('m_jurusan');
                $x['data'] = $this->m_jurusan->hapus_jurusan($id);
            }else if ($type == "hapusalldata")
            {
                $id = $this->input->post('id');
                $this->load->model('m_jurusan');
                $x['data'] = $this->m_jurusan->hapus_jurusan($id);
            }
        }


        $this->load->model('m_jurusan');
        $x['data'] = $this->m_jurusan->show_jurusan();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/jurusan', $x);
        $this->load->view('admin/template/footer');

    }

    public function kriteria()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/kriteria');
        $this->load->view('admin/template/footer');
    }

    public function logout()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        echo "Sistem Keluar";
        $this->load->view('admin/template/footer');
    }

    public function tambahjurusan()
    {
        // didapat dari data ajax
        $id = $this->input->post('id');
        $jurusan = $this->input->post('jurusan');
        $this->load->model('m_jurusan');
        $x['data'] = $this->m_jurusan->add_jurusan($id,$jurusan);

    }
}
