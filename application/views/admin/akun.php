                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">Striped Table</h4>
                        <div class="row text-right">
                            <div class="col-lg-8">
                                <button class="btn" onclick=newswal("input-akun")>
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                                    TAMBAH DATA
                                </button>
                            </div>
                            <div class="col-lg-2" onclick=newswal("delete-akun")>
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
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Level</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>admin</td>
                                        <td>Yoga Setiawan</td>
                                        <td>Laki-Laki</td>
                                        <td>Admin</td>
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
                                        <td>ridho</td>
                                        <td>Ridho Rifai</td>
                                        <td>Laki-Laki</td>
                                        <td>Admin</td>
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
                                        <td class="text-center">3</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>141420213</td>
                                        <td>Arioki</td>
                                        <td>Laki-Laki</td>
                                        <td>Siswa</td>
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
                                        <td class="text-center">4</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>141420212</td>
                                        <td>Ari Handi</td>
                                        <td>Laki-Laki</td>
                                        <td>Siswa</td>
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
                                        <td class="text-center">5</td>
                                        <td class="text-left"><input type="checkbox" name="optionsCheckboxes" checked></td>
                                        <td>1290922</td>
                                        <td>Putri</td>
                                        <td>Perempuan</td>
                                        <td>Siswa</td>
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
                        if (type == 'input-akun') {
                            swal({
                                title: 'Tambah Akun Baru',
                                html: '<div class="form-group">' +
                                '</div>' + '<input id="username" type="text" placeholder="Username" class="form-control" />' +
                                '</div>' + '<input id="nama" type="text" placeholder="Nama Lengkap" class="form-control" />' +
                                '</div>' + '<input id="jk" type="text" placeholder="Jenis Kelamin" class="form-control" />' +
                                '</div>' + '<input id="level" type="text" placeholder="Level" class="form-control" />' +
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
                        } else if (type == 'delete-akun') {
                            swal({
                                title: 'Hapus Akun!!',
                                text: "Apakah Anda yakin untuk menghapus akun ini?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-success',
                                cancelButtonClass: 'btn btn-danger',
                                confirmButtonText: 'Iya, Hapus!',
                                buttonsStyling: false
                            }).then(function () {
                                swal({
                                    title: 'Deleted!',
                                    text: 'Data Akun Berhasil Di Hapus.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success",
                                    buttonsStyling: false
                                })
                            });
                        }
                    };
                </script>