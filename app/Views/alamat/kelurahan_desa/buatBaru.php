<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Kelurahan/Desa</h1>
    <!-- <p class="mb-4">Data Master Pembuatan Kecamatan Baru</p> -->
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kecamatan Baru</h6>
        </div>
        <div class="card-body">
            <a href="/kelurahan-desa" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('simpan-kelurahan-desa') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="nama_kelurahan_desa" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_kelurahan_desa') ? 'is-invalid' : '' ?>" id="text" name="nama_kelurahan_desa" value="<?= old('nama_kelurahan_desa') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_kelurahan_desa') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kecamatan_id" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-10">
                        <select class="form-control js-example-basic-single" id="specificSizeSelect" name="kecamatan_id">
                            <?php foreach ($kecamatan as $item) : ?>
                                <option value="<?= $item['kecamatan_id'] ?>" <?= old('kecamatan_id') == $item['kecamatan_id'] ? 'selected' : '' ?>><?= $item['nama_kecamatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_kelurahan_desa" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_kelurahan_desa') ? 'is-invalid' : '' ?>" name="gambar_kelurahan_desa" id="gambar_kelurahan_desa" value="<?= old('gambar_kelurahan_desa') ?>" onchange="previewImg()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_kelurahan_desa') ?>
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

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<?= $this->endSection(); ?>