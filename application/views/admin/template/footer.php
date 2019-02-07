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
        }, 700)
    });

    function ganti_pasword() {
        swal({
            title: 'Edit Data',
            // language=HTML
            html: '<form id="myform" method="post">' +
                '<div class="row">' +

                '<div class="col-xs-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password Lama</label>' +
                '<input type="text" name="soal" class="form-control" rel="tooltip" title="Input Password Lama Anda" required="true">' +
                '</div></div>' +

                '<div class="col-xs-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password Baru</label>' +
                '<input type="text" name="soal" class="form-control" rel="tooltip" title="Input Password Baru Anda" required="true">' +
                '</div></div>' +

                '<div class="col-xs-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Ulangi Password Baru</label>' +
                '<input type="text" name="soal" class="form-control" rel="tooltip" title="Input Kembali Password Baru Anda" required="true">' +
                '</div></div>' +

                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button onclick="" id="buttton btn_kirim" name="btn_kirim" type="submit" class="btn btn-primary btn-round btn_kirim">' +
                'Kirim Data</button>' +
                '</div>' +
                '</form>'
            ,
            showConfirmButton: false,
            buttonsStyling: false
        })
    }
</script>