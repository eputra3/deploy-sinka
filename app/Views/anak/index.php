<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Anak</h1>
    <!-- <p class="mb-4">Data Master Anak</p> -->

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
    <!--Card data list daftar pengguna -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Data Anak</h6>
        </div>
        <div class="card-body">
            <a href="<?= route_to('tambah-anak') ?>" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Data Anak</a>
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Lengkap</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_anak as $item) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $item['nama_anak']; ?></td>
                                <td><?= $item['jenis_kelamin_anak']; ?></td>
                                <td><?= $item['alamat_anak']; ?></td>
                                <td><?= $item['nama_ayah']; ?></td>
                                <td><?= $item['nama_ibu']; ?></td>
                                <td>
                                    <a href="anak-detail/<?= $item['slug_anak'] ?>" class="btn btn-info mb-1"><i class="fa fa-eye"></i> Detail</a>
                                    <a href="anak-ubah/<?= $item['slug_anak'] ?>" class="btn btn-warning mb-1"><i class="fa fa-pen"></i> Ubah</a>
                                    <form action="anak-hapus/<?= $item['anak_id'] ?>" method="post" class="mb-1 d-inline">
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