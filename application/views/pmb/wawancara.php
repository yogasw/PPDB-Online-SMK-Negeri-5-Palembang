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
                "columnDefs": [
                    {"orderable": false, "targets": 0}
                ],
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
                url: "<?php echo(base_url() . 'ajax/ambil_data_wawancara')?>",
                type: "POST",
                data: {nisn: id},
                success: function (data) {
                    data = JSON.parse(data);
                    try {
                        edit(data)
                    } catch{}
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        }
        function edit(data) {
            var btn = "button";
            swal({
                title: 'Edit Data',
                html: '<form id="myform" action="<?php echo(base_url() . 'ajax/kirim_data_wawancara') ?>" method="post">' +
                    '<input name="nisn" value="' + data[0].nisn_siswa + '" hidden>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">NISN</label>' +
                    '<input type="text" name="nisn" value="' + data[0].nisn_siswa + '" class="form-control" disabled>' +
                '</div></div>' +

                '<div class="col-xs-6"><div class="form-group label-floating">' +
                '<label class="control-label">Nama</label>' +
                '<input type="text" name="nama" value="' + data[0].nama_lengkap + '" class="form-control" disabled>' +
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
                '</div></div></div>' +

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
                url: "<?php echo(base_url() . 'ajax/kirim_data_wawancara')?>",
                data: datastring,
                success: function () {
                    swal({
                        title: 'Berhasil!',
                        text: 'Jawaban Berhasil Di Kirim!!',
                        type: 'success',
                        showConfirmButton: false,
                        buttonsStyling: false
                    });
                    //table.ajax.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        }
    </script>