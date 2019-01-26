<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form method="#" action="#" id="form_login" name="form_login">
            <div class="card card-login card-hidden">
                <div class="card-image" data-header-animation="true">
                    <a href="#pablo">
                        <img class="img" src="<?php echo(base_url()) ?>assets/img/logo.png">
                    </a>
                </div>
                <div class="card-header text-center" data-background-color="rose" data-header-animation="true">
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
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock_outline</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Login</button>
                    <a href="<?php echo(base_url()) ?>pendaftaran">
                        <button type="button" name="daftar" class="btn btn-rose btn-simple btn-wd btn-lg">Daftar
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).on('submit', "#form_login", function (ev) {
        datastring = $(this).serialize();
        kirimdata();
        ev.preventDefault();
    });

    function kirimdata() {
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