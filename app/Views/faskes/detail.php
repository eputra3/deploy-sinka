<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail</h1>
    <!-- <p class="mb-4">Data Master Detail Faskes</p> -->
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Faskes</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/faskes" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Konten detail artikel-->
            <section>
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_faskes['nama_faskes']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Latitude</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_faskes['lat_faskes']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Longitude</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_faskes['lon_faskes']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kota/Kabupaten</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kota_kabupaten['0']['nama_kota_kabupaten']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kecamatan</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kecamatan['0']['nama_kecamatan']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kelurahan/Desa</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kelurahan_desa['0']['nama_kelurahan_desa']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_faskes['alamat_faskes']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Gambar</label>
                            <div class="col-sm">
                                <img class="img-fluid" src="/img/<?= $data_faskes['gambar_faskes']; ?>" alt="..." width="450" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </section>
        </div>
    </div>
    <!-- End card -->
    <p></p>
    <div id="map"></div>
    <p></p>
    <!-- LeafletJs -->
    <style>
        #map {
            height: 500px;
        }
    </style>

    <script>
        var map = L.map('map').setView([-10.178757, 123.597603], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([<?= $data_faskes['lat_faskes']; ?>, <?= $data_faskes['lon_faskes']; ?>]).addTo(map)
            .bindPopup('<b><?= $data_faskes['nama_faskes']; ?></b><br><?= $data_faskes['no_hp_faskes']; ?><br><?= $data_faskes['alamat_faskes']; ?>');
    </script>
</div>

<?= $this->endSection(); ?>