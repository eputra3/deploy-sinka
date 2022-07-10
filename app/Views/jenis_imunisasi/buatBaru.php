<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Jenis Imunisasi</h1>
    <p class="mb-4">Data Master Pembuatan Jenis Imunisasi Baru</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Jenis Imunisasi Baru</h6>
        </div>
        <div class="card-body">
            <a href="/jenis-imunisasi" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('simpan-jenis-imunisasi') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="nama_jenis_imunisasi" class="col-sm-2 col-form-label">Nama Jenis Imunisasi</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control <?= $validation->hasError('nama_jenis_imunisasi') ? 'is-invalid' : '' ?>" id="text" name="nama_jenis_imunisasi" value="<?= old('nama_jenis_imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_jenis_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_jenis_imunisasi" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_jenis_imunisasi') ? 'is-invalid' : '' ?>" name="gambar_jenis_imunisasi" id="gambar_jenis_imunisasi" value="<?= old('gambar_jenis_imunisasi') ?>" onchange="previewImg()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_jenis_imunisasi') ?>
                        </div>
                        <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="waktu_awal_tepat_jenis_imunisasi" class="col-sm-2 col-form-label">Awal Tepat Imunisasi</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control <?= $validation->hasError('waktu_awal_tepat_jenis_imunisasi') ? 'is-invalid' : '' ?>" id="number" name="waktu_awal_tepat_jenis_imunisasi" value="<?= old('waktu_awal_tepat_jenis_imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('waktu_awal_tepat_jenis_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="waktu_akhir_tepat_jenis_Imunisasi" class="col-sm-2 col-form-label">Akhir Tepat Imunisasi</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control <?= $validation->hasError('waktu_akhir_tepat_jenis_Imunisasi') ? 'is-invalid' : '' ?>" id="number" name="waktu_akhir_tepat_jenis_Imunisasi" value="<?= old('waktu_akhir_tepat_jenis_Imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('waktu_akhir_tepat_jenis_Imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="waktu_awal_telat_jenis_imunisasi" class="col-sm-2 col-form-label">Awal Telat Jenis Imunisasi</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control <?= $validation->hasError('waktu_awal_telat_jenis_imunisasi') ? 'is-invalid' : '' ?>" id="number" name="waktu_awal_telat_jenis_imunisasi" value="<?= old('waktu_awal_telat_jenis_imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('waktu_awal_telat_jenis_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="waktu_akhir_telat_jenis_imunisasi" class="col-sm-2 col-form-label">Akhir Telat Jenis Imunisasi</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control <?= $validation->hasError('waktu_akhir_telat_jenis_imunisasi') ? 'is-invalid' : '' ?>" id="number" name="waktu_akhir_telat_jenis_imunisasi" value="<?= old('waktu_akhir_telat_jenis_imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('waktu_akhir_telat_jenis_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 right"><i class="fa fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>


<!-- /.container-fluid -->

<?= $this->endSection(); ?>