<div class="col-md-12">
    <div class="card">
        <div class="row">
            <div class="col-sm-4 col-xs-12"></div>
            <div class="col-sm-4 col-xs-12"></div>
            <div class="col-sm-4 col-xs-12 text-right">
                <button class="btn btn-<?php rubah_warna() ?>"
                "
                onclick="tambah()">
                <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                Tambah Data
                </button>
                <button class="btn btn-<?php rubah_warna2() ?>"
                        onclick="deletemultiple()">
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                    Hapus Data
                </button>
            </div>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" action="<?php echo(base_url() . 'ajax/kirim_quiz') ?>" method="post">
                        <thead>
                        <tr>
                            <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Soal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
    window.onload = function () {
        table = $('#datatables').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            ajax: {
                url: "<?php echo base_url('ajax/get_all_soal') ?>",
                type: 'POST',
            },
            "columnDefs": [
                {"orderable": false, "targets": 0}
            ],
            "aoColumns": [
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<input type="checkbox" class="select-row" data-id="' + full[1] + '" />'
                    }
                },
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<a href="#" onclick=delete_id("' + full[1] + '")><span class="label label-<?php rubah_warna2() ?>">Hapus<span></a>' +
                            '<a href="#" onclick=edit_soal("' + full[1] + '")><span class="label label-<?php rubah_warna() ?>">Edit<span></a>'
                    }
                }
            ]
        });
    };

    function delete_id(id) {
        swal({
            title: 'Hapus Soal!!',
            text: "Apakah Anda yakin untuk menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/hapus_soal')?>",
                type: "POST",
                data: {id: id},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Deleted!',
                        text: 'Soal Berhasil Di Hapus.',
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

    $('#example-select-all').on('click', function () {
        var rows = table.rows({'search': 'applied'}).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    function deletemultiple() {
        swal({
            title: 'Hapus Soal!!',
            text: "Apakah Anda yakin untuk menghapus semua data yang di pilih?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            var delete_selected = [];
            $(".select-row:checked").map(function () {
                delete_selected.push($(this).data('id'));
            });
            data_to_send = {
                id: delete_selected
            };
            $.ajax({
                data: data_to_send,
                method: 'post',
                dataType: 'json',
                url: 'http://arioki.web/ajax/multi_delete_soal',
                success: function (output) {
                    if (output.success) {
                        alert("berhasil");
                        location.reload();
                    }
                }
            });
            table.ajax.reload();
        })
    };

    function tambah() {
        swal({
            title: 'Tambah Data',
            // language=HTML
            html: '<form id="myform" method="post">' +
                '<div class="row">' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Mata Pelajaran</label>' +
                '<select name="id_mapel" id="id_mapel" class="form-control" required="true">' +
                '<option value="" selected>Mata Pelajaran</option>' +
                '<option value="1"> Ipa</option>' +
                '<option value="3"> B. Indonesia</option>' +
                '<option value="4"> B. Inggris</option>' +
                '<option value="2">Matematika</option>' +
                '</select>' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">jawaban</label>' +
                '<select name="Jawaban" id="jawaban" class="form-control" required="true">' +
                '<option value="" selected>----</option>' +
                '<option value="a">A</option>' +
                '<option value="b">B</option>' +
                '<option value="c">C</option>' +
                '<option value="d">D</option>' +
                '</select>' +
                '</div></div>' +

                '<div class="col-xs-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Soal</label>' +
                '<input type="text" name="soal" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi A</label>' +
                '<input type="text" name="opsi_a" class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi B</label>' +
                '<input type="text" name="opsi_b" class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi C</label>' +
                '<input type="text" name="opsi_c" class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi D</label>' +
                '<input type="text" name="opsi_d" class="form-control" required="true">' +
                '</div></div>' +

                '</div>' +

                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button onclick="" id="buttton btn_kirim" name="btn_kirim" type="submit" class="btn btn-<?php rubah_warna() ?> btn-round btn_kirim">' +
                'Kirim Data</button>' +
                '</div>' +
                '</form>'
            ,
            showConfirmButton: false,
            buttonsStyling: false
        })
    }

    function edit_soal(id) {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/ambil_data_soal')?>",
            type: "POST",
            data: {id: id},
            success: function (data) {
                data = JSON.parse(data);
                edit(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    }

    function edit(data) {
        swal({
            title: 'Edit Data',
            html: '<form id="myform" method="post">' +
                '<div class="row">' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Mata Pelajaran</label>' +
                '<select name="id_mapel" id="id_mapel" class="form-control" required="true">' +
                '<option value="' + data[0].id_mapel + '"  selected>Mata Pelajaran</option>' +
                '<option value="1"> Ipa</option>' +
                '<option value="3"> B. Indonesia</option>' +
                '<option value="4"> B. Inggris</option>' +
                '<option value="2">Matematika</option>' +
                '</select>' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">jawaban</label>' +
                '<select name="Jawaban" id="jk" class="form-control" required="true">' +
                '<option value="' + data[0].jawaban + '"selected>' + data[0].jawaban + '</option>' +
                '<option value="a">A</option>' +
                '<option value="b">B</option>' +
                '<option value="c">C</option>' +
                '<option value="d">D</option>' +
                '</select>' +
                '</div></div>' +

                '<div class="col-xs-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Soal</label>' +
                '<input type="text" value="' + data[0].soal + '"  name="soal" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi A</label>' +
                '<input type="text" name="opsi_a" value="' + data[0].opsi_a + '"  class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi B</label>' +
                '<input type="text" name="opsi_b" value="' + data[0].opsi_b + '"  class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi C</label>' +
                '<input type="text" name="opsi_c" value="' + data[0].opsi_c + '"  class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Opsi D</label>' +
                '<input type="text" name="opsi_d" value="' + data[0].opsi_d + '"  class="form-control" required="true">' +
                '</div></div>' +
                '</div>' +
                '<input value="' + data[0].id + '" name="id" hidden> '+
                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button onclick="" id="buttton btn_kirim" value="b' + data[0].opsi_b + '"  name="btn_kirim" type="submit" class="btn btn-primary btn-round btn_kirim">' +
                'Kirim Data</button>' +
                '</div>' +
                '</form>'
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
            url: "<?php echo(base_url() . 'ajax/kirim_data_soal')?>",
            data: datastring,
            respontype: "json",
            success: function (data) {
                var json1 = JSON.parse(data);
                if (json1['status']) {
                    swal({
                        title: 'Berhasil!',
                        text: 'Soal Berhasil Di Kirim!!',
                        type: 'success',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                    table.ajax.reload();
                }else {
                    swal({
                        title: 'Error!',
                        text: 'Data gagal di kirim!!',
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