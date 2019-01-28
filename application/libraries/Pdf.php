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
        $content = '<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-top:1px solid #000000;">';
        $content .= '<tbody>';
        $content .= '<tr>';
        $content .= '<td align="left" width="60%">Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda.</td>';
        $content .= '<td align="right" width="40%">Dicetak tanggal ' . indo_date(date('Y-m-d')) . ' pukul ' . date('H:i:s') . '</td>';
        $content .= '</tr>';
        $content .= '</tbody>';
        $content .= '</table>';
        $this->setY(-1);
        $this->writeHTML($content, true, false, true, false, 'L');
    }

    /**
     * Create PDF
     * @param    Array
     * @access    public
     */
    public function create_pdf(array $result)
    {
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->SetAutoPageBreak(TRUE, 1);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // Set Properties
        $this->SetTitle('FORMULIR PENERIMAAN ' . ucwords(strtolower($this->CI->session->_student)) . ' BARU TAHUN ' . $this->CI->session->admission_year);
        $this->SetAuthor('http://sekolahku.web.id');
        $this->SetSubject($this->CI->session->school_name);
        $this->SetKeywords($this->CI->session->school_name);
        $this->SetCreator('http://sekolahku.web.id');
        $this->SetMargins(2, 1, 2, true);
        $this->AddPage();
        $this->SetFont('freesans', '', 10);

        // Get HTML Template
        $content = file_get_contents(VIEWPATH . 'admission/pdf_template.html');
        // Header
        $content = str_replace('[LOGO]', base_url('media_library/images/' . $this->CI->session->logo), $content);
        $content = str_replace('[SCHOOL_NAME]', strtoupper($this->CI->session->school_name), $content);
        $content = str_replace('[SCHOOL_STREET_ADDRESS]', $this->CI->session->street_address, $content);
        $content = str_replace('[SCHOOL_PHONE]', $this->CI->session->phone, $content);
        $content = str_replace('[SCHOOL_FAX]', $this->CI->session->fax, $content);
        $content = str_replace('[SCHOOL_POSTAL_CODE]', $this->CI->session->postal_code, $content);
        $content = str_replace('[SCHOOL_EMAIL]', $this->CI->session->email, $content);
        $content = str_replace('[SCHOOL_WEBSITE]', str_replace(['http://', 'https://', 'www.'], '', $this->CI->session->website), $content);
        $content = str_replace('[TITLE]', 'Formulir Penerimaan ' . ucwords(strtolower($this->CI->session->_student)) . ' Baru Tahun ' . $this->CI->session->admission_year, $content);
        // Registrasi Peserta Didik
        $content = str_replace('[STUDENT_TYPE]', ($this->CI->session->school_level >= 5 ? 'Calon Mahasiswa' : 'Calon Peserta Didik'), $content);
        $content = str_replace('[IS_TRANSFER]', ($result['is_transfer'] == 'true' ? 'Pindahan' : 'Baru'), $content);
        $content = str_replace('[ADMISSION_TYPE]', $result['admission_type'], $content);
        $content = str_replace('[REGISTRATION_NUMBER]', $result['registration_number'], $content);
        $content = str_replace('[CREATED_AT]', $result['created_at'], $content);
        if ($this->CI->session->school_level >= 3) {
            $content = str_replace('[FIRST_CHOICE]', $result['first_choice'], $content);
            $content = str_replace('[SECOND_CHOICE]', $result['second_choice'], $content);
        } else {
            $replace = '<tr><td align="right">Pilihan I</td><td align="center">:</td><td align="left">[FIRST_CHOICE]</td></tr>';
            $content = str_replace($replace, '', $content);
            $replace = '<tr><td align="right">Pilihan II</td><td align="center">:</td><td align="left">[SECOND_CHOICE]</td></tr>';
            $content = str_replace($replace, '', $content);
        }

        $content = str_replace('[PREV_SCHOOL_NAME]', $result['prev_school_name'], $content);
        $content = str_replace('[PREV_SCHOOL_ADDRESS]', $result['prev_school_address'], $content);
        // Profile
        $content = str_replace('[FULL_NAME]', $result['full_name'], $content);
        $content = str_replace('[GENDER]', $result['gender'], $content);

        if ($this->CI->session->school_level == 2 || $this->CI->session->school_level == 3 || $this->CI->session->school_level == 4) {
            $content = str_replace('[NISN]', $result['nisn'], $content);
        } else {
            $replace = '<tr><td align="right">NISN</td><td align="center">:</td><td align="left">[NISN]</td></tr>';
            $content = str_replace($replace, '', $content);
        }
        if ($this->CI->session->school_level > 1) {
            $content = str_replace('[NIK]', $result['nik'], $content);
        } else {
            $replace = '<tr><td align="right">NIK</td><td align="center">:</td><td align="left">[NIK]</td></tr>';
            $content = str_replace($replace, '', $content);
        }
        $content = str_replace('[BIRTH_PLACE]', $result['birth_place'], $content);
        $content = str_replace('[BIRTH_DATE]', indo_date($result['birth_date']), $content);
        $content = str_replace('[RELIGION]', $result['religion'], $content);
        $content = str_replace('[SPECIAL_NEEDS]', $result['special_needs'], $content);
        // Alamat
        $content = str_replace('[STREET_ADDRESS]', $result['street_address'], $content);
        $content = str_replace('[RT]', $result['rt'], $content);
        $content = str_replace('[RW]', $result['rw'], $content);
        $content = str_replace('[SUB_VILLAGE]', $result['sub_village'], $content);
        $content = str_replace('[VILLAGE]', $result['village'], $content);
        $content = str_replace('[SUB_DISTRICT]', $result['sub_district'], $content);
        $content = str_replace('[DISTRICT]', $result['district'], $content);
        $content = str_replace('[POSTAL_CODE]', $result['postal_code'], $content);
        $content = str_replace('[EMAIL]', $result['email'], $content);
        $content = str_replace('[FOOTER_DATE]', $result['district'] . ', ' . indo_date(substr($result['created_at'], 0, 10)), $content);
        $content = str_replace('[FOOTER_FULL_NAME]', $result['full_name'], $content);
        $file_name = 'formulir-penerimaan-' . ($this->CI->session->school_level >= 5 ? 'mahasiswa' : 'peserta-didik') . '-baru-tahun-' . $this->CI->session->admission_year;
        $file_name .= '-' . $result['birth_date'] . '-' . $result['registration_number'] . '.pdf';
        $this->writeHTML($content, true, false, true, false, 'C');
        $this->Output(FCPATH . 'media_library/students/' . $file_name, 'F');
    }

    /**
     * Generating PDF
     * @param    Array
     * @access    public
     */
    public function blank_pdf()
    {
        $CI = &get_instance();
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $this->SetAutoPageBreak(TRUE, 1);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // Set Properties
        $this->SetTitle('FORMULIR PENERIMAAN ' . ucfirst(strtolower($this->CI->session->_student)) . ' BARU TAHUN ' . $this->CI->session->admission_year);
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
        /**
         * $content = str_replace('[LOGO]', base_url('media_library/images/'.$this->CI->session->logo), $content);
         * $content = str_replace('[SCHOOL_NAME]', strtoupper($this->CI->session->school_name), $content);
         * $content = str_replace('[SCHOOL_STREET_ADDRESS]', $this->CI->session->street_address, $content);
         * $content = str_replace('[SCHOOL_PHONE]', $this->CI->session->phone, $content);
         * $content = str_replace('[SCHOOL_FAX]', $this->CI->session->fax, $content);
         * $content = str_replace('[SCHOOL_POSTAL_CODE]', $this->CI->session->postal_code, $content);
         * $content = str_replace('[SCHOOL_EMAIL]', $this->CI->session->email, $content);
         * $content = str_replace('[SCHOOL_WEBSITE]', str_replace(['http://', 'https://', 'www.'], '', $this->CI->session->website), $content);
         * $content = str_replace('[TITLE]', 'Formulir Penerimaan ' . ucwords(strtolower($this->CI->session->_student)).' Baru Tahun '.$this->CI->session->admission_year, $content);
         * $dotted = '.................................................................................................................';
         * $content = str_replace('[STUDENT_TYPE]', ucwords(strtolower($this->CI->session->_student)), $content);
         * $content = str_replace('[IS_TRANSFER]', 'Baru / Pindahan', $content);
         * $content = str_replace('[ADMISSION_TYPE]', (count($params['admission_types']) > 0 ? implode(' / ', $params['admission_types']) : $dotted), $content);
         * $content = str_replace('[REGISTRATION_NUMBER]', '....................................................................................... ( <i>Diisi Panitia</i> )', $content);
         * $content = str_replace('[CREATED_AT]', '....................................................................................... ( <i>Diisi Panitia</i> )', $content);
         * // Registrasi Peserta Didik
         * if ($this->CI->session->school_level >= 3) {
         * $content = str_replace('[FIRST_CHOICE]', $dotted, $content);
         * $content = str_replace('[SECOND_CHOICE]', $dotted, $content);
         *
         * } else {
         * $replace = '<tr><td align="right">Pilihan I</td><td align="center">:</td><td align="left">[FIRST_CHOICE]</td></tr>';
         * $content = str_replace($replace, '', $content);
         * $replace = '<tr><td align="right">Pilihan II</td><td align="center">:</td><td align="left">[SECOND_CHOICE]</td></tr>';
         * $content = str_replace($replace, '', $content);
         * }
         * // Sekolah Asal
         * $content = str_replace('[PREV_SCHOOL_NAME]', $dotted, $content);
         * // Alamat Sekolah Asal
         * $content = str_replace('[PREV_SCHOOL_ADDRESS]', $dotted, $content);
         *
         * // Profile
         * $content = str_replace('[FULL_NAME]', $dotted, $content);
         * $content = str_replace('[GENDER]', 'Laki-laki / Perempuan', $content);
         * if ($this->CI->session->school_level == 2 || $this->CI->session->school_level == 3 || $this->CI->session->school_level == 4) {
         * $content = str_replace('[NISN]', $dotted, $content);
         * } else {
         * $replace = '<tr><td align="right">NISN</td><td align="center">:</td><td align="left">[NISN]</td></tr>';
         * $content = str_replace($replace, '', $content);
         * }
         * if ($this->CI->session->school_level > 1) {
         * $content = str_replace('[NIK]', $dotted, $content);
         * } else {
         * $replace = '<tr><td align="right">NIK</td><td align="center">:</td><td align="left">[NIK]</td></tr>';
         * $content = str_replace($replace, '', $content);
         * }
         * $content = str_replace('[BIRTH_PLACE]', $dotted, $content);
         * $content = str_replace('[BIRTH_DATE]', $dotted, $content);
         * $content = str_replace('[RELIGION]', (count($params['religions']) > 0 ? implode(' / ', $params['religions']) : $dotted), $content);
         * $content = str_replace('[SPECIAL_NEEDS]', (count($params['special_needs']) > 0 ? implode(' / ', $params['special_needs']) : $dotted), $content);
         * // Alamat
         * $content = str_replace('[STREET_ADDRESS]', $dotted, $content);
         * $content = str_replace('[RT]', $dotted, $content);
         * $content = str_replace('[RW]', $dotted, $content);
         * $content = str_replace('[SUB_VILLAGE]', $dotted, $content);
         * $content = str_replace('[VILLAGE]', $dotted, $content);
         * $content = str_replace('[SUB_DISTRICT]', $dotted, $content);
         * $content = str_replace('[DISTRICT]', $dotted, $content);
         * $content = str_replace('[POSTAL_CODE]', $dotted, $content);
         * $content = str_replace('[EMAIL]', $dotted, $content);
         * $content = str_replace('[FOOTER_DATE]', '.............................................., ............. .................................... ' . $this->CI->session->admission_year, $content);
         * $content = str_replace('[FOOTER_FULL_NAME]', '....................................................................', $content);
         */
        $file_name = 'formulir-penerimaan';
        $file_name = strtoupper(str_replace(' ', '-', $file_name)) . '.pdf';
        $this->writeHTML($content, true, false, true, false, 'C');
        $this->Output(__DIR__ . '../../media_library/students/' . $file_name, 'I');
    }
}

/* End of file Admission.php */
/* Location: ./application/libraries/Admission.php */
