<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form method="#" action="#" id="form_login" name="form_login">
            <div class="card card-login card-hidden">
                <div class="card-image" data-header-animation="true">
                    <a href="#pablo">
                        <img class="img" src="<?php echo(base_url()) ?>assets/img/logo.png">
                    </a>
                </div>
                <div class="card-header text-center" data-background-color="<?php rubah_warna() ?>"
                     data-header-animation="true">
                    <h4 class="card-title">Sistem PPDB SMK Negeri 5 Palembang</h4>
                </div>
                <div class="card-content">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Username atau NISN</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <span class="input-group-addon">
                        </span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <div class="form-group label-floating password">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordfield">
                        </div>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </span>
                    </div>
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-<?php rubah_warna() ?> btn-wd btn-small">Login</button>
                    <a href="<?php echo(base_url()) ?>pendaftaran">
                        <button type="button" name="daftar"
                                class="btn btn-<?php rubah_warna() ?> btn-wd btn-small">Daftar
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .card-header.text-center {
        background-color: #5cb85c;
    }
</style>
<script type="text/javascript">
    window.onload = function () {
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
    };
    $(document).on('submit', "#form_login", function (ev) {
        datastring = $(this).serialize();
        login();
        ev.preventDefault();
    });

    function login() {
        $.ajax({
            type: "POST",
            url: "<?php echo(base_url() . 'ajax/login')?>",
            data: datastring,
            respontype: "json",
            success: function (data) {
                var json1 = JSON.parse(data);
                if (json1['status']) {
                    swal({
                        title: 'Success!',
                        text: 'Login Berhasil!!',
                        type: 'success',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                    location.reload();
                } else {
                    swal({
                        title: 'Gagal!',
                        text: 'Username atau Password Salah!!',
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
</script>
