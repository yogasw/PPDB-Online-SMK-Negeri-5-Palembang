<div class="full-page register-page" filter-color="black" data-image="<?php echo(base_url())?>assets/img/register.jpg"><div class="container">
<div class="col-md-12">
    <div class="card">
        <h2 class="card-title text-center">FORM PENDAFTARAN SISWA BARU</h2>
        <h2 class="card-title text-center">SMK 05 PALEMBANG</h2>

        <div class="row bt-register">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4 text-right">
                    <button class="btn" onclick='newswal("input-jurusan")'>
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                        Tambah Data
                    </button>
            </div>
        </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
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
    </div>
        <script type="text/javascript">
            var table;
            window.onload = function () {
                table = $('#datatables').DataTable( {
                        "bProcessing": true,
                        "bServerSide": true,
                        ajax: {
                            url: "<?php echo base_url('ajax/ambil_data_pendaftaran') ?>",
                            type:'POST',
                        },
                        "aoColumns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            {
                                "mData": "0",
                                "mRender": function ( data, type, full ) {
                                    return '<a href="#" onclick=delete_id("'+full[2]+'","'+full[3]+'")><span class="label label-primary">Hapus<span></a>' +
                                        '<a href="#" onclick=""><span class="label label-primary">Edit<span></a>';
                                }
                            }
                        ]
                    } );
            };

            function delete_id(id,nama) {
                swal({
                    title: 'Hapus Jurusan!!',
                    text: "Apakah Anda yakin untuk menghapus data "+nama+" ini?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Iya, Hapus!',
                    buttonsStyling: false
                }).then(function () {
                    $.ajax({
                        url: "<?php echo(base_url().'ajax/hapus_siswa')?>",
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