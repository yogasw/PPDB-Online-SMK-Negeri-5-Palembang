<div class="col-md-12">
    <div class="card">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4 text-right">
                <button class="btn"
                        onclick="tambah()">
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                    Tambah Data
                </button>
            </div>
        </div hidden>
        <div class="card-content">
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" method="post">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
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
                url: "<?php echo base_url('ajax/get_all_admin') ?>",
                type: 'POST'
            },
            "aoColumns": [
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<a href="#" onclick=delete_id("' + full[2] + '")><span class="label label-<?php rubah_warna() ?>">Hapus<span></a>' +
                            '<a href="#" onclick=edit_admin("' + full[2] + '")><span class="label label-<?php rubah_warna() ?>">Edit<span></a>'
                    }
                }
            ]
        });
    };

    function delete_id(username) {
        swal({
            title: 'Hapus Akun ini!!',
            text: "Apakah Anda yakin untuk menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/hapus_admin')?>",
                type: "POST",
                data: {username: username},
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

    function tambah() {
        swal({
            title: 'Edit Data',
            // language=HTML
            html: '<form id="myform" method="post">' +
                '<div class="row">' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Nama Lengkap</label>' +
                '<input type="text" name="name" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Username</label>' +
                '<input type="text" name="username" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password</label>' +
                '<input type="password" name="password" class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Jurusan</label>' +
                '<input type="text" name="jurusan" class="form-control" required="true">' +
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

    function edit_admin(username) {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/ambil_data_admin')?>",
            type: "POST",
            data: {username: username},
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
            // language=HTML
            html: '<form id="myform" method="post">' +
                '<div class="row">' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Nama Lengkap</label>' +
                '<input type="text" name="name" value="' + data[0].name + '" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Username</label>' +
                '<input type="text" name="username" value="' + data[0].username + '"class="form-control"required="true" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Password</label>' +
                '<input type="password" name="password" value="' + data[0].password + '" class="form-control" required="true">' +
                '</div></div>' +

                '<div class="col-xs-6">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Jurusan</label>' +
                '<input type="text" name="jurusan" class="form-control" value="' + data[0].jurusan + '" required="true">' +
                '</div></div>' +


                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button onclick="" id="buttton btn_kirim" name="btn_kirim" type="submit" class="btn btn-primary btn-round btn_kirim">' +
                'Kirim Data</button>' +
                '</div>' +
                '<input type="text" name="username" id="username" value="' + data[0].username + '" hidden>' +
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
            url: "<?php echo(base_url() . 'ajax/kirim_data_admin')?>",
            data: datastring,
            success: function () {
                swal({
                    title: 'Berhasil!',
                    text: 'Soal Berhasil Di Kirim!!',
                    type: 'success',
                    showConfirmButton: false,
                    buttonsStyling: false
                });
                table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    }
</script>