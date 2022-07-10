<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat Baru Riwayat Pertumbuhan</h1>
    <p class="mb-4">Data Master Pembuatan Riwayat Pertumbuhan Baru</p>
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Riwayat Pertumbuhan Baru</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/riwayat-pertumbuhan" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Form Data -->
            <form action="<?= route_to('simpan-riwayat-pertumbuhan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <!-- Konten detail artikel-->
                <!-- <section> -->
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Judul Riwayat Pertumbuhan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('judul_riwayat_pertumbuhan') ? 'is-invalid' : '' ?>" id="text" name="judul_riwayat_pertumbuhan" value="<?= old('judul_riwayat_pertumbuhan') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('judul_riwayat_pertumbuhan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Nama Anak</label>
                            <div class="col-sm">
                                <select class="form-control js-example-basic-single1" id="" name="id_anak">
                                    <?php foreach ($anak as $value1) : ?>
                                        <option value="<?= $value1['anak_id'] ?>"><?= $value1['nama_anak'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Lokasi Faskes</label>
                            <div class="col-sm">
                                <select class="form-control js-example-basic-single1" id="" name="id_lokasi_faskes">
                                    <?php foreach ($faskes as $value1) : ?>
                                        <option value="<?= $value1['faskes_id'] ?>"><?= $value1['nama_faskes'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_riwayat_pertumbuhan" class="col-sm-4 col-form-label">Tanggal Riwayat Pertumbuhan</label>
                            <div class="col-sm input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="tanggal_riwayat_pertumbuhan">
                                <div class="input-group-addon">
                                    <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Tinggi/Panjang Badan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('tinggi_panjang_badan') ? 'is-invalid' : '' ?>" id="text" name="tinggi_panjang_badan" value="<?= old('tinggi_panjang_badan') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('tinggi_panjang_badan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Berat Badan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('berat_badan') ? 'is-invalid' : '' ?>" id="text" name="berat_badan" value="<?= old('berat_badan') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('berat_badan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Lingkar Lengan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('lingkar_lengan') ? 'is-invalid' : '' ?>" id="text" name="lingkar_lengan" value="<?= old('lingkar_lengan') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('lingkar_lengan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Lingkar Kepala</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('lingkar_kepala') ? 'is-invalid' : '' ?>" id="text" name="lingkar_kepala" value="<?= old('lingkar_kepala') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('lingkar_kepala') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Catatan Riwayat Pertumbuhan</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan_riwayat_pertumbuhan" rows="3" placeholder="<?= old('catatan_riwayat_pertumbuhan') ?>"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="formFile" class="col-sm-4 col-form-label">Gambar Pertumbuhan</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control <?= $validation->hasError('gambar_riwayat_pertumbuhan') ? 'is-invalid' : '' ?>" name="gambar_riwayat_pertumbuhan" id="gambar_riwayat_pertumbuhan" value="<?= old('gambar_riwayat_pertumbuhan') ?>" onchange="previewImage()">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('gambar_riwayat_pertumbuhan') ?>
                                </div>
                                <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="row mb-3">
                    <label for="author_user_id" class="col-sm-4 col-form-label">Penginput</label>
                    <div class="col-sm mt-2">
                        <input type="hidden" class="form-control-plaintext" value="<?= user()->id ?>" name="author_user_id" readonly><?= user()->username; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 right"><i class="fa fa-floppy-disk"></i> Simpan</button>
                <!-- </section> -->
            </form>
        </div>
    </div>
    <!-- End card -->
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
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