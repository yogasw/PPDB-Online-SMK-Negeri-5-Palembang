</div>
</div>
<footer class="footer">
    <div class="container">
        <p class="copyright pull-right">
            &copy; Januari 2019
            <a href="mailto:yogainformatika@gmail.com">Arioki Dev</a>
        </p>
    </div>
</footer>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
    $().ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            $('.card').removeClass('card-hidden');
        }, 700);
        pasword();
    });

    function pasword() {
        $(".glyphicon-eye-open").hide();
        $("#passwordfield").on("keyup", function () {
            if ($(this).val())
                $(".glyphicon-eye-open").show();
            else
                $(".glyphicon-eye-open").hide();
        });
        $(".glyphicon-eye-open").mousedown(function () {
            $("#passwordfield").attr('type', 'text');
        }).mouseup(function () {
            $("#passwordfield").attr('type', 'password');
        }).mouseout(function () {
            $("#passwordfield").attr('type', 'password');
        });

    }

    <?php
    $CI = get_instance();
    $username = $CI->session->userdata('username');
    if (isset($username)) {
    ?>
    function ganti_pasword() {
        swal({
            title: 'Edit Password',
            html:
                '<form id="ganti_password" method="post">' +
                '<div class="input-group">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password Lama</label>' +
                '<input type="password" class="form-control" name="password_lama" id="passwordfield">' +
                '</div>' +
                '<span class="input-group-addon">' +
                '<span class="glyphicon glyphicon-eye-open"></span>' +
                '</span>' +
                '</div>' +

                '<div class="input-group">' +
                '<div class="form-group label-floating password">' +
                '<label class="control-label">Password Baru</label>' +
                '<input type="password" class="form-control" name="password_baru_1" id="password_baru_1">' +
                '</div>' +
                '<span class="input-group-addon">' +
                '<div class="icon_done icon icon-rose"  hidden>' +
                '<i class="material-icons">done</i>' +
                '</div>' +
                '</span>' +
                '</div>' +

                '<div class="input-group">' +
                '<div class="form-group label-floating password">' +
                '<label class="control-label">Ulangi Password Baru</label>' +
                '<input type="password" class="form-control" name="password_baru_2" id="password_baru_2">' +
                '</div>' +
                '<span class="input-group-addon">' +
                '<div class="icon_done icon icon-rose"  hidden>' +
                '<i class="material-icons">done</i>' +
                '</div>' +
                '</span>' +
                '</div>' +

                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button onclick="" id="buttton btn_kirim" value="b" name="btn_kirim" type="submit" class="btn btn-primary btn-round btn_kirim">' +
                'Ganti Password</button>' +
                '</div>' +
                '</form>'
            ,
            showConfirmButton: false,
            buttonsStyling: false
        });

        $(".glyphicon-eye-open").hide();
        $("#passwordfield").on("keyup", function () {
            if ($(this).val())
                $(".glyphicon-eye-open").show();
            else
                $(".glyphicon-eye-open").hide();
        });

        $('.btn_kirim').attr('disabled', 'disabled');
        var password_baru_1;
        var password_baru_2;
        $("#password_baru_1").on("keyup", function () {
            password_baru_1 = $(this).val();
            if (password_baru_1 == password_baru_2) {
                $(".icon_done").show();
                $('.btn_kirim').removeAttr('disabled');
            } else {
                $(".icon_done").hide();
                $('.btn_kirim').attr('disabled', 'disabled');
            }
        });

        $("#password_baru_2").on("keyup", function () {
            password_baru_2 = $(this).val();
            if (password_baru_1 == password_baru_2) {
                $(".icon_done").show();
                $('.btn_kirim').removeAttr('disabled');
            } else {
                $(".icon_done").hide();
                $('.btn_kirim').attr('disabled', 'disabled');
            }
        });

        $(".glyphicon-eye-open").mousedown(function () {
            $("#passwordfield").attr('type', 'text');
        }).mouseup(function () {
            $("#passwordfield").attr('type', 'password');
        }).mouseout(function () {
            $("#passwordfield").attr('type', 'password');
        });
    }

    $(document).on('submit', "#ganti_password", function (ev) {
        datastring = $(this).serialize();
        kirimdata();
        ev.preventDefault();
    });

    function kirimdata() {
        $.ajax({
            type: "POST",
            url: "<?php echo(base_url() . 'ajax/ganti_password')?>",
            data: datastring,
            respontype: "json",
            success: function (data) {
                var json1 = JSON.parse(data);
                if (json1['status']) {
                    swal({
                        title: 'Success!',
                        text: 'Password Berhasil di rubah',
                        type: 'success',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                } else {
                    swal({
                        title: 'Gagal!',
                        text: 'Password Salah!!',
                        type: 'error',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    }
    <?php } ?>
</script>