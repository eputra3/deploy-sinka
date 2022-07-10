<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Ayah</h1>
    <p class="mb-4">Data Master Detail Ayah</p>
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Ayah</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/ibu" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Konten detail artikel-->
            <section>
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Identitas Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['nama_identitas']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['nama_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tempat Lahir Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['tempat_lahir_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Lahir Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['tanggal_lahir_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['email_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nomor HP Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['no_hp_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Pekerjaan Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['nama_pekerjaan']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Penghasilan Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['penghasilan_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['alamat_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Namam Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['nama_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Jumlah Anak</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ibu['jumlah_anak_ibu']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="author_user_id" class="col-sm-4 col-form-label">Penginput</label>
                            <div class="col-sm mt-2">
                                <input type="hidden" class="form-control-plaintext" value="<?= user()->id ?>" name="author_user_id" readonly><?= user()->username; ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Gambar Identitas Ibu</label>
                            <div class="col-sm">
                                <img class="img-fluid" src="/img/<?= $data_ibu['gambar_identitas_ayah']; ?>" alt="..." width="450" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </section>
        </div>
    </div>
    <!-- End card -->
</div>

<?= $this->endSection(); ?>