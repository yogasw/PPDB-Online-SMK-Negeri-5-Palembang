<div class="card wizard-card" data-color="rose" id="wizardProfile">
    <form action="#" method="post" novalidate="novalidate">
                    <div class="wizard-header">
                        <h3 class="wizard-title">
                            FORM PENDAFTARAN SISWA BARU <br>SMK 05 PALEMBANG
                        </h3>
                        <h5>Tambah Data Baru.</h5>
                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">
                            <li class="active" style="width: 33.3333%;">
                                <a href="#step1" data-toggle="tab" aria-expanded="true">Step I</a>
                            </li>
                            <li style="width: 33.3333%;">
                                <a href="#step2" data-toggle="tab">Step II</a>
                            </li>
                            <li style="width: 33.3333%;">
                                <a href="#step3" data-toggle="tab">Step III</a>
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
                                       value=" <?php echo(get_setting('tahun_ajaran_ppdb')) ?>" hidden>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nama Lengkap</label>
                                        <input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">NISN</label>
                                        <input name="nisn" id="nisn" type="number" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tahun Lulus</label>
                                        <input name="tahun_lulus" id="tahun_lulus" type="number" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Jurusan Yang di Pilih</label>
                                        <select name="jurusan" id="jurusan" class="form-control" required="true">
                                            <option value="..."
                                                    selected></option>
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
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Jenis Kelamin</label>
                                        <select name="jk" id="jk" class="form-control" required="true">
                                            <option value=""
                                                    selected>...
                                            </option>
                                            <option value="Pria"> Pria</option>
                                            <option value="Wanita"> Wanita</option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Agama</label>
                                        <select name="agama" id="agama" class="form-control" required="true">
                                            <option value=""
                                                    selected>...
                                            </option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Kristen Katolik">Kristen Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                               required="true" style="text-transform: uppercase"
                                               value="">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                               required="true" style="text-transform: uppercase"
                                               value="">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">No. HP</label>
                                        <input type="number" name="no_hp" id="no_hp" class="form-control" number="true"
                                               required="true" value=""/>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Email</label>
                                        <input type="text" class="form-control" id="email" email="true" name="email"
                                               required="true" style="text-transform: lowercase"
                                               value="">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Negara</label>
                                        <select name="negara" class="form-control" id="negara" required="true">
                                            <option value=""
                                                    selected></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Provinsi</label>
                                        <select id="provinsi" name="provinsi" class="form-control" required="true">
                                            <option value=""
                                                    selected></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Kota</label>
                                        <select name="kota" id="kota" class="form-control" required="true">
                                            <option value=""
                                                    selected></option>
                                        </select>
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="step2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text">Nilai UN</h4>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai IPA</label>
                                        <input name="nilai_ipa" id="nilai_ipa" type="number" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai matematika</label>
                                        <input name="nilai_matematika" id="nilai_matematika" type="number"
                                               class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai Bahasa Indonesia</label>
                                        <input name="nilai_bhs_indonesia" id="nilai_bhs_indonesia" type="number"
                                               class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai Bahasa Inggris</label>
                                        <input name="nilai_bhs_inggris" id="nilai_bhs_inggris" type="number"
                                               class="form-control"
                                               value=""
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
                                        <input name="nilai_pai" id="nilai_pai" type="number" class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai PKN</label>
                                        <input name="nilai_pkn" id="nilai_pkn" type="number"
                                               class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group label-floating is-empty">
                                        <label class="label-control">Nilai IPS</label>
                                        <input name="nilai_ips" id="nilai_ips" type="number"
                                               class="form-control"
                                               value=""
                                               style="text-transform: uppercase" required="true">
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="step3">
                            <div class="col-sm-12">
                                <h3 class="info-text">Pernyataan</h3>
                            </div>
                            <p>Saya menyatakan dengan sesungguhnya bahwa isian data dalam formulir ini adalah benar.
                                Apabila ternyata data tersebut tidak benar / palsu, maka saya bersedia menerima sanksi
                                berupa Pembatalan sebagai Calon Peserta Didik SMA Negeri 5 Palembang
                            </p>
                            <row class="text-center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms" class="label-control" id="terms"
                                               required="true"><a>Saya Setuju</a>
                                    </label>
                                </div>
                            </row>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" id="next"
                                   value="Next">
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
    </form>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#nama_lengkap').keypress(function (e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });

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
                    minlength: 3
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
            var nama_lengkap = $('#nama_lengkap').val();
            var no_peserta = $('#no_peserta').val();
            var tahun_ajaran = $('#tahun_ajaran').val();
            var nisn = $('#nisn').val();
            var tahun_lulus = $('#tahun_lulus').val();
            var jurusan = $('#jurusan').val();
            var asal_sekolah = $('#asal_sekolah').val();
            var jk = $('#jk').val();
            var agama = $('#agama').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tanggal_lahir = $('#tanggal_lahir').val();
            var no_hp = $('#no_hp').val();
            var email = $('#email').val();
            var alamat = $('#alamat').val();
            var negara = $('#negara').val();
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
            var term = $('#terms').is(':checked');
            if (term) {
                swal({
                    title: 'Silahkan Tunggu..',
                    text: 'Data Sedang Di Proses..!',
                    allowOutsideClick: false,
                    onOpen: function () {
                        swal.showLoading()
                    }
                });
                $.post(
                    '<?php echo(base_url() . "ajax/tambah_siswa") ?>',
                    {
                        nama_lengkap: nama_lengkap,
                        no_peserta: no_peserta,
                        nisn: nisn,
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
                        negara: negara,
                        kota: kota,
                        nilai_ipa: nilai_ipa,
                        nilai_matematika: nilai_matematika,
                        tahun_ajaran: tahun_ajaran,
                        nilai_bhs_indonesia: nilai_bhs_indonesia,
                        nilai_bhs_inggris: nilai_bhs_inggris,
                        nilai_pai: nilai_pai,
                        nilai_pkn: nilai_pkn,
                        nilai_ips: nilai_ips
                    },
                    function (data) {
                        if (data["status"]) {
                            (swal({
                                title: 'Sukses',
                                text: 'Data berhasil di kirim',
                                type: 'success',
                                confirmButtonClass: "btn btn-success",
                                showConfirmButton: false,
                                buttonsStyling: false
                            }))
                            window.location = '<?php echo (base_url()) . "/keluar"?>';
                        }
                        else {
                            swal({
                                title: 'Maaf',
                                text: 'Data gagal di perbarui, silahkan hub panitia',
                                type: 'error',
                                confirmButtonClass: "btn btn-success",
                                showConfirmButton: false,
                                buttonsStyling: false
                            })
                        }
                    }
                );
            } else {
                $('.wizard-card form').valid();
                swal({
                    title: 'Maaf!',
                    text: 'Setujui Formuir ini terlebih dahulu',
                    type: 'error',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
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

        $("#nisn").change(function () {
            $.ajax({
                url: '<?php echo(base_url() . "ajax/cek_nisn") ?>',
                data: {nisn: $('#nisn').val()},
                type: "post",
                respontype: "json",
                timeout: 10000,
                success: function (response) {
                    if (response == "true") {
                        document.getElementById("next").disabled = true;
                        swal({
                            title: 'Maaf',
                            text: 'Data NISN Sudah di pakai',
                            type: 'error',
                            confirmButtonClass: "btn btn-success",
                            showConfirmButton: false,
                            buttonsStyling: false
                        })
                    } else {
                        document.getElementById("next").disabled = false;
                    }
                }
            });
        });
    });

</script>
