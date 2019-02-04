<script src="<?php echo(base_url()) ?>assets/js/jquery.simple.timer.js"></script>
<div class="card wizard-card" data-color="rose" id="wizardProfile">
    <form id="myform" action="<?php echo(base_url() . 'ajax/kirim_data_tpa') ?>" method="post">
                <div class="wizard-header">
                    <h3 class="wizard-title">
                        UJIAN ONLINE TPA PESERTA DIDIK BARU <br>SMK N 5 PALEMBANG
                    </h3>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="col-xs-4">
                                        <!-- <h4>Nomor Soal</h4> -->
                                    </div>
                                    <div class="col-xs-8">
                                        <?php
                                        //ambil sisa waktu
                                        echo('<h1 class="timer" data-minutes-left=' . $waktu . "></h1>");
                                        ?>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="card-content">
                                        <div class="row">
                                            <div id="example-basic">
                                                <?php $jmlh_data = 0 ?>
                                                <?php foreach ($data as $u) { ?>
                                                    <?php $jmlh_data = $jmlh_data + 1 ?>
                                                    <h3><?php echo($u['id']) ?></h3>
                                                    <section>
                                                        <h5><?php echo($jmlh_data) ?>. <?php echo($u['soal']) ?></h5>
                                                        <div class="radio">

                                                            <label>
                                                                <input type="radio" value="a" <?php
                                                                if (isset($jawaban[$u['id']])) {
                                                                    if ($jawaban[$u['id']] == 'a') {
                                                                        echo('checked="checked"');
                                                                    }
                                                                }
                                                                ?> name="<?php echo($u['id']) ?>">
                                                                <a>A. <?php echo($u['opsi_a']) ?></a>
                                                                </input>
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="b"<?php
                                                                if (isset($jawaban[$u['id']])) {
                                                                    if ($jawaban[$u['id']] == 'b') {
                                                                        echo('checked="checked"');
                                                                    }
                                                                }
                                                                ?>
                                                                       name="<?php echo($u['id']) ?>"><a>B. <?php echo($u['opsi_b']) ?></a>
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="c"<?php
                                                                if (isset($jawaban[$u['id']])) {
                                                                    if ($jawaban[$u['id']] == 'c') {
                                                                        echo('checked="checked"');
                                                                    }
                                                                }
                                                                ?>
                                                                       name="<?php echo($u['id']) ?>"><a>C. <?php echo($u['opsi_c']) ?></a>
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="d" <?php
                                                                if (isset($jawaban[$u['id']])) {
                                                                    if ($jawaban[$u['id']] == 'd') {
                                                                        echo('checked="checked"');
                                                                    }
                                                                }
                                                                ?>
                                                                       name="<?php echo($u['id']) ?>"><a>D. <?php echo($u['opsi_d']) ?></a>
                                                            </label>
                                                        </div>
                                                    </section>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="col-xs-8">
                                        <h4>Daftar Soal</h4>
                                    </div>
                                    <div class="col-xs-2" hidden>
                                        <button onclick="" id="buttton" type="submit" class="btn btn-success selesai">
                                            Selesai
                                        </button>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <?php $jmlh_data = 0 ?>
                                    <?php foreach ($data as $u) { ?>
                                        <div class="col-xs-3 nm_soal">
                                            <?php $jmlh_data = $jmlh_data + 1; ?>
                                            <a id="<?php echo("no" . $jmlh_data) ?>"
                                               onclick="goto(<?php echo($jmlh_data) ?>)" <span
                                                <?php
                                                if (isset($jawaban[$u['id']])) {
                                                    echo('class="label label-danger"');
                                                } else {
                                                    echo('class="label label-default"');
                                                } ?>
                                                ?>

                                                <?php echo($jmlh_data) ?></span></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<script type="text/javascript">
    var frm = $('#myform');
    $("#example-basic").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        enableFinishButton: true,
        onFinished: function (event, currentIndex) {
            frm.submit();
        }
    });
    $('ul[role="tablist"]').hide();
    $('ul[role="menuitem"]').hide();
    $(function () {
        $('input[type="radio"]').click(function () {
            if ($(this).is(':checked')) {
                var id = $("#example-basic").steps("getCurrentIndex") + 1;
                document.getElementById("no" + id).classList.remove('label-default');
                document.getElementById("no" + id).classList.add('label-danger');
            }
        });
    });
    $.fn.steps.setStep = function (step) {
        var currentIndex = $(this).steps('getCurrentIndex');
        for (var i = 0; i < Math.abs(step - currentIndex); i++) {
            if (step > currentIndex) {
                $(this).steps('next');
            }
            else {
                $(this).steps('previous');
            }
        }
    };
    function goto($id) {
        $("#example-basic").steps("setStep", ($id - 1));
    }
    frm.submit(function (ev) {
        var total = 0;
        $(":radio:checked").each(function () {
            total += 1;
        });
        if (total ==<?php echo($jmlh_data)?>) {
            kirimjawaban(this);
        } else {
            swal({
                title: 'Jawaban gagal di kirim!!',
                text: "Maaf jawaban anda gagal di kirim karena soal belum di jawab semuanya!!",
                type: 'error',
                showConfirmButton: false,
                buttonsStyling: false
            })
        }
        ev.preventDefault();
    });
    function kirimjawaban() {
        swal({
            title: 'Kirim Jawaban!!',
            text: "Apakah Anda yakin untuk mengirim jawaban anda?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Kirim!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function () {
                    swal({
                        title: 'Berhasil!',
                        text: 'Jawaban Berhasil Di Kirim!!',
                        type: 'success',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                    window.location = '<?php echo (base_url()) . "home"?>';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        });
    }
    function waktuHabis() {
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function () {
                window.location = '<?php echo (base_url()) . "home"?>';
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
        swal({
            title: 'Waktu habis!!',
            text: "Jawaban akan di kirim automatis",
            type: 'error',
            showConfirmButton: false,
            buttonsStyling: false
        });
    }
    function disableF5(e) {
        if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault();
    };
    $(document).ready(function () {
        //$(document).on("keydown", disableF5);
        $('.timer').startTimer({
            onComplete: function (element) {
                waktuHabis();
            }

        });
    });
</script>