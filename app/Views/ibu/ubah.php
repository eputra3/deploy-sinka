<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Ibu</h1>
    <p class="mb-4">Data Master Perubahan Data Ibu</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Data Ibu</h6>
        </div>
        <div class="card-body">
            <a href="/ibu" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <form action="<?= route_to('perbaharui-ibu', $result['ibu_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_ibu'] ?>" name="slug_ibu_lama">
                <div class="row mb-3">
                    <label for="identitas_ibu" class="col-sm-4 col-form-label">Identitas Ayah</label>
                    <div class="col-sm">
                        <select class="form-control" name="identitas_ibu">
                            <?php foreach ($identitas as $item) : ?>
                                <option value="<?= $item['identitas_id'] ?>" <?= old('identitas_ibu', $result['identitas_ibu']) == $item['identitas_id'] ? 'selected' : '' ?>><?= $item['nama_identitas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_ibu" class="col-sm-4 col-form-label">Nama Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('nama_ibu') ? 'is-invalid' : '' ?>" id="text" name="nama_ibu" value="<?= old('nama_ibu', $result['nama_ibu']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_ibu') ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="tempat_lahir_ibu" class="col-sm-4 col-form-label">Tempat Lahir Ayah</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="tempat_lahir_ibu" rows="3"><?= htmlspecialchars(old('tempat_lahir_ibu', $result['tempat_lahir_ibu'])); ?></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_lahir_ibu" class="col-sm-4 col-form-label">Tanggal Lahir Ayah</label>
                    <div class="col-sm input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" value="<?= old('tempat_lahir_ibu', $result['tempat_lahir_ibu']) ?>" name="tempat_lahir_ibu">
                        <div class="input-group-addon">
                            <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email_ibu" class="col-sm-4 col-form-label">Email Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('email_ibu') ? 'is-invalid' : '' ?>" id="text" name="email_ibu" value="<?= old('email_ibu', $result['email_ibu']) ?>">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_hp_ibu" class="col-sm-4 col-form-label">Nomor HP Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('no_hp_ibu') ? 'is-invalid' : '' ?>" id="text" name="no_hp_ibu" value="<?= old('no_hp_ibu', $result['no_hp_ibu']) ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Pekerjaan Ayah</label>
                    <div class="col-sm">
                        <select class="form-control" id="specificSizeSelect" name="pekerjaan_ibu">
                            <?php foreach ($pekerjaan as $value) : ?>
                                <option value="<?= $value['pekerjaan_id'] ?>" <?= old('pekerjaan_ibu', $result['pekerjaan_ibu']) == $value['pekerjaan_id'] ? 'selected' : '' ?>><?= $value['nama_pekerjaan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penghasilan_ibu" class="col-sm-4 col-form-label">Penghasilan Ayah</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('penghasilan_ibu') ? 'is-invalid' : '' ?>" id="text" name="penghasilan_ibu" value="<?= old('penghasilan_ibu', $result['penghasilan_ibu']) ?>">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_identitas_ibu" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_identitas_ibu') ? 'is-invalid' : '' ?>" name="gambar_identitas_ibu" id="gambar_identitas_ibu" value="<?= old('gambar_identitas_ibu') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_identitas_ibu') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_identitas_ibu'] != null ? $result['gambar_identitas_ibu'] : 'default-img-placeholder.png' ?>" alt="" class="img-preview img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Istri</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single" id="specificSizeSelect" name="suami">
                            <?php foreach ($ayah as $value) : ?>
                                <option value="<?= $value['ayah_id'] ?>" <?= old('suami', $result['suami']) == $value['ayah_id'] ? 'selected' : '' ?>><?= $value['nama_ayah'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Anak</label>
                    <div class="col-sm">
                        <select class="form-control" id="jumlah_anak_ibu" name="jumlah_anak_ibu">
                            <option value="1">Satu</option>
                            <option value="2">Dua</option>
                            <option value="3">Tiga</option>
                            <option value="4">Empat</option>
                            <option value="5">Lima</option>
                        </select>
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

<?= $this->endSection(); ?>