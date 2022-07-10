<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Anak</h1>
    <p class="mb-4">Data Master Detail Anak</p>
    <!-- Card detail artikel -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Anak</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="/anak" class="btn btn-info mb-4"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- Konten detail artikel-->
            <section>
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Anak</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['nama_anak']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Kelamin Anak</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['jenis_kelamin_anak']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tempat Lahir Anak Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['tempat_lahir_anak']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Lahir Anak</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['tanggal_lahir_anak']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kota/Kabupaten</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kota_kabupaten['0']['nama_kota_kabupaten']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kecamatan</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kecamatan['0']['nama_kecamatan']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Kelurahan/Desa</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_kelurahan_desa['0']['nama_kelurahan_desa']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['alamat_anak']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Ayah</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['nama_ayah']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Ibu</label>
                            <div class="col-sm">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data_anak['nama_ibu']; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Gambar Identitas Anak</label>
                            <div class="col-sm">
                                <img class="img-fluid" src="/img/<?= $data_anak['gambar_anak']; ?>" alt="..." width="450" />
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