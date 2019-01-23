<div class="col-md-12">
            <div class="card">
                <h2 class="card-title text-center">FORM PENDAFTARAN SISWA BARU</h2>
                <h2 class="card-title text-center">SMK 05 PALEMBANG</h2>

                <div class="row bt-register">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4 text-right">
                        <button class="btn"
                                onclick="window.location.href='<?php echo(base_url() . 'ppdb/tambahdata_siswa') ?>'">
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
    <script type="text/javascript">
        var table;
        window.onload = function () {
            table = $('#datatables').DataTable({
                "bProcessing": true,
                "bServerSide": true,
                ajax: {
                    url: "<?php echo base_url('ajax/ambil_data_pendaftaran') ?>",
                    type: 'POST',
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
                        "mRender": function (data, type, full) {
                            return '<a href="#" onclick=delete_id("' + full[2] + '")' +
                                '><span class="label label-primary">Hapus<span></a>' +
                                '<a href="<?php echo(base_url())?>ppdb/ubahdata_siswa?nisn=' + full[2] + '" onclick=""><span class="label label-primary">Edit<span></a>';
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

                $("#nisn").change(function () {
                    $.ajax({
                        url: '<?php echo(base_url() . "ajax/cek_nisn") ?>',
                        data: {nisn: $('#nisn').val()},
                        type: "post",
                        respontype: "json",
                        timeout: 10000,
                        success: function (response) {
                            if (response == "true") {
                                document.getElementById("next").disabled = true;
                                swal({
                                    title: 'Mantap Cuy!',
                                    text: 'Data NISN Sudah di pakai',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-success",
                                    showConfirmButton: false,
                                    buttonsStyling: false
                                })
                            } else {
                                document.getElementById("next").disabled = false;
                            }
                        }
                    });
                });

            });
        }
    </script>