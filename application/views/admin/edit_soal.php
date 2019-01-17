<div class="col-md-12">
    <div class="card">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4 text-right">
                <button class="btn"
                        onclick="window.location.href='<?php echo(base_url() . 'admin/tambahdata_siswa') ?>'">
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                    Tambah Data
                </button>
                <button class="btn"
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
                            <th>Bobot</th>
                            <th>Gambar</th>
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
                {"orderable": false, "targets": 0},
                {"orderable": false, "targets": 1}
            ],
            "aoColumns": [
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<input type="checkbox" class="select-row" data-id="' + full[2] + '" />'
                    }
                },
                null,
                null,
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<a href="#" onclick=delete_id("' + full[2] + '")' +
                            '><span class="label label-primary">Hapus<span></a>' +
                            '<a href="<?php echo(base_url())?>admin/ubahdata_siswa?nisn=' + full[2] + '" onclick=""><span class="label label-primary">Edit<span></a>';
                    }
                }
            ]
        });
    };

    function delete_id(id) {
        swal({
            title: 'Hapus Jurusan!!',
            text: "Apakah Anda yakin untuk menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/hapus_siswa')?>",
                type: "POST",
                data: {nisn: id},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Deleted!',
                        text: 'Jurusan Berhasil Di Hapus.',
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
            title: 'Hapus Jurusan!!',
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
                nisn: delete_selected
            };
            $.ajax({
                data: data_to_send,
                method: 'post',
                dataType: 'json',
                url: 'http://arioki.web/ajax/multi_delete',
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
</script>