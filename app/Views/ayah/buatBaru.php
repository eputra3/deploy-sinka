<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Data Ayah</h1>
    <!-- <p class="mb-4">Data Master Pembuatan Ayah Baru</p> -->
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pembuatan Data Baru Ayah</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/ayah" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Form Data -->
            <form action="<?= route_to('simpan-ayah') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <!-- Konten detail artikel-->
                <!-- <section> -->
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Identitas</label>
                            <div class="col-sm">
                                <select class="form-control" id="specificSizeSelect" name="identitas_ayah">
                                    <?php foreach ($identitas as $item) : ?>
                                        <option value="<?= $item['identitas_id'] ?>"><?= $item['nama_identitas'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('nama_ayah') ? 'is-invalid' : '' ?>" id="text" name="nama_ayah" value="<?= old('nama_ayah') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('nama_ayah') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="tempat_lahir_ayah" rows="3" placeholder="<?= old('tempat_lahir_ayah') ?>"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_lahir_ayah" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="tanggal_lahir_ayah">
                                <div class="input-group-addon">
                                    <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('email_ayah') ? 'is-invalid' : '' ?>" id="text" name="email_ayah" value="<?= old('email_ayah') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('email_ayah') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Nomor HP</label>
                            <div class="col-sm">
                                <input type="number" class="form-control <?= $validation->hasError('no_hp_ayah') ? 'is-invalid' : '' ?>" id="text" name="no_hp_ayah" value="<?= old('no_hp_ayah') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('no_hp_ayah') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Pekerjaan</label>
                            <div class="col-sm">
                                <select class="form-control" id="specificSizeSelect" name="pekerjaan_ayah">
                                    <?php foreach ($pekerjaan as $value) : ?>
                                        <option value="<?= $value['pekerjaan_id'] ?>"><?= $value['nama_pekerjaan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Penghasilan</label>
                            <div class="col-sm">
                                <input type="number" class="form-control <?= $validation->hasError('penghasilan_ayah') ? 'is-invalid' : '' ?>" id="text" name="penghasilan_ayah" value="<?= old('penghasilan_ayah') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('penghasilan_ayah') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat_ayah" rows="3" placeholder="<?= old('alamat_ayah') ?>"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="formFile" class="col-sm-4 col-form-label">Foto Identitas</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control <?= $validation->hasError('gambar_identitas_ayah') ? 'is-invalid' : '' ?>" name="gambar_identitas_ayah" id="gambar_identitas_ayah" value="<?= old('gambar_identitas_ayah') ?>" onchange="previewImage()">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('gambar_identitas_ayah') ?>
                                </div>
                                <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Nama Istri</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="specificSizeSelect" name="istri">
                            <?php foreach ($ibu as $value) : ?>
                                <option value="<?= $value['ibu_id'] ?>"><?= $value['nama_ibu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Anak</label>
                    <div class="col-sm">
                        <select class="form-control" id="jumlah_anak_ayah" name="jumlah_anak_ayah">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
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
        $('.js-example-basic-single').select2();
    });
</script>

<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d'
    });
</script>

<?= $this->endSection(); ?>