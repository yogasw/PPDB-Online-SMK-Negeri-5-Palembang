<div class="col-md-12">
    <div class="card">
        <div class="col-md-4">
            <div class="card card-pricing ">
                <div class="card-content">
                    <div class="icon icon-rose">
                        <i class="material-icons">assessment</i>
                    </div>
                    <h3 class="card-title">Ubah Data</h3>
                    <p class="card-description">
                        Ubah data yang telah di masukan
                    </p>
                    <a href="<?php echo(base_url() . "ubahdata") ?>" class="btn btn-rose btn-round">go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-pricing ">
                <div class="card-content">
                    <div class="icon icon-rose">
                        <i class="material-icons">import_contacts</i>
                    </div>
                    <h3 class="card-title">Ujian Online</h3>
                    <p class="card-description">
                        Ikuti Ujian Online, Ketika sudah di buka oleh admin
                    </p>
                    <a href="<?php echo(base_url() . "tpa") ?>" class="btn btn-rose btn-round">go</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-pricing ">
                <div class="card-content">
                    <div class="icon icon-rose">
                        <i class="material-icons">sentiment_satisfied_alt</i>
                    </div>
                    <h3 class="card-title">Cetak Bukti Pendaftaran</h3>
                    <p class="card-description">
                        Cetak Bukti Pendaftaran sebagai bukti anda sudah mendaftar
                    </p>
                    <a <?php
                    $CI = get_instance();
                    $CI->load->model('m_ajax');
                    if ($CI->m_ajax->cek_verifikasi($this->session->userdata('username'))) {
                        echo 'href="' . base_url() . 'cetak_bukti"';
                    } else {
                        echo 'href="#" onclick=cetak_gagal()';
                    } ?> class="btn btn-rose btn-round">go</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    <?php
    $error = $CI->input->get('error');
    if ($error == "soal") {
        echo "soal_error();";
    }
    ?>

    function cetak_gagal() {
        swal({
            title: 'Maaf!',
            text: 'Akun anda belum di Verifikasi oleh admin, Silahkan tunggu.',
            type: 'error',
            confirmButtonClass: "btn btn-success",
            buttonsStyling: false
        });
    }

    function soal_error() {
        swal({
            title: 'Maaf!',
            text: 'Soal anda belum di aktifkan atau waktu anda sudah habis',
            type: 'error',
            confirmButtonClass: "btn btn-success",
            buttonsStyling: false
        });
    }
</script>