<?= $this->extend('layoutLanding/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Konten detail artikel-->
    <section>
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <!-- Post content-->
            <!-- Page Content-->
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5">
                    <h2 class="fw-bolder fs-5 mb-4">Kumpulan Jadwal Imunisasi</h2>
                    <div class="row gx-5">
                        <?php foreach ($data_jadwal_imunisasi as $item) : ?>
                            <div class="col mb-5 h-100">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2"><i class="fa fa-calendar"></i> <?= $item['tanggal_jadwal_imunisasi']; ?>, <?= $item['waktu_jadwal_imunisasi']; ?></div>
                                <h2 class="h5"><?= $item['nama_jadwal_imunisasi']; ?></h2>
                                <p class="mb-0"><?= substr($item['deskripsi_jadwal_imunisasi'], 0, 150) ?></p>
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