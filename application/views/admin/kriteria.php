                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Striped Table</h4>
                        <div class="row text-right">
                            <div class="col-lg-8">
                                <button class="btn" onclick=newswal("input-kriteria")>
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                                    TAMBAH DATA
                                </button>
                            </div>
                            <div class="col-lg-2" onclick=newswal("delete-kriteria")>
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
                                        <th class="text-left"></th>
                                        <th>Nama Kriteria</th>
                                        <th>Nama Jurusan</th>
                                        <th>Bobot</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>Nilai Matematika</td>
                                        <td>TKJ</td>
                                        <td>3.0</td>
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
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>Nilai IPA</td>
                                        <td>TKJ</td>
                                        <td>2.0</td>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    function newswal(type){
                        if (type == 'input-kriteria') {
                            swal({
                                title: 'Tambah Kriteria Baru',
                                html: '<div class="form-group">' +
                                '</div>' + '<input id="nama_kriteria" type="text" placeholder="Nama Kriteria" class="form-control" />' +
                                '</div>' + '<input id="nama_jurusan" type="text" placeholder="Nama Jurusan" class="form-control" />' +
                                '</div>' + '<input id="bobot" type="text" placeholder="Bobot" class="form-control" />' +
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
                        } else if (type == 'delete-kriteria') {
                            swal({
                                title: 'Hapus Kriteria!!',
                                text: "Apakah Anda yakin untuk menghapus kriteria ini?",
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