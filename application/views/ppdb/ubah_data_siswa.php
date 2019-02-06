<div class="card wizard-card" data-color="rose" id="wizardProfile">
    <form action="" method="post" novalidate="novalidate">
                <?php foreach ($data as $u) { ?>
                    <div class="wizard-header">
                        <h3 class="wizard-title">
                            PENDAFTARAN PESERTA DIDIK BARU <br>SMK 05 PALEMBANG
                        </h3>
                        <h5>Ubah Data.</h5>
                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">
                            <li class="active" style="width: 33.3333%;">
                                <a href="#step1" data-toggle="tab" aria-expanded="true">Step I</a>
                            </li>
                            <li style="width: 33.3333%;">
                                <a href="#step2" data-toggle="tab">Step II</a>
                            </li>
                        </ul>
                        <div class="moving-tab"
                             style="width: 222.443px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
                            Step I
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="step1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text">Form Biodata Calon Siswa Baru</h4>
                                </div>
                                <input name="tahun_ajaran" id="tahun_ajaran"
                                       value="<?php echo(get_setting('tahun_ajaran_ppdb')) ?>" hidden>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nama Lengkap</label>
                                        <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control"
                                               value="<?php echo($u['nama_lengkap']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">NISN</label>
                                        <input name="nisn" id="nisn" type="text" class="form-control"
                                               value="<?php echo($u['nisnsiswa']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tahun Lulus</label>
                                        <input name="tahun_lulus" id="tahun_lulus" type="text" class="form-control"
                                               value="<?php echo($u['tahun_lulus']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Jurusan Yang di Pilih</label>
                                        <select name="jurusan" id="jurusan" class="form-control" required="true">
                                            <option value="<?php echo($u['jurusan']) ?>"
                                                    selected><?php echo($u['jurusan']) ?></option>
                                            <option value="akuntansi">Akuntansi</option>
                                            <option value="administrasiperkantoran">Administrasi Perkantoran</option>
                                            <option value="pemasaran">Pemasaran</option>
                                            <option value="animasi">Animasi</option>
                                            <option value="multimedia">Multimedia</option>
                                            <option value="tp4">Teknik Produksi dan Penyiaran Program Pertelevisian
                                            </option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Asal Sekolah</label>
                                        <input name="asal_sekolah" id="asal_sekolah" type="text" class="form-control"
                                               value="<?php echo($u['asal_sekolah']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Jenis Kelamin</label>
                                        <select name="jk" id="jk" class="form-control" required="true">
                                            <option value="<?php echo($u['jk']) ?>"
                                                    selected><?php echo($u['jk']) ?></option>
                                            <option value="Pria"> Pria</option>
                                            <option value="Wanita"> Wanita</option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Agama</label>
                                        <select name="agama" id="agama" class="form-control" required="true">
                                            <option value="<?php echo($u['agama']) ?>"
                                                    selected><?php echo($u['agama']) ?></option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Kristen Katolik">Kristen Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3 form-inline">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tempat Lahir</label>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <select name="tanggal" id="tanggal" class="form-control"
                                                        required="true">
                                                    <?php
                                                    $tl = explode("-", $u['tanggal_lahir']);
                                                    if ($tl[2] != '') {
                                                        echo('<option value=' . $tl[2] . '>' . $tl[2] . '</option>');
                                                    } else {
                                                        echo('<option value="">Tanggal</option>');
                                                    }
                                                    for ($i = 1; $i <= 31; $i++) {
                                                        echo('<option value=' . $i . '>' . $i . '</option>');
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="bulan" id="bulan" class="form-control"
                                                        required="true">
                                                    <?php
                                                    $list_months = [
                                                        'Januari',
                                                        'Febuari',
                                                        'Maret',
                                                        'April',
                                                        'Mei',
                                                        'Juni',
                                                        'Juli',
                                                        'Augustus',
                                                        'September',
                                                        'October',
                                                        'November',
                                                        'Desember'
                                                    ];
                                                    if ($tl[1] != '') {
                                                        echo('<option value=' . $tl[1] . '>' . $list_months[$tl[1] - 1] . '</option>');
                                                    } else {
                                                        echo('<option value="">Bulan</option>');
                                                    }
                                                    $bulan = 1;
                                                    for ($i = 0; $i < count($list_months); $i++) {
                                                        echo('<option value=' . $bulan . '>' . $list_months[$i] . '</option>');
                                                        $bulan++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="tahun" id="tahun" class="form-control"
                                                        required="true">
                                                    <?php
                                                    if ($tl[0] != '') {
                                                        echo('<option value=' . $tl[0] . '>' . $tl[0] . '</option>');
                                                    } else {
                                                        echo('<option value="">Tahun</option>');
                                                    }
                                                    for ($i = 2015; $i >= 1960; $i--) {
                                                        echo('<option value=' . $i . '>' . $i . '</option>');
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                               required="true" style="text-transform: uppercase"
                                               value="<?php echo($u['tempat_lahir']) ?>">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">No. HP</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" number="true"
                                               required="true" value="<?php echo($u['no_hp']) ?>"/>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Email</label>
                                        <input type="text" class="form-control" id="email" email="true" name="email"
                                               required="true" style="text-transform: lowercase"
                                               value="<?php echo($u['email']) ?>">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                               value="<?php echo($u['alamat']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Negara</label>
                                        <select name="negara" class="form-control" id="negara" required="true">
                                            <option value="<?php echo($u['negara']) ?>"
                                                    selected><?php echo(description_lokasi($u['negara'])) ?></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Provinsi</label>
                                        <select id="provinsi" name="provinsi" class="form-control" required="true">
                                            <option value="<?php echo($u['provinsi']) ?>"
                                                    selected><?php echo(description_lokasi($u['provinsi'])) ?></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Kota</label>
                                        <select name="kota" id="kota" class="form-control" required="true">
                                            <option value="<?php echo($u['kota']) ?>"
                                                    selected><?php echo(description_lokasi($u['kota'])) ?></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="step2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text">Form Nilai UN</h4>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai IPA</label>
                                        <input name="nilai_ipa" id="nilai_ipa" type="text" class="form-control"
                                               value="<?php echo($u['ipa']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai Matematika</label>
                                        <input name="nilai_matematika" id="nilai_matematika" type="text"
                                               class="form-control"
                                               value="<?php echo($u['matematika']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai Bahasa Indonesia</label>
                                        <input name="nilai_bhs_indonesia" id="nilai_bhs_indonesia" type="text"
                                               class="form-control"
                                               value="<?php echo($u['bhs_indonesia']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai Bahasa Inggris</label>
                                        <input name="nilai_bhs_inggris" id="nilai_bhs_inggris" type="text"
                                               class="form-control"
                                               value="<?php echo($u['bhs_inggris']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text">Nilai USBN</h4>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai PAI</label>
                                        <input name="nilai_pai" id="nilai_pai" type="text" class="form-control"
                                               value="<?php echo($u['pai']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai PKN</label>
                                        <input name="nilai_pkn" id="nilai_pkn" type="text"
                                               class="form-control"
                                               value="<?php echo($u['pkn']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai IPS</label>
                                        <input name="nilai_ips" id="nilai_ips" type="text"
                                               class="form-control"
                                               value="<?php echo($u['ips']) ?>"
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                            <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish"
                                   id="finish"
                                   value="Finish" style="display: none;">
                        </div>
                        <div class="pull-left">
                            <input type="submit" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                                   name="previous" value="Previous">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
            </form>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        // Code for the Validator
        var $validator = $('.wizard-card form').validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 3
                },
                lastname: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    minlength: 3,
                }
            },

            errorPlacement: function (error, element) {
                $(element).parent('div').addClass('has-error');
            }
        });
        // Wizard Initialization
        $('.wizard-card').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function (tab, navigation, index) {
                var $valid = $('.wizard-card form').valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },

            onInit: function (tab, navigation, index) {

                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                $width = 100 / $total;
                var $wizard = navigation.closest('.wizard-card');

                $display_width = $(document).width();

                if ($display_width < 600 && $total > 3) {
                    $width = 50;
                }

                navigation.find('li').css('width', $width + '%');
                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);
                refreshAnimation($wizard, index);
                $('.moving-tab').css('transition', 'transform 0s');
            },

            onTabClick: function (tab, navigation, index) {
                var $valid = $('.wizard-card form').valid();

                if (!$valid) {
                    return false;
                } else {
                    return true;
                }
            },

            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('.wizard-card');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function () {
                    $('.moving-tab').text(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if (!index == 0) {
                    $(checkbox).css({
                        'opacity': '0',
                        'visibility': 'hidden',
                        'position': 'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                }

                refreshAnimation($wizard, index);
            }
        });

        $('[data-toggle="wizard-radio"]').click(function () {
            wizard = $(this).closest('.wizard-card');
            wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
            $(this).addClass('active');
            $(wizard).find('[type="radio"]').removeAttr('checked');
            $(this).find('[type="radio"]').attr('checked', 'true');
        });

        $('[data-toggle="wizard-checkbox"]').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).find('[type="checkbox"]').removeAttr('checked');
            } else {
                $(this).addClass('active');
                $(this).find('[type="checkbox"]').attr('checked', 'true');
            }
        });

        $('.set-full-height').css('height', 'auto');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(window).resize(function () {
            $('.wizard-card').each(function () {
                $wizard = $(this);
                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimation($wizard, index);

                $('.moving-tab').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimation($wizard, index) {
            total_steps = $wizard.find('li').length;
            move_distance = $wizard.width() / total_steps;
            step_width = move_distance;
            move_distance *= index;

            $current = index + 1;

            if ($current == 1) {
                move_distance -= 8;
            } else if ($current == total_steps) {
                move_distance += 8;
            }


            $wizard.find('.moving-tab').css('width', step_width);
            $('.moving-tab').css({
                'transform': 'translate3d(' + move_distance + 'px, 0, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }

        $('#finish').click(function () {
            var tahun_ajaran = $('#tahun_ajaran').val();
            var nama_lengkap = $('#nama_lengkap').val();
            var no_peserta = $('#no_peserta').val();
            var nisn = $('#nisn').val();
            var tahun_lulus = $('#tahun_lulus').val();
            var jurusan = $('#jurusan').val();
            var asal_sekolah = $('#asal_sekolah').val();
            var jk = $('#jk').val();
            var agama = $('#agama').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tanggal_lahir = $('#tahun').val() + '-' + $('#bulan').val() + '-' + $('#tanggal').val();
            console.log(tanggal_lahir);
            var no_hp = $('#no_hp').val();
            var email = $('#email').val();
            var alamat = $('#alamat').val();
            var provinsi = $('#provinsi').val();
            var negara = $('#negara').val();
            var kota = $('#kota').val();
            var nilai_ipa = $('#nilai_ipa').val();
            var nilai_matematika = $('#nilai_matematika').val();
            var nilai_bhs_indonesia = $('#nilai_bhs_indonesia').val();
            var nilai_bhs_inggris = $('#nilai_bhs_inggris').val();

            var nilai_pai = $('#nilai_pai').val();
            var nilai_pkn = $('#nilai_pkn').val();
            var nilai_ips = $('#nilai_ips').val();

            if (
                nilai_matematika == "" ||
                nilai_ipa == "" ||
                nilai_bhs_indonesia == "" ||
                nilai_bhs_inggris == "" ||
                nilai_pai == "" ||
                nilai_pkn == "" ||
                nilai_ips == ""

            ) {
                swal({
                    title: 'Maaf Cuy!',
                    text: 'Lengkapi semua datanya dulu ya',
                    type: 'error',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
            } else {
                swal({
                    title: 'Silahkan Tunggu..',
                    text: 'Data Sedang Di Proses..!',
                    allowOutsideClick: false,
                    onOpen: function () {
                        swal.showLoading()
                    }
                });

                $.post(
                    '<?php echo(base_url() . "ajax/ubahdata_siswa") ?>',
                    {
                        nama_lengkap: nama_lengkap,
                        no_peserta: no_peserta,
                        nisn: nisn,
                        tahun_ajaran: tahun_ajaran,
                        tahun_lulus: tahun_lulus,
                        jurusan: jurusan,
                        asal_sekolah: asal_sekolah,
                        jk: jk,
                        agama: agama,
                        tempat_lahir: tempat_lahir,
                        tanggal_lahir: tanggal_lahir,
                        no_hp: no_hp,
                        email: email,
                        alamat: alamat,
                        negara: negara,
                        provinsi: provinsi,
                        kota: kota,
                        nilai_ipa: nilai_ipa,
                        nilai_matematika: nilai_matematika,
                        nilai_bhs_indonesia: nilai_bhs_indonesia,
                        nilai_bhs_inggris: nilai_bhs_inggris,
                        nilai_pai: nilai_pai,
                        nlai_pkn: nilai_pkn,
                        nilai_ips: nilai_ips

                    },
                    function (data) {
                        if (data["status"]) {
                            (swal({
                                title: 'Mantap Cuy!',
                                text: 'Data berhasil di perbarui',
                                type: 'success',
                                confirmButtonClass: "btn btn-success",
                                showConfirmButton: false,
                                buttonsStyling: false
                            }))
                            window.location = '<?php echo (base_url()) . "home"?>';
                        }
                        else {
                            swal({
                                title: 'Maaf Cuy!',
                                text: 'Data gagal di perbarui, silahkan hub panitia',
                                type: 'error',
                                confirmButtonClass: "btn btn-success",
                                showConfirmButton: false,
                                buttonsStyling: false
                            })
                        }
                    }
                );
            }

        });
        $.ajax({
            url: '<?php echo(base_url() . "ajax/data_lokasi") ?>',
            data: {parent_id: '3'},
            type: "post",
            timeout: 10000,
            success: function (response) {
                for (var i = 0; i < response.length; i++) {
                    addElement(response[i], 'negara');
                }
            }
        });
        function addElement(str, id) {
            var el = document.createElement('option');
            el.innerHTML = str;
            var frag = document.getElementById(id);
            return frag.appendChild(el.removeChild(el.firstChild));
        }

        $("#negara").change(function () {
            $.ajax({
                url: '<?php echo(base_url() . "ajax/data_lokasi") ?>',
                data: {parent_id: $('#negara').val()},
                type: "post",
                timeout: 10000,
                success: function (response) {
                    $('#provinsi').html(response);
                }
            });

        });
        $("#provinsi").change(function () {
            $.ajax({
                url: '<?php echo(base_url() . "ajax/data_lokasi") ?>',
                data: {parent_id: $('#provinsi').val()},
                type: "post",
                timeout: 10000,
                success: function (response) {
                    $('#kota').html(response);
                }
            });
        });

        $("#kabupaten").change(function () {
        });
    });

</script>
