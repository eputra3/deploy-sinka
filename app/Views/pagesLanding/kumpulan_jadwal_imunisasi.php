<?= $this->extend('layoutLanding/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Konten detail artikel-->
    <!-- <div class="container-fluid"> -->
    <div class="row">
        <!-- Post content-->
        <!-- Page Content-->
        <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5">
                <h2 class="fw-bolder fs-5 mb-4">Kumpulan Artikel/Berita</h2>
                <div class="row gx-5">
                    <?php foreach ($data_jadwal_imunisasi as $item) : ?>
                        <div class="col-lg-3 mb-5">
                            <div class="card border-info mb-3" style="max-width: 18rem;">
                                <div class="card-header">
                                    <b><?= $item['nama_jadwal_imunisasi']; ?> </b>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fa fa-calendar"></i> <?= $item['tanggal_jadwal_imunisasi']; ?>
                                    </h6>
                                    <h6 class="card-title">
                                        <i class="fa fa-clock"></i> <?= $item['waktu_jadwal_imunisasi']; ?>
                                    </h6>
                                    <h6 class="card-title">
                                        <i class="fa fa-map-location-dot"></i> <?= $item['nama_faskes']; ?> <br><?= $item['alamat_faskes']; ?>
                                    </h6>
                                    <h6 class="card-title">
                                        <i class="fa fa-pills"></i> <?= $item['nama_jenis_imunisasi']; ?>
                                    </h6>
                                    <p class="card-text"><?= substr($item['deskripsi_jadwal_imunisasi'], 0, 150) ?>....</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>
</section>
</div>

<?= $this->endSection(); ?>