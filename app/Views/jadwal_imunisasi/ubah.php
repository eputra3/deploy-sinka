<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah</h1>
    <!-- <p class="mb-4">Buat artikel tentang kesehatan Ibu dan Anak</p> -->
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Perubahan Data Jadwal Imunisasi</h6>
        </div>
        <div class="card-body">
            <a href="/jadwal-imunisasi" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <form action="<?= route_to('perbaharui-jadwal-imunisasi', $result['jadwal_imunisasi_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_jadwal_imunisasi'] ?>" name="slug_jadwal_imunisasi_lama">
                <div class="row mb-3">
                    <label for="nama_jadwal_imunisasi" class="col-sm-4 col-form-label">Nama Jadwal</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('nama_jadwal_imunisasi') ? 'is-invalid' : '' ?>" id="text" name="nama_jadwal_imunisasi" value="<?= old('nama_jadwal_imunisasi', $result['nama_jadwal_imunisasi']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_jadwal_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label">Jenis Imunisasi</label>
                    <div class="col-sm">
                        <select class="form-control" name="jenis_imunisasi">
                            <?php foreach ($jenis_imunisasi as $item) : ?>
                                <option value="<?= $item['jenis_imunisasi_id'] ?>" <?= old('jenis_imunisasi', $result['jenis_imunisasi']) == $item['jenis_imunisasi_id'] ? 'selected' : '' ?>><?= $item['nama_jenis_imunisasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi_jadwal_imunisasi" class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="deskripsi_jadwal_imunisasi" name="deskripsi_jadwal_imunisasi" rows="3" placeholder="<?= old('deskripsi_jadwal_imunisasi') ?>"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Lokasi Faskes</label>
                    <div class="col-sm">
                        <select class="form-control" name="lokasi_faskes_jadwal_imunisasi">
                            <?php foreach ($faskes as $item) : ?>
                                <option value="<?= $item['faskes_id'] ?>" <?= old('faskes_id', $result['lokasi_faskes_jadwal_imunisasi']) == $item['faskes_id'] ? 'selected' : '' ?>><?= $item['nama_faskes'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_jadwal_imunisasi" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" name="tanggal_jadwal_imunisasi">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="waktu_jadwal_imunisasi" class="col-sm-4 col-form-label">Waktu</label>
                    <div class="col-sm input-group clockpicker" data-autoclose="true">
                        <input type="text" class="form-control" name="waktu_jadwal_imunisasi" value="">
                        <div class="input-group-addon">
                            <span><i class="fa fa-clock ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_jadwal_imunisasi" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_jadwal_imunisasi') ? 'is-invalid' : '' ?>" name="gambar_jadwal_imunisasi" id="gambar_jadwal_imunisasi" value="<?= old('gambar_jadwal_imunisasi') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_jadwal_imunisasi') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_jadwal_imunisasi'] != null ? $result['gambar_jadwal_imunisasi'] : 'default-img-placeholder.png' ?>" alt="" class="img-preview img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author_user_id" class="col-sm-4 col-form-label">Penginput</label>
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