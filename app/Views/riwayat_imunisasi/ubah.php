<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Riwayat Imunisasi</h1>
    <p class="mb-4">Data Master Perubahan Data Riwayat Imunisasi</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Data Riwayat Imunisasi</h6>
        </div>
        <div class="card-body">
            <a href="/riwayat-imunisasi" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <form action="<?= route_to('perbaharui-riwayat-imunisasi', $result['riwayat_imunisasi_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_riwayat_imunisasi'] ?>" name="slug_riwayat_imunisasi_lama">
                <div class=" row mb-3">
                    <label for="judul_riwayat_imunisasi" class="col-sm-4 col-form-label">Judul Riwayat Imunisasi</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('judul_riwayat_imunisasi') ? 'is-invalid' : '' ?>" id="text" name="judul_riwayat_imunisasi" value="<?= old('judul_riwayat_imunisasi', $result['judul_riwayat_imunisasi']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul_riwayat_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Nama Anak</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="" name="id_anak">
                            <?php foreach ($anak as $value) : ?>
                                <option value="<?= $value['anak_id'] ?>" <?= old('id_anak', $result['id_anak']) == $value['anak_id'] ? 'selected' : '' ?>><?= $value['nama_anak'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Imunisasi</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="" name="id_jenis_imunisasi">
                            <?php foreach ($jenis_imunisasi as $value) : ?>
                                <option value="<?= $value['jenis_imunisasi_id'] ?>" <?= old('id_jenis_imunisasi', $result['id_jenis_imunisasi']) == $value['jenis_imunisasi_id'] ? 'selected' : '' ?>><?= $value['nama_jenis_imunisasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Lokasi Faskes</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="" name="id_lokasi_faskes">
                            <?php foreach ($faskes as $value) : ?>
                                <option value="<?= $value['faskes_id'] ?>" <?= old('id_lokasi_faskes', $result['id_lokasi_faskes']) == $value['faskes_id'] ? 'selected' : '' ?>><?= $value['nama_faskes'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_riwayat_imunisasi" class="col-sm-4 col-form-label">Tanggal Imunisasi</label>
                    <div class="col-sm input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" value="<?= old('tanggal_riwayat_imunisasi', $result['tanggal_riwayat_imunisasi']) ?>" name="tanggal_riwayat_imunisasi">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="catatan_riwayat_imunisasi" class="col-sm-4 col-form-label">Catatan Riwayat Imunisasi</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan_riwayat_imunisasi" rows="3"><?= htmlspecialchars(old('catatan_riwayat_imunisasi', $result['catatan_riwayat_imunisasi'])); ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_riwayat_imunisasi" class="col-sm-4 col-form-label">Gambar Imunisasi</label>
                    <div class="col-sm">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_riwayat_imunisasi') ? 'is-invalid' : '' ?>" name="gambar_riwayat_imunisasi" id="gambar_riwayat_imunisasi" value="<?= old('gambar_riwayat_imunisasi') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_riwayat_imunisasi') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_riwayat_imunisasi'] != null ? $result['gambar_riwayat_imunisasi'] : 'default-img-placeholder.png' ?>" alt="" class="img-preview img-thumbnail">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="author_user_id" class="col-sm-4 col-form-label">Penulis</label>
                    <div class="sb-1 mt-1">
                        <input type="hidden" class="form-control-plaintext" value="<?= user()->id ?>" name="author_user_id" readonly>
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

<script type="text/javascript">
    // $(document).off('.datepicker.data-api');
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d'
    });
</script>

<?= $this->endSection(); ?>