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
                    <a href="/ayah" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Konten detail artikel-->
            <section>
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Identitas Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['nama_identitas']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['nama_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tempat Lahir Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['tempat_lahir_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Lahir Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['tanggal_lahir_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['email_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nomor HP Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['no_hp_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Pekerjaan Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['nama_pekerjaan']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Penghasilan Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['penghasilan_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['alamat_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Namam Istri</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['nama_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Jumlah Anak</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_ayah['jumlah_anak_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Gambar Identitas Ayah</label>
                            <div class="col-sm">
                                <img class="img-fluid" src="/img/<?= $data_ayah['gambar_identitas_ayah']; ?>" alt="..." width="450" />
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