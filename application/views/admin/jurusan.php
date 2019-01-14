<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Striped Table</h4>
        <div class="row text-right">
            <div class="col-lg-8">
                <button class="btn" onclick='newswal("input-jurusan")'>
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                    TAMBAH DATA
                </button>
            </div>
            <div class="col-lg-2" onclick="newswal('delete-jurusan')">
                <button class="btn">
                                        <span class="btn-label">
                                            <i class="material-icons">delete_forever</i>
                                        </span>
                    HAPUS DATA
                </button>
            </div>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <thead>
                    <tr>
                        <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
                        <th>ID</th>
                        <th>Nama Jurusan</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $id = 1;
                    foreach ($data->result_array() as $i): ?>
                        <tr>
                            <td></td>
                            <td><?php echo($i['id_jurusan']); ?></td>
                            <td><?php echo($i['nama_jurusan']); ?></td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" class="btn btn-success"
                                        onclick="edit_jurusan(<?php echo("'" . $i['id_jurusan'] . "','" . $i['nama_jurusan'] . "'"); ?>)">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger"
                                        onclick="delete_id(<?php echo("'" . $i['id_jurusan'] . "','" . $i['nama_jurusan'] . "'"); ?>)">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var oTable, tables;
    window.onload = function () {
        table = $('#datatables').DataTable({
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta) {
                    return '<input type="checkbox" class="call-checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [[1, 'asc']]
        });
        oTable = $('#datatables').dataTable();
        // Handle click on "Select all" control
        $('#example-select-all').on('click', function () {
            // Get all rows with search applied
            var rows = table.rows({'search': 'applied'}).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#example tbody').on('change', 'input[type="checkbox"]', function () {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#example-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });

    };
</script>

<script type="text/javascript">

    function newswal(type) {
        if (type == 'input-jurusan') {
            swal({
                title: 'Tambah Jurusan Baru',
                html: '<div class="form-group">' +
                '<input id="id_jurusan" type="text" placeholder="ID" class="form-control"/>' +
                '</div>' + '<input id="nama_jurusan" type="text" placeholder="Nama Jurusan" class="form-control" />' +
                '</div>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function (result) {
                var id = $('#id_jurusan').val();
                var jurusan = $('#nama_jurusan').val();

                $.ajax({
                    url: "<?=base_url('/admin/jurusan')?>",
                    type: "POST",
                    data: {id: id, jurusan: jurusan, type: 'tambahdata'},
                    dataType: "html",
                    success: function () {
                        swal({
                            type: 'success',
                            html: 'Jurusan Yang Anda Masukan: <strong>' +
                            $('#nama_jurusan').val() +
                            '</strong>',
                            confirmButtonClass: 'btn btn-success',
                            buttonsStyling: false,
                        });
                        location.reload(true);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
                });
            }).catch(swal.noop)
        } else if (type == 'delete-jurusan') {
            swal({
                title: 'Hapus Jurusan!!',
                text: "Apakah Anda yakin untuk menghapus jurusan ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Iya, Hapus!',
                buttonsStyling: false
            }).then(function () {
                swal({
                    title: 'Deleted!',
                    text: 'Jurusan Berhasil Di Hapus.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
            });
        }
    };
    function delete_id(id, nama) {
        var hh = "<b>" + nama + "<\/b>";
        swal({
            title: 'Hapus Jurusan!!',
            text: "Apakah Anda yakin untuk menghapus jurusan " + hh + " ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?=base_url('/admin/jurusan')?>",
                type: "POST",
                data: {id: id, type: 'hapusdata'},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Deleted!',
                        text: 'Jurusan Berhasil Di Hapus.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    });
                    location.reload(true);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });


        });
    }

    function edit_jurusan(a, b) {
        swal({
            title: 'Edit Jurusan',
            html: '<div class="form-group">' +
            '<input id="id_jurusan" type="text" placeholder="ID" class="form-control" value="' + a + '" disabled/>' +
            '</div>' + '<input id="nama_jurusan" type="text" placeholder="Nama Jurusan" class="form-control" value="' + b + '"/>' +
            '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function (result) {
            var id = $('#id_jurusan').val();
            var jurusan = $('#nama_jurusan').val();

            $.ajax({
                url: "<?=base_url('/admin/jurusan')?>",
                type: "POST",
                data: {id: id, jurusan: jurusan, type: 'editdata'},
                dataType: "html",
                success: function () {
                    swal({
                        type: 'success',
                        html: 'Jurusan Yang Anda Masukan: <strong>' +
                        $('#nama_jurusan').val() +
                        '</strong>',
                        confirmButtonClass: 'btn btn-success',
                        buttonsStyling: false,
                    });
                    location.reload(true);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        }).catch(swal.noop)

    }
</script>