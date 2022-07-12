<?= $this->extend('layoutLanding/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Konten detail artikel-->
    <section>
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1 mt-4"><?= $data_artikel['judul']; ?></h1>
                        <!-- Post meta content-->
                        <div class="fw-bold"><?= $data_artikel['fullname']; ?>, <?= $data_artikel['nama_artikel_kategori']; ?></div>
                        <div class="text-muted fst-italic mb-2"><?= $data_artikel['created_at']; ?></div>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="/img/<?= $data_artikel['gambar_artikel']; ?>" alt="..." width="900" /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4"><?php echo nl2br(htmlspecialchars($data_artikel['isi'])) ?></p>
                    </section>
                </article>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>