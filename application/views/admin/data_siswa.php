                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Striped Table</h4>
                        <div class="row text-right">
                            <div class="col-lg-8">
                                <button class="btn" onclick='newswal("input-siswa")'>
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                                    TAMBAH DATA
                                </button>
                            </div>
                            <div class="col-lg-2" onclick='newswal("delete-siswa")'>
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
                                <table id="datatables" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th></th>
                                        <th class="text-left">NIS</th>
                                        <th>Jurusan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php //$id=1; foreach ($data->result_array() as $i): ?>
                                    <tr>
                                        <td class="text-center"><?php echo($id++); ?></td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td><?php echo($i['nisn']); ?></td>
                                        <td><?php echo($i['jurusan']); ?></td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" class="btn btn-info">
                                                <i class="material-icons">person</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-success">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-danger">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php //endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    function newswal(type){
                        if (type == 'input-siswa') {
                            swal({
                                title: 'Tambah Jurusan Baru',
                                html: '<div class="form-group">' +
                                '<input id="nisn" type="text" placeholder="NISN" class="form-control" />' +
                                '</div>' + '<input id="Nama" type="text" placeholder="Nama " class="form-control" />' +
                                '</div>',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-success',
                                cancelButtonClass: 'btn btn-danger',
                                buttonsStyling: false
                            }).then(function (result) {
                                swal({
                                    type: 'success',
                                    html: 'Jurusan Yang Anda Masukan: <strong>' +
                                    $('#nama_jurusan').val() +
                                    '</strong>',
                                    confirmButtonClass: 'btn btn-success',
                                    buttonsStyling: false

                                })
                            }).catch(swal.noop)
                        } else if (type == 'delete-siswa') {
                            swal({
                                title: 'Hapus Jurusan!!',
                                text: "Apakah Anda yakin untuk menghapus data peserta ini?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-success',
                                cancelButtonClass: 'btn btn-danger',
                                confirmButtonText: 'Iya, Hapus!',
                                buttonsStyling: false
                            }).then(function () {
                                swal({
                                    title: 'Deleted!',
                                    text: 'Data Peserta Berhasil Di Hapus.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success",
                                    buttonsStyling: false
                                })
                            });
                        }
                    };
                </script>