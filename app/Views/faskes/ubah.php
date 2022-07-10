<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Faskes</h1>
    <p class="mb-4">Data Master Perubahan Data Faskes</p>
    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Data Faskes</h6>
        </div>
        <div class="card-body">
            <a href="/faskes" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="container-fluid">
            <form action="<?= route_to('perbaharui-faskes', $result['faskes_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="<?= $result['slug_faskes'] ?>" name="slug_faskes_lama">
                <div class=" row mb-3">
                    <label for="nama_faskes" class="col-sm-4 col-form-label">Nama Faskes</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('nama_faskes') ? 'is-invalid' : '' ?>" id="text" name="nama_faskes" value="<?= old('nama_faskes', $result['nama_faskes']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_faskes') ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="lat_faskes" class="col-sm-4 col-form-label">Latitude Faskes</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('lat_faskes') ? 'is-invalid' : '' ?>" id="text" name="lat_faskes" value="<?= old('lat_faskes', $result['lat_faskes']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('lat_faskes') ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="lon_faskes" class="col-sm-4 col-form-label">Longitude Faskes</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('lon_faskes') ? 'is-invalid' : '' ?>" id="text" name="lon_faskes" value="<?= old('lon_faskes', $result['lon_faskes']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('lon_faskes') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-4 col-form-label">Kota/Kabupaten</label>
                    <div class="col-sm">
                        <div class="form-group">
                            <select name="kota_kabupaten" id="kota_kabupaten" class="form-control input-lg">
                                <?php
                                foreach ($kota_kabupaten as $row) {
                                    echo '<option value="' . old("kota_kabupaten", $row["kota_kabupaten_id"]) . '">' . $row["nama_kota_kabupaten"] . '</option>';
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
                <div class=" row mb-3">
                    <label for="no_hp_faskes" class="col-sm-4 col-form-label">Nomor HP Faskes</label>
                    <div class="col-sm">
                        <input type="text" class="form-control <?= $validation->hasError('no_hp_faskes') ? 'is-invalid' : '' ?>" id="text" name="no_hp_faskes" value="<?= old('no_hp_faskes', $result['no_hp_faskes']) ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('no_hp_faskes') ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="alamat_faskes" class="col-sm-4 col-form-label">Alamat Faskes</label>
                    <div class="col-sm">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat_faskes" rows="3"><?= htmlspecialchars(old('alamat_faskes', $result['alamat_faskes'])); ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_faskes" class="col-sm-4 col-form-label">Gambar Faskes</label>
                    <div class="col-sm">
                        <input type="file" class="form-control <?= $validation->hasError('gambar_faskes') ? 'is-invalid' : '' ?>" name="gambar_faskes" id="gambar_faskes" value="<?= old('gambar_faskes') ?>" onchange="previewImage()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('gambar_anak') ?>
                        </div>
                        <div class="col-md-6">
                            <img src="/img/<?= $result['gambar_faskes'] != null ? $result['gambar_faskes'] : 'default-img-placeholder.png' ?>" alt="" class="img-preview img-thumbnail">
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