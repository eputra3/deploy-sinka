<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!--Page konten -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelurahan dan Desa</h1>
    <p class="mb-4">Data Master Kelurahan di NTT</p>

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

    <!-- Card data list Kecamatan -->
    <div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Kelurahan</h6>
                    </div>
                    <div class="card-body">
                        <a href="kelurahan-desa-buat-baru" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Kelurahan/Desa</a>
                        <div class="table">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Nama Kelurahan/Desa</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_kelurahan_desa as $value) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $value['nama_kecamatan']; ?></td>
                                            <td><?= $value['nama_kelurahan_desa']; ?></td>
                                            <td><img src="/img/<?= $value['gambar_kelurahan_desa']; ?>   " alt="" width="75px"></td>
                                            <td>
                                                <a href="kelurahan-desa-ubah/<?= $value['slug_kelurahan_desa'] ?>" class="btn btn-warning mb-1 mt-1"><i class="fa fa-pen"></i> Ubah</a>
                                                <form action="kelurahan-desa-hapus/<?= $value['kelurahan_desa_id'] ?>" method="post" class="mb-1 d-inline">
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
            <div class="col">
            </div>
        </div>
    </div>
    <!-- End card-->
</div>
<!-- End page konten -->

<?= $this->endSection(); ?>