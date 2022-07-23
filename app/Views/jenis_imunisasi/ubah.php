<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah</h1>
    <!-- <p class="mb-4">Data Master Perubahan Kategori Artikel</p> -->
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Perubahan Data Jenis Imunisasi</h6>
        </div>
        <div class="card-body">
            <a href="/jenis-imunisasi" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('perbaharui-jenis-imunisasi', $result['jenis_imunisasi_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_jenis_imunisasi'] ?>" name="slug_jenis_imunisasi_lama">
                <div class="row mb-3">
                    <label for="nama_jenis_imunisasi" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_jenis_imunisasi') ? 'is-invalid' : '' ?>" id="text" name="nama_jenis_imunisasi" value="<?= old('nama_jenis_imunisasi', $result['nama_jenis_imunisasi']) ?>">
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
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_jenis_imunisasi'] != null ? $result['gambar_jenis_imunisasi'] : 'default-img-placeholder.png' ?>" alt="" class="img-artikel-preview img-thumbnail">
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