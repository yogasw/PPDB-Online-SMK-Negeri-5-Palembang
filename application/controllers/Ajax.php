<?php

/**
 * Created by PhpStorm.
 * User: Ari Oki
 * Date: 14/01/2019
 * Time: 14.08
 */
class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('site_helper');
        $this->load->model('m_ajax');
    }

    function ambil_data_pendaftaran(){

        /*Menagkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw=$_REQUEST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length=$_REQUEST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start=$_REQUEST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search=$_REQUEST['search']["value"];

        /*order yang di klik user*/

        $order=$_REQUEST['order'][0]["column"];
        $dir=$_REQUEST['order'][0]["dir"];

        /*Menghitung total desa didalam database*/
        $total=$this->db->count_all_results("siswa");

        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output=array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw']=$draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal']=$output['recordsFiltered']=$total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data']=array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian*/
        if($search!=""){
            $this->db->like("no_peserta",$search);
            $this->db->or_like('nisn', $search);
            $this->db->or_like('nama_lengkap', $search);
            $this->db->or_like('asal_sekolah', $search);
            $this->db->or_like('jurusan', $search);
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);
        /*Urutkan dari alphabet paling terkahir*/

        switch ($order){
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
        $this->db->order_by($orderby,$dir);
        $query=$this->db->get('siswa');

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        if($search!=""){
            $this->db->like("no_peserta",$search);
            $this->db->or_like('nisn', $search);
            $this->db->or_like('nama_lengkap', $search);
            $this->db->or_like('asal_sekolah', $search);
            $this->db->or_like('jurusan', $search);
            $jum=$this->db->get('siswa');
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }


        $nomor_urut=$start+1;
        foreach ($query->result_array() as $data) {
            $output['data'][]=array($nomor_urut,$data['no_peserta'],$data['nisn'],$data['nama_lengkap'],$data['asal_sekolah'],$data['jurusan']);
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    function hapus_siswa(){
        $nisn = $this->input->post('nisn');
        $this->m_ajax->hapus_siswa($nisn);

    }
    public function data_lokasi(){
        header('Content-type: application/json');
        $parent_id = $_POST['parent_id'];
        if ($parent_id != "") {
            $query = $this->m_ajax->city($parent_id);
            $data = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    array_push($data,
                        '<option value='.$row->id.'>'.$row->description.'</option>'
                    );
                }
            }
            echo json_encode($data);
        }
    }
}