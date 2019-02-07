<div class="col-md-12">
    <div class="card">
        <div class="card-content">


            <div class="alert alert-rose alert-with-icon" data-notify="container">
                <i class="material-icons" data-notify="icon">notifications</i>
                <button type="button" aria-hidden="true" class="close">
                    <i class="material-icons">close</i>
                </button>
                <?php if ($hasil->status == "Diterima") { ?>
                    <span data-notify="message">Selamat anda telah di terima di SMK N 05 Palembang<br>Silahkan datang ke SMK N 5 Palembang untuk registrasi ulang</span>
                <?php }
                if ($hasil->status == "Ditolak") { ?>
                    <span data-notify="message">Maaf anda belum terima di SMK N 05 Palembang</span>
                <?php } ?>
            </div>
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
                        <?php
                        if (!$nilai_tpa) {
                            ?>
                            <a href="<?php echo(base_url() . "tpa") ?>" class="btn btn-rose btn-round">go</a>
                        <?php } else { ?>
                            <a href="#" onclick="lihat_nilai()" class="btn btn-rose btn-round">Lihat Nilai</a>
                        <?php } ?>
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
                        <a <?php echo 'href="' . base_url() . 'cetak_bukti"' ?> class="btn btn-rose btn-round">go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    <?php

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
    <?php if ($nilai_tpa) { ?>
    function lihat_nilai() {
        swal({
            title: 'Lihat Nilai',
            html:
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">NISN</label>' +
                '<input type="text" name="nisn" value="<?php echo $nilai_tpa['nisn'] ?>" class="form-control"disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Jumlah Benar</label>' +
                '<input type="number" value="<?php echo $nilai_tpa['jumlah_benar'] ?>" name="jml_benar" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Total Nilai</label>' +
                '<input type="number" value="<?php echo $nilai_tpa['nilai'] ?>" name="nilai" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Jumlah Salah</label>' +
                '<input type="text" value="<?php echo $nilai_tpa['jumlah_salah'] ?>" name="jumlah_salah" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Total Soal</label>' +
                '<input type="text" value=" <?php echo $nilai_tpa['jumlah_soal'] ?>" name="jumlah_soal" class="form-control" disabled>' +
                '</div></div>' +
                '</div>'
            ,
            showConfirmButton: false,
            buttonsStyling: false
        });
    }
    <?php } ?>
</script>