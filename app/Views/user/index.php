<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>
    <!-- <p class="mb-4">Data Master Profil Pribadi</p> -->
    <!--Card data list daftar pengguna -->
    <div class="">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Detail</h6>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('admin'); ?>" class="btn btn-info mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?= base_url('img/' . user()->user_image); ?>" class="card-img mt-1" alt="<?= user()->username; ?>" />
                            </div>
                            <div class="col-lg">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <h4><?= user()->username; ?></h4>
                                    </li>
                                    <?php if (user()->fullname) : ?>
                                        <li class="list-group-item"><?= user()->fullname; ?></li>
                                    <?php endif; ?>
                                    <li class="list-group-item"><?= user()->email; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>