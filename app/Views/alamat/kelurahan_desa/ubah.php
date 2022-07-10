<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Kecamatan</h1>
    <p class="mb-4">Data Master Perubahan Kecamatan</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Kecamatan</h6>
        </div>
        <div class="card-body">
            <a href="/kelurahan-desa" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('perbaharui-kelurahan-desa', $result['kelurahan_desa_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_kelurahan_desa'] ?>" name="slug_kelurahan_desa_lama">
                <div class="row mb-3">
                    <label for="nama_kelurahan_desa" class="col-sm-2 col-form-label">Nama Kelurahan/Desa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_kelurahan_desa') ? 'is-invalid' : '' ?>" id="text" name="nama_kelurahan_desa" value="<?= old('nama_kelurahan_desa', $result['nama_kelurahan_desa']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_kelurahan_desa') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kecamatan_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="kecamatan_id">
                            <?php foreach ($kecamatan as $item) : ?>
                                <option value="<?= $item['kecamatan_id'] ?>" <?= old('kecamatan_id', $result['kecamatan_id']) == $item['kecamatan_id'] ? 'selected' : '' ?>><?= $item['nama_kecamatan'] ?></option>
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
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_kelurahan_desa'] != null ? $result['gambar_kelurahan_desa'] : 'default-img-placeholder.png' ?>" alt="" class="img-artikel-preview img-thumbnail">
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