<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Artikel</h1>
    <div class="row">
        <div class="col-lg-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data_artikel as $item) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $item['judul']; ?></td>
                            <td><?= $item['slug']; ?></td>
                            <td><?= $item['nama_kategori']; ?></td>
                            <td><?= $item['artikel_image']; ?></td>
                            <td>
                                <a href="detail-artikel/<?= $item['slug'] ?>" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>