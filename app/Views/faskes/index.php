<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Faskes</h1>
    <p class="mb-4">Peta Sebaran Fasilitas Kesehatan (Faskes)</p>

    <!-- Alert / Pesan Flash -->
    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('peringatan')) : ?>
        <div class="alert alert-warning" role="alert">
            <?= session()->getFlashdata('peringatan') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('eror')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('eror') ?>
        </div>
    <?php endif; ?>
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

        <?php foreach ($data_faskes as $item) : ?>
            L.marker([<?= $item['lat_faskes']; ?>, <?= $item['lon_faskes']; ?>]).addTo(map)
                .bindPopup('<b><?= $item['nama_faskes']; ?></b><br><?= $item['no_hp_faskes']; ?><br><?= $item['alamat_faskes']; ?>');
        <?php endforeach; ?>
    </script>

    <!-- DataTales Example -->
    <!--Card data list daftar pengguna -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Data Faskes</h6>
        </div>
        <div class="card-body">
            <a href="<?= route_to('tambah-faskes') ?>" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Data Faskes</a>
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Faskes</th>
                            <th>Nomor HP Faskes</th>
                            <th>Alamat Faskes</th>
                            <th>Gambar Faskes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_faskes as $item) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $item['nama_faskes']; ?></td>
                                <td><?= $item['no_hp_faskes']; ?></td>
                                <td><?= $item['alamat_faskes']; ?></td>
                                <td><img src="/img/<?= $item['gambar_faskes']; ?>" alt="" width="100px"></td>
                                <td>
                                    <a href="faskes-detail/<?= $item['slug_faskes'] ?>" class="btn btn-info mb-1"><i class="fa fa-eye"></i> Detail</a>
                                    <a href="faskes-ubah/<?= $item['slug_faskes'] ?>" class="btn btn-warning mb-1"><i class="fa fa-pen"></i> Ubah</a>
                                    <form action="faskes-hapus/<?= $item['faskes_id'] ?>" method="post" class="mb-1 d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>