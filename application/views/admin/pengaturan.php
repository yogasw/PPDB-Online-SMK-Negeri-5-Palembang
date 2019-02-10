<div class="col-md-12">
    <div class="card">
        <div class="card-content">
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" method="post">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengaturan</th>
                            <th>Isi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
a<script type="text/javascript">
    var table;
    window.onload = function () {
        table = $('#datatables').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            ajax: {
                url: "<?php echo base_url('ajax/get_pengaturan') ?>",
                type: 'POST'
            },
            "aoColumns": [
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<a href="#" onclick=edit_pengaturan("' + full[1] + '")><span class="label label-<?php rubah_warna() ?>">Edit<span></a>'
                    }
                }
            ]
        });
    };

    function edit_pengaturan(id) {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/ambil_data_pengaturan')?>",
            type: "POST",
            data: {nama_pengaturan: id},
            success: function (data) {
                data = JSON.parse(data);
                edit(data[0]);
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

                '<div class="col-md-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Nama Pengaturan</label>' +
                '<input type="text" name="nama_pengaturan" value="' + data.nama_pengaturan + '" class="form-control"required="true">' +
                '</div></div>' +

                '<div class="col-md-12">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label">Isi</label>' +
                '<input type="' + data.tipe + '" name="isi" class="form-control" value="' + data.isi + '" required="true">' +
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

    $(document).on('submit', "#myform", function (ev) {
        datastring = $(this).serialize();
        kirimdata();
        ev.preventDefault();
    });

    function kirimdata() {
        $.ajax({
            type: "POST",
            url: "<?php echo(base_url() . 'ajax/kirim_data_pengaturan')?>",
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