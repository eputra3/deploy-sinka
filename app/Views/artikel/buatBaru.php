<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat Artikel</h1>
    <p class="mb-4">Buat artikel tentang kesehatan Ibu dan Anak</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Artikel Baru</h6>
        </div>
        <div class="card-body">
            <a href="/artikel" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('simpan-artikel') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="text" name="judul" value="<?= old('judul') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="artikel_kategori_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="specificSizeSelect" name="artikel_kategori_id">
                            <?php foreach ($artikel_kategori as $item) : ?>
                                <option value="<?= $item['artikel_kategori_id'] ?>" <?= old('artikel_kategori_id') == $item['artikel_kategori_id'] ? 'selected' : '' ?>><?= $item['nama_artikel_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_artikel" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_artikel') ? 'is-invalid' : '' ?>" name="gambar_artikel" id="gambar_artikel" value="<?= old('gambar_artikel') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_artikel') ?>
                        </div>
                        <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="isi" rows="20" placeholder="<?= old('isi') ?>"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author_user_id" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="sb-1 mt-1">
                        <input type="hidden" class="form-control-plaintext" value="<?= user()->id ?>" name="author_user_id" readonly><?= user()->username; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 right"><i class="fa fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>