<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Kategori Artikel</h1>
    <p class="mb-4">Data Master Perubahan Kategori Artikel</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Artikel Kategori</h6>
        </div>
        <div class="card-body">
            <a href="/artikel-kategori" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('perbaharui-artikel-kategori', $result['artikel_kategori_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_artikel_kategori'] ?>" name="slug_artikel_kategori_lama">
                <div class="row mb-3">
                    <label for="nama_artikel_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('nama_artikel_kategori') ? 'is-invalid' : '' ?>" id="text" name="nama_artikel_kategori" value="<?= old('nama_artikel_kategori', $result['nama_artikel_kategori']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_artikel_kategori') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_artikel_kategori" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_artikel_kategori') ? 'is-invalid' : '' ?>" name="gambar_artikel_kategori" id="gambar_artikel_kategori" value="<?= old('gambar_artikel_kategori') ?>" onchange="previewImg()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_artikel_kategori') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_artikel_kategori'] != null ? $result['gambar_artikel_kategori'] : 'default-img-placeholder.png' ?>" alt="" class="img-artikel-preview img-thumbnail">
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