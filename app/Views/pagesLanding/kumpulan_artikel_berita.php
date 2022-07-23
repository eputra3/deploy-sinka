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
                    <h2 class="fw-bolder fs-5 mb-4">Kumpulan Artikel/Berita</h2>
                    <div class="row gx-5">
                        <?php foreach ($data_artikel as $item) : ?>
                            <div class="col-lg-4 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top" src="/img/<?= $item['gambar_artikel']; ?>" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">Baru</div>
                                        <a class="text-decoration-none link-dark stretched-link" href="artikel-berita-detail/<?= $item['slug'] ?>">
                                            <h5 class="card-title mb-3"><?= $item['judul']; ?></h5>
                                        </a>
                                        <p class="card-text mb-0"><?= substr($item['isi'], 0, 150) ?></p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle me-3" src="https://pdki-indonesia-api.dgip.go.id/storage/data-merek/application-brand/2022/04/20/62fb6559-2c8c-4b02-bcee-73d5c7f757a2.jpg" width="10%" alt=" ..." />
                                                <div class="small">
                                                    <div class="fw-bold">Publikasi :</div>
                                                    <div class="text-muted"><?= $item['created_at']; ?></div>
                                                </div>
                                            </div>
                                        </div>
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