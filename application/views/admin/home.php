<div class="col-md-12">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-pricing ">
                        <div class="card-content">
                            <div class="icon icon-<?php rubah_warna() ?>">
                                <i class="material-icons">assessment</i>
                            </div>
                            <h3 class="card-title">Pendaftaran</h3>
                            <p class="card-description">
                                Input data calon siswa baru Tahun <?php echo(get_setting("tahun_ajaran_ppdb")) ?>
                            </p>
                            <a href="<?php echo(base_url() . "admin/pendaftaran") ?>"
                               class="btn btn-<?php rubah_warna() ?> btn-round">go</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing ">
                        <div class="card-content">
                            <div class="icon icon-<?php rubah_warna() ?>">
                                <i class="material-icons">import_contacts</i>
                            </div>
                            <h3 class="card-title">Tes TPA</h3>
                            <p class="card-description">
                                Kelola Nilai Tes Potensial Akademik
                            </p>
                            <a href="<?php echo(base_url() . "admin/tpa") ?>"
                               class="btn btn-<?php rubah_warna() ?> btn-round">go</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing ">
                        <div class="card-content">
                            <div class="icon icon-<?php rubah_warna() ?>">
                                <i class="material-icons">present_to_all</i>
                            </div>
                            <h3 class="card-title">Edit Soal</h3>
                            <p class="card-description">
                                Edit Daftar Soal TPA
                            </p>
                            <a href="<?php echo(base_url() . "admin/edit_soal") ?>"
                               class="btn btn-<?php rubah_warna() ?> btn-round">go</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing ">
                        <div class="card-content">
                            <div class="icon icon-<?php rubah_warna() ?>">
                                <i class="material-icons">school</i>
                            </div>
                            <h3 class="card-title">Report Data</h3>
                            <p class="card-description">
                                Lihat hasil semua perhitungan
                            </p>
                            <a href="<?php echo(base_url() . "admin/report") ?>"
                               class="btn btn-<?php rubah_warna() ?> btn-round">go</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing ">
                        <div class="card-content">
                            <div class="icon icon-<?php rubah_warna() ?>">
                                <i class="material-icons">settings</i>
                            </div>
                            <h3 class="card-title">Pengaturan</h3>
                            <p class="card-description">
                                Pengaturan Umum
                            </p>
                            <a href="<?php echo(base_url() . "admin/pengaturan") ?>"
                               class="btn btn-<?php rubah_warna() ?> btn-round">go</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>