<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{

    /**
     * The CodeIgniter super object
     *
     * @var object
     * @access public
     */
    public $CI;

    /**
     * Class Constructor
     *
     * @return Void
     */
    public function __construct()
    {
        parent::__construct('P', 'Cm', 'F4', true, 'UTF-8', false);
        $this->CI = &get_instance();
    }

    /**
     * Overide Header
     */
    public function Header()
    {

    }

    /**
     * Overide Footer
     */
    public function Footer()
    {
        /**
         * $content = '<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-top:1px solid #000000;">';
         * $content .= '<tbody>';
         * $content .= '<tr>';
         * $content .= '<td align="left" width="60%">Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda.</td>';
         * $content .= '<td align="right" width="40%">Dicetak tanggal ' . indo_date(date('Y-m-d')) . ' pukul ' . date('H:i:s') . '</td>';
         * $content .= '</tr>';
         * $content .= '</tbody>';
         * $content .= '</table>';
         * $this->setY(-1);
         * $this->writeHTML($content, true, false, true, false, 'L');
         **/
    }


    public function cetak_bukti(array $result)
    {
        ob_end_clean();
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->SetAutoPageBreak(TRUE, 1);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // Set Properties
        $this->SetTitle('FORMULIR PENERIMAAN SISWA DIDIK BARU TAHUN ' . get_setting('tahun_ajaran_ppdb'));
        $this->SetAuthor('http://sekolahku.web.id');
        $this->SetSubject($this->CI->session->school_name);
        $this->SetKeywords($this->CI->session->school_name);
        $this->SetCreator('http://sekolahku.web.id');
        $this->SetMargins(2, 1, 2, true);
        $this->AddPage();
        $this->SetFont('freesans', '', 10);

        // Get HTML Template
        $content = file_get_contents(VIEWPATH . 'ppdb/pdf_template.html');
        // Header
        $content = str_replace('[LOGO]', base_url() . 'assets/img/logo.png', $content);
        $content = str_replace('[SCHOOL_NAME]', get_setting("nama_sekolah"), $content);
        $content = str_replace('[SCHOOL_STREET_ADDRESS]', get_setting("alamat_sekolah"), $content);
        $content = str_replace('[STUDENT_TYPE]', "Siswa", $content);
        $content = str_replace('[SCHOOL_PHONE]', get_setting("telepon_sekolah"), $content);
        $content = str_replace('[SCHOOL_EMAIL]', get_setting("email"), $content);
        $content = str_replace('[SCHOOL_WEBSITE]', get_setting("website"), $content);
        $content = str_replace('[TITLE]', 'Formulir Penerimaan Siswa Didik Baru Tahun ' . get_setting('tahun_ajaran_ppdb'), $content);
        $content = str_replace('[REGISTRATION_NUMBER]', $result['no_peserta'], $content);
        $content = str_replace('[CREATED_AT]', get_setting('tahun_ajaran_ppdb'), $content);
        $content = str_replace('[FIRST_CHOICE]', $result['jurusan'], $content);
        $content = str_replace('[PREV_SCHOOL_NAME]', $result['asal_sekolah'], $content);
        $content = str_replace('[FULL_NAME]', $result['nama_lengkap'], $content);
        $content = str_replace('[GENDER]', $result['jk'], $content);
        $content = str_replace('[NISN]', $result['nisnsiswa'], $content);
        $content = str_replace('[TAHUN_LULUS]', $result['tahun_lulus'], $content);
        $content = str_replace('[BIRTH_PLACE]', $result['tempat_lahir'], $content);
        $content = str_replace('[BIRTH_DATE]', $result['tanggal_lahir'], $content);
        $content = str_replace('[RELIGION]', $result['agama'], $content);
        $content = str_replace('[STREET_ADDRESS]', $result['alamat'], $content);
        $content = str_replace('[KOTA]', $result['kota'], $content);
        $content = str_replace('[PROVINSI]', $result['provinsi'], $content);
        $content = str_replace('[NEGARA]', $result['negara'], $content);
        $content = str_replace('[NO_HP]', $result['no_hp'], $content);
        $content = str_replace('[EMAIL]', $result['email'], $content);
        $content = str_replace('[FOOTER_DATE]', "________________, " . indo_date(date('Y-m-d')), $content);
        $content = str_replace('[FOOTER_FULL_NAME]', $result['nama_lengkap'], $content);
        $file_name = 'formulir-PPDB-SMK5-PLG-' . get_setting('tahun_ajaran_ppdb') . '-' . $result['nisnsiswa'];
        $file_name = strtoupper($file_name) . '.pdf';
        $this->writeHTML($content, true, false, true, false, 'C');
        $this->Output($file_name);

    }

    /**
     * Create PDF
     * @param    Array
     * @access    public
     */
    public function cetak_kartu(array $result)
    {
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->SetAutoPageBreak(TRUE, 1);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // Set Properties
        $this->SetTitle('FORMULIR PENERIMAAN SISWA DIDIK BARU TAHUN ' . get_setting('tahun_ajaran_ppdb'));
        $this->SetAuthor('http://sekolahku.web.id');
        $this->SetSubject($this->CI->session->school_name);
        $this->SetKeywords($this->CI->session->school_name);
        $this->SetCreator('http://sekolahku.web.id');
        $this->SetMargins(2, 1, 2, true);
        $this->AddPage();
        $this->SetFont('freesans', '', 10);

        // Get HTML Template
        $content = file_get_contents(VIEWPATH . 'ppdb/pdf_kartu.html');
        // Header
        $content = str_replace('[LOGO]', base_url() . 'assets/img/logo_sumsel-small.png', $content);
        $content = str_replace('[SCHOOL_NAME]', get_setting("nama_sekolah"), $content);
        $content = str_replace('[SCHOOL_STREET_ADDRESS]', get_setting("alamat_sekolah"), $content);
        $content = str_replace('[STUDENT_TYPE]', "Siswa", $content);
        $content = str_replace('[SCHOOL_PHONE]', get_setting("telepon_sekolah"), $content);
        $content = str_replace('[SCHOOL_EMAIL]', get_setting("email"), $content);
        $content = str_replace('[SCHOOL_WEBSITE]', get_setting("website"), $content);
        $content = str_replace('[TITLE]', 'KARTU PPDB TAHUN AJARAN ' . get_setting('tahun_ajaran_ppdb') . "/" . (get_setting('tahun_ajaran_ppdb') + 1), $content);

        $content = str_replace('[NISN]', $result['nisnsiswa'], $content);
        $content = str_replace('[JURUSAN]', get_name_jurusan($result['jurusan']), $content);
        $content = str_replace('[ASAL_SEKOLAH]', $result['asal_sekolah'], $content);
        $content = str_replace('[NAMA_LENGKAP]', $result['nama_lengkap'], $content);

        $content = str_replace('[FOOTER_DATE]', "________________, " . indo_date(date('Y-m-d')), $content);
        $content = str_replace('[NAMA_LENGKAP]', $result['nama_lengkap'], $content);

        $content = str_replace('[TANGGAL_CETAK]', indo_date(date('Y-m-d')) . ' pukul ' . date('H:i:s'), $content);

        $file_name = 'formulir-PPDB-SMK5-PLG-' . get_setting('tahun_ajaran_ppdb') . '-' . $result['nisnsiswa'];
        $file_name = strtoupper($file_name) . '.pdf';
        $this->writeHTML($content, true, false, true, true, 'C');
        ob_end_clean();
        $this->Output($file_name);
    }
}