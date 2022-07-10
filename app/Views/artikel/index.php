<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Artikel</h1>
    <p class="mb-4">Kumpulan artikel Kesehatan Ibu dan Anak</p>

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

    <!-- DataTales Example -->
    <!-- <div class="row"> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Artikel</h6>
        </div>
        <div class="card-body">
            <a href="<?= route_to('tambah-artikel') ?>" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Artikel</a>
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_artikel as $item) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $item['judul']; ?></td>
                                <td><?= $item['nama_artikel_kategori']; ?></td>
                                <td><?= substr($item['isi'], 0, 150) ?></td>
                                <td><img src="/img/<?= $item['gambar_artikel']; ?>" alt="" width="100px"></td>
                                <td>
                                    <a href="artikel-detail/<?= $item['slug'] ?>" class="btn btn-info mb-1"><i class="fa fa-eye"></i> Detail</a>
                                    <a href="artikel-ubah/<?= $item['slug'] ?>" class="btn btn-warning mb-1"><i class="fa fa-pen"></i> Ubah</a>
                                    <form action="artikel-hapus/<?= $item['artikel_id'] ?>" method="post" class="mb-1 d-inline">
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
    <!-- </div> -->

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>