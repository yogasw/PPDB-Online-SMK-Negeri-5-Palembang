<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 table-bordered">
                    <div class="form-group">
                        <select name="filter_jurusan" id="filter_jurusan" class="form-control" required>
                            <option value="" <?php if (isset($filter) && $filter == "") echo "selected" ?>>Semua
                                Jurusan
                            </option>
                            <option value="akuntansi" <?php if (isset($filter) && $filter == "akuntansi") echo "selected" ?>>
                                Akuntansi
                            </option>
                            <option value="administrasiperkantoran" <?php if (isset($filter) && $filter == "administrasiperkantoran") echo "selected" ?>>
                                Administrasi Perkantoran
                            </option>
                            <option value="pemasaran" <?php if (isset($filter) && $filter == "pemasaran") echo "selected" ?>>
                                Pemasaran
                            </option>
                            <option value="animasi" <?php if (isset($filter) && $filter == "animasi") echo "selected" ?>>
                                Animasi
                            </option>
                            <option value="multimedia" <?php if (isset($filter) && $filter == "multimedia") echo "selected" ?>>
                                Multimedia
                            </option>
                            <option value="tp4" <?php if (isset($filter) && $filter == "tp4") echo "selected" ?>>Teknik
                                Produksi dan Penyiaran Program Pertelevisian
                        </select>
                    </div>
                    <div class="form-group" align="center">
                        <button type="button" name="filter" id="filter" class="btn btn-<?php rubah_warna() ?>">Filter
                        </button>
                        <button type="button" onclick="umumkan()" name="umumkan" id="umumkan"
                                class="btn btn-<?php rubah_warna3() ?>">
                            Umumkan
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" action="" method="post">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Reg</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Kopetensi Keahlian</th>
                            <th>L/P</th>
                            <th>Nilai UN Bahasa Indonesia</th>
                            <th>Nilai UN Bahasa Inggris</th>
                            <th>Nilai UN Matematika</th>
                            <th>Nilai UN IPA</th>
                            <th>Rata-Rata UN (a)</th>
                            <th>Nilai USBN PAI</th>
                            <th>Nilai USBN PKN</th>
                            <th>Nilai USBN IPS</th>
                            <th>Rata-Rata Nilai USBN (b)</th>
                            <th>Nilai Potensial Akademik (c)</th>
                            <th>Total Nilai</th>
                            <th>Status</th>
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
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            ajax: {
                url: '<?php echo(base_url() . 'ajax/ambil_data_hasil')?>',
                method: "POST"
            },
            'rowCallback': function (row, data, index) {
                if (data[18] == 'Ditolak') {
                    $(row).addClass("<?php rubah_warna4() ?>");
                }
            }
        });
        $('#datatables').DataTable().column(2).visible(false);
        $('#datatables').DataTable().column(6).visible(false);
        $('#datatables').DataTable().column(7).visible(false);
        $('#datatables').DataTable().column(8).visible(false);
        $('#datatables').DataTable().column(9).visible(false);
        $('#datatables').DataTable().column(10).visible(false);
        $('#datatables').DataTable().column(12).visible(false);
        $('#datatables').DataTable().column(13).visible(false);
        $('#datatables').DataTable().column(14).visible(false);
    };

    $('#filter').click(function () {
        var filter = $('#filter_jurusan').val();
        $.ajax({
            url: '<?php echo(base_url() . 'admin/filter/')?>' + filter,
            type: "GET",
            success: function (data) {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });

    function umumkan() {
        swal({
            title: 'Umumkan Soal!!',
            text: "Apakah Anda yakin untuk mengumumkan hasil ujian ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText: 'Batalkan Pengumuman',
            confirmButtonText: 'Umumkan Sekarang',
            buttonsStyling: false
        }).then(function (isConfirm) {
            umumkan_ajax();
        }).catch(function (reason) {
            if (reason == 'cancel') {
                batalkan_ajax();
            }
        });
    }

    function umumkan_ajax() {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/ambil_data_hasil/ya')?>",
            type: "POST",
            dataType: "html",
            success: function () {
                swal({
                    title: 'Berhasil!',
                    text: 'Data berhasil di umumkan',
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
    }

    function batalkan_ajax() {
        $.ajax({
            url: "<?php echo(base_url() . 'ajax/batalkan_pengumuman')?>",
            type: "POST",
            dataType: "html",
            success: function () {
                swal({
                    title: 'Berhasil!',
                    text: 'Pengumuman berhasil di batalkan, perhitungan di reset',
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
    }
</script>

<style>
    button.dt-button, div.dt-button, a.dt-button {
        position: relative;
        display: inline-block;
        box-sizing: border-box;
        margin-right: 0.333em;
        margin-bottom: 0.333em;
        padding: 0.5em 1em;
        border: 1px solid #999;
        border-radius: 2px;
        cursor: pointer;
        font-size: 0.88em;
        line-height: 1.6em;
        color: black;
        white-space: nowrap;
        overflow: hidden;
        background-color: #e9e9e9;
        background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: linear-gradient(to bottom, #fff 0%, #e9e9e9 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, StartColorStr='white', EndColorStr='#e9e9e9');
    }
</style>