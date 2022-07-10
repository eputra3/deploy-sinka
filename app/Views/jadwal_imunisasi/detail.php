<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Artikel</h1>
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deatil Artikel</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/artikel" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Konten detail artikel-->
            <section>
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <img class="img-fluid rounded-circle" src="/img/<?= $data_artikel['user_image']; ?>" alt="..." width="50" />
                            <div class="ms-3">
                                <div class="fw-bold ml-2"><?= $data_artikel['fullname']; ?></div>
                                <div class="text-muted ml-2"><?= $data_artikel['nama_artikel_kategori']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1"><?= $data_artikel['judul']; ?></h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2"><?= $data_artikel['created_at']; ?></div>
                                <!-- Post categories-->
                                <a class="badge badge-primary" href="">#tag-satu</a>
                                <a class="badge badge-success" href="">#tag-dua</a>
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
                <!-- </div> -->
            </section>
        </div>
    </div>
    <!-- End card -->
</div>

<?= $this->endSection(); ?>