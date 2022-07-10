<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <h2 class="text-center mt-4 mb-4">Codeigniter 4 Dynamic Dependent Dropdown with Ajax</h2>
    <span id="message"></span>
    <div class="card">
        <div class="card-header">Codeigniter 4 Dynamic Dependent Dropdown with Ajax</div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col col-lg-6">
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
                    <div class="form-group">
                        <select name="kecamatan" id="kecamatan" class="form-control input-lg">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kelurahan_desa" id="kelurahan_desa" class="form-control input-lg">
                            <option value="">Pilih Kelurahan/Desa</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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