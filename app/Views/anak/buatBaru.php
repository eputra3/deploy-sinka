<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat Baru Anak</h1>
    <p class="mb-4">Data Master Pembuatan Anak Baru</p>
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Anak Baru</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/anak" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Form Data -->
            <form action="<?= route_to('simpan-anak') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <!-- Konten detail artikel-->
                <!-- <section> -->
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Nama Anak</label>
                            <div class="col-sm">
                                <input type="text" class="form-control <?= $validation->hasError('nama_anak') ? 'is-invalid' : '' ?>" id="text" name="nama_anak" value="<?= old('nama_anak') ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('nama_anak') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm">
                                <select class="form-select form-control" aria-label="" name="jenis_kelamin_anak" value="<?= old('jenis_kelamin_anak') ?>">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Tempat Lahir Anak</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="tempat_lahir_anak" rows="3" placeholder="<?= old('tempat_lahir_anak') ?>"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_lahir_anak" class="col-sm-4 col-form-label">Tanggal Lahir Anak</label>
                            <div class="col-sm input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" name="tanggal_lahir_anak">
                                <div class="input-group-addon">
                                    <span><i class="fa fa-calendar ml-2 mt-2"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Kota/Kabupaten</label>
                            <div class="col-sm">
                                <div class="form-group">
                                    <select name="kota_kabupaten" id="kota_kabupaten" class="form-control input-lg">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        <?php
                                        foreach ($kota_kabupaten as $row) {
                                            echo '<option value="' . $row["kota_kabupaten_id"] . '">' . $row["nama_kota_kabupaten"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label for="" class="col-sm-4 col-form-label">Kecamatan</label>
                            <div class="col-sm">
                                <div class="form-group">
                                    <select name="kecamatan" id="kecamatan" class="form-control input-lg">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Kelurahan/Desa</label>
                            <div class="col-sm">
                                <select name="kelurahan_desa" id="kelurahan_desa" class="form-control input-lg">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-4 col-form-label">Alamat Anak</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat_anak" rows="3" placeholder="<?= old('alamat_anak') ?>"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="formFile" class="col-sm-4 col-form-label">Gambar Anak</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control <?= $validation->hasError('gambar_anak') ? 'is-invalid' : '' ?>" name="gambar_anak" id="gambar_anak" value="<?= old('gambar_anak') ?>" onchange="previewImage()">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('gambar_anak') ?>
                                </div>
                                <div class="col-md-6"><img src="/img/default-img-placeholder.png" alt="" class="img-preview img-thumbnail"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Ayah</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single1" id="" name="ayah">
                            <?php foreach ($ayah as $value1) : ?>
                                <option value="<?= $value1['ayah_id'] ?>"><?= $value1['nama_ayah'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-4 col-form-label">Ibu</label>
                    <div class="col-sm">
                        <select class="form-control js-example-basic-single2" id="" name="ibu">
                            <?php foreach ($ibu as $value2) : ?>
                                <option value="<?= $value2['ibu_id'] ?>"><?= $value2['nama_ibu'] ?></option>
                            <?php endforeach; ?>
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

<script>
    $(document).ready(function() {

        $('#kota_kabupaten').change(function() {

            var kota_kabupaten_id = $('#kota_kabupaten').val();

            var action = 'get_kecamatan';

            if (kota_kabupaten_id != '') {
                $.ajax({
                    url: "<?php echo base_url('/dynamic_dependent/action'); ?>",
                    method: "POST",
                    data: {
                        kota_kabupaten_id: kota_kabupaten_id,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">Pilih Kecamatan</option>';

                        for (var count = 0; count < data.length; count++) {

                            html += '<option value="' + data[count].kecamatan_id + '">' + data[count].nama_kecamatan + '</option>';

                        }

                        $('#kecamatan').html(html);
                    }
                });
            } else {
                $('#kecamatan').val('');
            }
            $('#kelurahan_desa').val('');
        });

        $('#kecamatan').change(function() {

            var kecamatan_id = $('#kecamatan').val();

            var action = 'get_kelurahan_desa';

            if (kecamatan_id != '') {
                $.ajax({
                    url: "<?php echo base_url('/dynamic_dependent/action'); ?>",
                    method: "POST",
                    data: {
                        kecamatan_id: kecamatan_id,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">Pilih Kelurahan/Desa</option>';

                        for (var count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].kelurahan_desa_id + '">' + data[count].nama_kelurahan_desa + '</option>';
                        }

                        $('#kelurahan_desa').html(html);
                    }
                });
            } else {
                $('#kelurahan_desa').val('');
            }

        });

    });
</script>

<?= $this->endSection(); ?>