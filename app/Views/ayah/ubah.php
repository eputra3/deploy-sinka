<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Ayah</h1>
    <p class="mb-4">Data Master Perubahan Data Ayah</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Data Ayah</h6>
        </div>
        <div class="card-body">
            <a href="/ayah" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <form action="<?= route_to('perbaharui-ayah', $result['ayah_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_ayah'] ?>" name="slug_ayah_lama">
                <div class="row mb-3">
                    <label for="identitas_ayah" class="col-sm-4 col-form-label">Identitas Ayah</label>
                    <div class="col-sm">
                        <select class="form-control" name="identitas_ayah">
                            <?php foreach ($identitas as $item) : ?>
                                <option value="<?= $item['identitas_id'] ?>" <?= old('identitas_ayah', $result['identitas_ayah']) == $item['identitas_id'] ? 'selected' : '' ?>><?= $item['nama_identitas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ayah" class="col-sm-4 col-form-label">Nama Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('nama_ayah') ? 'is-invalid' : '' ?>" id="text" name="nama_ayah" value="<?= old('nama_ayah', $result['nama_ayah']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_ayah') ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="tempat_lahir_ayah" class="col-sm-4 col-form-label">Tempat Lahir Ayah</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="tempat_lahir_ayah" rows="3"><?= htmlspecialchars(old('tempat_lahir_ayah', $result['tempat_lahir_ayah'])); ?></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_lahir_ayah" class="col-sm-4 col-form-label">Tanggal Lahir Ayah</label>
                    <div class="col-sm input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" value="<?= old('tanggal_lahir_ayah', $result['tanggal_lahir_ayah']) ?>" name="tanggal_lahir_ayah">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email_ayah" class="col-sm-4 col-form-label">Email Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('email_ayah') ? 'is-invalid' : '' ?>" id="text" name="email_ayah" value="<?= old('email_ayah', $result['email_ayah']) ?>">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_hp_ayah" class="col-sm-4 col-form-label">Nomor HP Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('no_hp_ayah') ? 'is-invalid' : '' ?>" id="text" name="no_hp_ayah" value="<?= old('no_hp_ayah', $result['no_hp_ayah']) ?>">

                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Pekerjaan Ayah</label>
                    <div class="col-sm">
                        <select class="form-control" id="specificSizeSelect" name="pekerjaan_ayah">
                            <?php foreach ($pekerjaan as $value) : ?>
                                <option value="<?= $value['pekerjaan_id'] ?>" <?= old('pekerjaan_ayah', $result['pekerjaan_ayah']) == $value['pekerjaan_id'] ? 'selected' : '' ?>><?= $value['nama_pekerjaan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penghasilan_ayah" class="col-sm-4 col-form-label">Penghasilan Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('penghasilan_ayah') ? 'is-invalid' : '' ?>" id="text" name="penghasilan_ayah" value="<?= old('penghasilan_ayah', $result['penghasilan_ayah']) ?>">

                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="alamat_ayah" class="col-sm-4 col-form-label">Alamat Ayah</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat_ayah" rows="3"><?= htmlspecialchars(old('alamat_ayah', $result['alamat_ayah'])); ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_identitas_ayah" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_identitas_ayah') ? 'is-invalid' : '' ?>" name="gambar_identitas_ayah" id="gambar_identitas_ayah" value="<?= old('gambar_identitas_ayah') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_identitas_ayah') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_identitas_ayah'] != null ? $result['gambar_identitas_ayah'] : 'default-img-placeholder.png' ?>" alt="" class="img-preview img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Istri</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="specificSizeSelect" name="istri">
                            <?php foreach ($ibu as $value) : ?>
                                <option value="<?= $value['ibu_id'] ?>" <?= old('istri', $result['istri']) == $value['ibu_id'] ? 'selected' : '' ?>><?= $value['nama_ibu'] ?></option>
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