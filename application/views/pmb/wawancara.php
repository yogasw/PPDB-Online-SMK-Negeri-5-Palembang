<div class="full-page register-page" filter-color="black" data-image="<?php echo(base_url()) ?>assets/img/register.jpg">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-title text-center">INPUT NILAI WAWANCARA PSB</h3>
                <h3 class="card-title text-center">SMK 05 PALEMBANG</h3>
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped" width="100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>No. Peserta</th>
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
                            return '<a href="#" onclick=newswal("' + full[2] + '")><span class="label label-primary">Isi Nilai<span></a>'
                        }
                    }
                ]
            });
        };

        function newswal(id) {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/nilai_wawancara')?>",
                type: "POST",
                data: {nisn: id},
                success: function (data) {
                    data = JSON.parse(data);
                    try {
                        edit(data);
                    } catch{
                        tambah
                    ();
                }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        }

        function edit(data) {
            swal({
                title: 'Tambah Akun Baru',
                html: '<form>' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">NISN</label>' +
                '<input type="text" name="nisn" value="' + data[0].nisn + '" class="form-control" disabled>' +
                '</div></div>' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Nama</label>' +
                '<input type="text" name="nama" value="' + data[0].penampilan_fisik + '" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Penampian Fisik</label>' +
                '<input type="number" value="' + data[0].penampilan_fisik + '" name="penampilan_fisik" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Sopan Santun</label>' +
                '<input type="number" value="' + data[0].sopan_santun + '" name="sopan_santun" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Prestasi Akademin</label>' +
                '<input type="number" value="' + data[0].prestasi_akademin + '" name="prestasi_akademin" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Daya Tangkap</label>' +
                '<input type="number" value="' + data[0].daya_tangkap + '" name="daya_tangkap" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Percaya Diri</label>' +
                '<input type="number" value="' + data[0].percaya_diri + '" name="percaya_diri" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Motivasi</label>' +
                '<input type="number" name="motivasi" value="' + data[0].motivasi + '" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Prestasi Kerja</label>' +
                '<input type="number" value="' + data[0].prestasi_kerja + '" name="prestasi_kerja" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Emosi</label>' +
                '<input type="number" value="' + data[0].emosi + '" name="emosi" class="form-control"  required>' +
                '</div></div>' +
                '<br><br>' +
                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button class="btn btn-primary btn-round">' +
                '<i class="material-icons">home</i> ' +
                'Kirim Data</button></div>' +

                '</form>'
                ,
                showConfirmButton: false,
                buttonsStyling: false
            })
        }
        function tambah() {
            swal({
                title: 'Tambah Akun Baru',
                html: '<form>' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">NISN</label>' +
                '<input type="text" name="nisn" class="form-control" disabled>' +
                '</div></div>' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Nama</label>' +
                '<input type="text" name="nama" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Penampian Fisik</label>' +
                '<input type="number"  name="penampilan_fisik" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Sopan Santun</label>' +
                '<input type="number" name="sopan_santun" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Prestasi Akademin</label>' +
                '<input type="number" name="prestasi_akademin" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Daya Tangkap</label>' +
                '<input type="number"  name="daya_tangkap" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Percaya Diri</label>' +
                '<input type="number" name="percaya_diri" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Motivasi</label>' +
                '<input type="number" name="motivasi"  class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Prestasi Kerja</label>' +
                '<input type="number" name="prestasi_kerja" class="form-control" required>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Emosi</label>' +
                '<input type="number"  name="emosi" class="form-control"  required>' +
                '</div></div>' +

                '<br><br>' +

                '<div class="col-md-6 col-md-offset-3"> ' +
                '<button class="btn btn-primary btn-round">' +
                '<i class="material-icons">home</i> ' +
                'Kirim Data</button></div>' +

                '</form>'
                ,
                showConfirmButton: false,
                buttonsStyling: false
            })

        }
    </script>