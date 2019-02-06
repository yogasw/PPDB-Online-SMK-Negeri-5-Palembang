<div class="col-md-12">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 table-bordered">
                    <div class="form-group">
                        <select name="filter_jurusan" id="filter_jurusan" class="form-control" required>
                            <option value="" <?php if (isset($filter) && $filter == "") echo "selected" ?>>Semua
                                Jurusan
                            </option>
                            <option value="akuntansi" <?php if (isset($filter) && $filter == "akuntansi") echo "selected" ?>>
                                Akuntansi
                            </option>
                            <option value="administrasiperkantoran" <?php if (isset($filter) && $filter == "administrasiperkantoran") echo "selected" ?>>
                                Administrasi Perkantoran
                            </option>
                            <option value="pemasaran" <?php if (isset($filter) && $filter == "pemasaran") echo "selected" ?>>
                                Pemasaran
                            </option>
                            <option value="animasi" <?php if (isset($filter) && $filter == "animasi") echo "selected" ?>>
                                Animasi
                            </option>
                            <option value="multimedia" <?php if (isset($filter) && $filter == "multimedia") echo "selected" ?>>
                                Multimedia
                            </option>
                            <option value="tp4" <?php if (isset($filter) && $filter == "tp4") echo "selected" ?>>Teknik
                                Produksi dan Penyiaran Program Pertelevisian
                        </select>
                    </div>
                    <div class="form-group" align="center">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>No. Peserta</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;

    function aktifkan(id) {
        swal({
            title: 'Aktifkan soal!!',
            text: "Apakah Anda mengaktifkan soal?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/aktifkan_nilai_tpa')?>",
                type: "POST",
                data: {nisn: id, status: '1'},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Aktif!',
                        text: 'Soal Berhasil Di Aktifkan.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    });
                    table.ajax.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Sepertinya sudah aktif", "error");
                }
            });


        });
    }

    $('#filter').click(function () {
        var filter = $('#filter_jurusan').val();
        $.ajax({
            url: '<?php echo(base_url() . 'admin/filter/')?>' + filter,
            type: "GET",
            success: function (data) {
                table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });

    window.onload = function () {
        table = $('#datatables').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            ajax: {
                url: "<?php echo base_url('ajax/ambil_data_pendaftaran_tpa') ?>",
                type: 'POST'
            },
            "columnDefs": [
                {"orderable": false, "targets": 0}
            ],
            "aoColumns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        if (full[0] == "" || full[0] == null) {
                            return '<a href="#" onclick=newswal("' + full[3] + '")><span class="label label-primary">Lihat Nilai<span></a>' +
                                '<a href="#" onclick=aktifkan("' + full[3] + '")><span class="label label-primary">Aktifkan<span></a>'
                        } else {
                            return '<a href="#" onclick=newswal("' + full[3] + '")><span class="label label-primary">Lihat Nilai<span></a>' +
                                '<a href="#" onclick=reset("' + full[3] + '")><span class="label label-primary">Reset<span></a>'
                        }
                    }
                }
            ]
        });
        $('#datatables').DataTable().column(0).visible(false);
        $('#datatables').DataTable().column(3).visible(false);
    };

    function newswal(id) {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/ambil_data_tpa')?>",
            type: "POST",
            data: {nisn: id},
            success: function (data) {
                data = JSON.parse(data);
                try {
                    edit(data)
                } catch {
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    }

    function edit(data) {
        var btn = "button";
        swal({
            title: 'Lihat Jawaban',
            html:
                '<input name="nisn" value="' + data[0].nisn_siswa + '" hidden>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">NISN</label>' +
                '<input type="text" name="nisn" value="' + data[0].nisn_siswa + '" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Nama</label>' +
                '<input type="text" name="nama" value="' + data[0].nama_lengkap + '" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Daftar Soal</label>' +
                '<input type="text" value="' + data[0].list_soal + '" name="list_soal" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Daftar Jawaban</label>' +
                '<input type="text" value="' + data[0].list_jawaban + '" name="list_jawaban" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Jumlah Benar</label>' +
                '<input type="number" value="' + data[0].jml_benar + '" name="jml_benar" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Total Nilai</label>' +
                '<input type="number" value="' + data[0].nilai + '" name="nilai" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Waktu Mulai Menjawab</label>' +
                '<input type="date-time" value="' + data[0].tgl_mulai + '" name="tgl_mulai" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Waktu Selesai</label>' +
                '<input type="date-time" value="' + data[0].tgl_selesai + '" name="tgl_selesai" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating" hidden>' +
                '<label class="control-label">Status</label>' +
                '<input type="text" value="' + data[0].status + '" name="status" class="form-control" disabled>' +
                '</div></div>'
            ,
            showConfirmButton: false,
            buttonsStyling: false
        })
    }

    $(document).on('submit', "#myform", function (ev) {
        datastring = $(this).serialize();
        kirimdata();
        ev.preventDefault();
    });

    function kirimdata() {
        $.ajax({
            type: "POST",
            url: "<?php echo(base_url() . 'ajax/kirim_data_tpa_admin')?>",
            data: datastring,
            success: function () {
                swal({
                    title: 'Berhasil!',
                    text: 'Jawaban Berhasil Di Kirim!!',
                    type: 'success',
                    showConfirmButton: false,
                    buttonsStyling: false
                });
                //table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    }

    function reset(id) {
        swal({
            title: 'Reset Jawaban!!',
            text: "Apakah Anda yakin untuk mereset data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/reset_nilai_tpa')?>",
                type: "POST",
                data: {nisn: id},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Reset!',
                        text: 'Jawaban Berhasil Di Reset.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    });
                    table.ajax.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });


        });
    }
</script>