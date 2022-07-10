<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengguna</h1>
    <!--Card data list daftar pengguna -->
    <div class="">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Daftar Pengguna</h6>
                    </div>
                    <div class="card-body">
                        <a href="artikel-buat-baru" class="btn btn-success mb-2"><i class="fa fa-plus-circle"></i> Tambah Pengguna</a>
                        <div class="table">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($users as $item) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $item->username; ?></td>
                                            <td><?= $item->email; ?></td>
                                            <td><?= $item->name; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/' . $item->userid); ?>" class="btn btn-info mb-1"><i class="fa fa-eye"></i> Detail</a>
                                                <a href="" class="btn btn-warning mb-1"><i class="fa fa-pen"></i> Ubah</a>
                                                <a href="" class="btn btn-danger mb-1"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>

    <!-- End card -->
</div>
<!-- End page konten -->
<?= $this->endSection(); ?>