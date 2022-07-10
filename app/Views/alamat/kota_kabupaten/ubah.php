<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Kota dan Kabupaten</h1>
    <p class="mb-4">Data Master Perubahan Kota dan Kabupaten</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Kota dan Kabupaten</h6>
        </div>
        <div class="card-body">
            <a href="/artikel-kategori" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('perbaharui-kota-kabupaten', $result['kota_kabupaten_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug'] ?>" name="slug_lama">
                <div class="row mb-3">
                    <label for="nama_kota_kabupaten" class="col-sm-2 col-form-label">Nama Kota/Kabupaten</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_kota_kabupaten') ? 'is-invalid' : '' ?>" id="text" name="nama_kota_kabupaten" value="<?= old('nama_kota_kabupaten', $result['nama_kota_kabupaten']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_kota_kabupaten') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_kota_kabupaten" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_kota_kabupaten') ? 'is-invalid' : '' ?>" name="gambar_kota_kabupaten" id="gambar_kota_kabupaten" value="<?= old('gambar_kota_kabupaten') ?>" onchange="previewImg()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_kota_kabupaten') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_kota_kabupaten'] != null ? $result['gambar_kota_kabupaten'] : 'default-img-placeholder.png' ?>" alt="" class="img-artikel-preview img-thumbnail">
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