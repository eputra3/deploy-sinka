<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Kecamatan</h1>
    <!-- <p class="mb-4">Data Master Pembuatan Kecamatan Baru</p> -->
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pembuatan Data Baru Kecamatan</h6>
        </div>
        <div class="card-body">
            <a href="/kecamatan" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('simpan-kecamatan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="nama_kecamatan" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_kecamatan') ? 'is-invalid' : '' ?>" id="text" name="nama_kecamatan" value="<?= old('nama_kecamatan') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_kecamatan') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kota_kabupaten_id" class="col-sm-2 col-form-label">Kota/Kabupaten</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="specificSizeSelect" name="kota_kabupaten_id">
                            <?php foreach ($kota_kabupaten as $item) : ?>
                                <option value="<?= $item['kota_kabupaten_id'] ?>" <?= old('kota_kabupaten_id') == $item['kota_kabupaten_id'] ? 'selected' : '' ?>><?= $item['nama_kota_kabupaten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_kecamatan" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_kecamatan') ? 'is-invalid' : '' ?>" name="gambar_kecamatan" id="gambar_kecamatan" value="<?= old('gambar_kecamatan') ?>" onchange="previewImg()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_kecamatan') ?>
                        </div>
                        <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 right"><i class="fa fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>