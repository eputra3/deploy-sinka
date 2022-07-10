<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat Jadwal Imunisasi</h1>
    <p class="mb-4">Data Master Pembuatan Jadwal Imunisasi Baru</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Jadwal Imunisasi Baru</h6>
        </div>
        <div class="card-body">
            <a href="/jadwal-imunisasi" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <!-- Form Data -->
            <form action="<?= route_to('simpan-jadwal-imunisasi') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="nama_jadwal_imunisasi" class="col-sm-4 col-form-label">Nama Jadwal Imunisasi</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('nama_jadwal_imunisasi') ? 'is-invalid' : '' ?>" id="text" name="nama_jadwal_imunisasi" value="<?= old('nama_jadwal_imunisasi') ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_jadwal_imunisasi') ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Imunisasi</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="" name="jenis_imunisasi">
                            <?php foreach ($jenis_imunisasi as $value) : ?>
                                <option value="<?= $value['jenis_imunisasi_id'] ?>"><?= $value['nama_jenis_imunisasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi_jadwal_imunisasi" class="col-sm-4 col-form-label">Deskripsi Jadwal Imunisasi</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="deskripsi_jadwal_imunisasi" name="deskripsi_jadwal_imunisasi" rows="3" placeholder="<?= old('deskripsi_jadwal_imunisasi') ?>"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Lokasi Faskes</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="" name="lokasi_faskes_jadwal_imunisasi">
                            <?php foreach ($faskes as $value) : ?>
                                <option value="<?= $value['faskes_id'] ?>"><?= $value['nama_faskes'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_jadwal_imunisasi" class="col-sm-4 col-form-label">Tanggal Jadwal Imunisasi</label>
                    <div class="col-sm input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" name="tanggal_jadwal_imunisasi">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="waktu_jadwal_imunisasi" class="col-sm-4 col-form-label">Waktu Jadwal Imunisasi</label>
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
                        <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author_user_id" class="col-sm-4 col-form-label">Penulis</label>
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

<script type="text/javascript">
    $('.clockpicker').clockpicker({
        // donetext: 'Oke',
        placement: 'top',
        align: 'left',
    });
</script>

<?= $this->endSection(); ?>