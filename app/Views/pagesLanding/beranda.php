<?= $this->extend('layoutLanding/template'); ?>

<?= $this->section('content'); ?>
<!-- Header-->
<header class="bg-info py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Sistem Informasi Kesehatan Anak</h1>
                    <p class="lead fw-normal text-white mb-4">SINKA (Sistem Informasi Kesehatan Ibu dan Anak) merupakan aplikasi untuk informasi dan edukasi terkait kesehatan Ibu dan Anak untuk mengatasi stunting di Provinsi Nusa Tenggara Timur (NTT).</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <!-- <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Unduh</a> -->
                        <a class="btn btn-outline-light btn-lg px-4" href="#jadwal-imunisasi">Lebih Banyak</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="img/gub-wagub-ntt-biru.png" alt="..." /></div>
        </div>
    </div>
</header>
<!-- Jadwal Imunisasi section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0" id="jadwal-imunisasi">Jadwal Imunisasi Terdekat</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <?php foreach ($data_jadwal_imunisasi as $item) : ?>
                        <div class="col mb-5 h-100">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2"><i class="fa fa-calendar"></i> <?= $item['tanggal_jadwal_imunisasi']; ?>, <?= $item['waktu_jadwal_imunisasi']; ?></div>
                            <h2 class="h5"><?= $item['nama_jadwal_imunisasi']; ?></h2>
                            <p class="mb-0"><?= substr($item['deskripsi_jadwal_imunisasi'], 0, 150) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</section>

<!-- Lokasi Faskes -->
<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder" id="lokasi-faskes">Lokasi Faskes</h2>
                    <p class="lead fw-normal text-muted mb-5">Peta sebaran lokasi Fasilitas Kesehatan (Faskes) Ibu dan Anak di Provinsi NTT.</p>
                </div>
            </div>
        </div>
        <div id="map"></div>
        <p></p>
        <!-- LeafletJs -->
        <style>
            #map {
                height: 500px;
            }
        </style>
    </div>
</section>
<script>
    var map = L.map('map').setView([-10.178757, 123.597603], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    <?php foreach ($data_faskes as $item) : ?>
        L.marker([<?= $item['lat_faskes']; ?>, <?= $item['lon_faskes']; ?>]).addTo(map)
            .bindPopup('<?= $item['nama_faskes']; ?>');
    <?php endforeach; ?>
</script>
<!-- End Lokasi Faskes -->

<!-- Testimonial section-->
<div class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-7">
                <div class="text-center">
                    <div class="fs-4 mb-4 fst-italic">"Dengan penerapan teknologi informasi dalam penanganan stunting di NTT, saya optimis kita segera menghasilkan generasi unggul masa depan !"</div>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="rounded-circle me-3" src="https://static.gatra.com/foldershared/images/2020/adl/05-May/viktor.jpg" alt="..." width="30" height="30" />
                        <div class="fw-bold">
                            Viktor B. Laiskodat
                            <span class="fw-bold text-primary mx-1">/</span>
                            Gubernur NTT
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sponsorship section-->
<div class="py-5 bg-light">
    <div class="container px-5 my-5">
        <div class="row">
            <div class="col text-center">
                <img class="align-center" src="http://dinkes.sanggau.go.id/wp-content/uploads/2018/10/cropped-logo-kemenkes-baru-2016-1.png" alt="" width="50" height="50" />
                <div class="fw-bold">
                    Kementerian Kesehatan RI
                </div>
            </div>
            <div class="col text-center">
                <img class="align-center" src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Coat_of_arms_of_East_Nusa_Tenggara.svg" alt="" width="50" height="50" />
                <div class="fw-bold">
                    Pemerintah Provinsi NTT
                </div>
            </div>
            <div class="col text-center">
                <img class="align-center" src="https://pdki-indonesia-api.dgip.go.id/storage/data-merek/application-brand/2022/04/20/62fb6559-2c8c-4b02-bcee-73d5c7f757a2.jpg" alt="" width="45" height="45" />
                <div class="fw-bold">
                    Tim Tapaleuk | PT.Lingkar Inovasi Nusantara
                </div>
            </div>
            <div class="col text-center">
                <img class="align-center" src="https://1.bp.blogspot.com/-H0d7hj0hR6k/YRzkdOse1OI/AAAAAAAAFuQ/tr9d85pfVzIrWye4g99nAccyp_qOGSebgCLcBGAsYHQ/s1600/Logo%2BBank%2BNTT.png" alt="" width="70" height="" />
                <div class="fw-bold">
                    PT.Bank Pembangunan Daerah NTT
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog preview section-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder" id="artikel-berita">Artikel / Berita</h2>
                    <p class="lead fw-normal text-muted mb-5">Kumpulan informasi tentang kesehatan Ibu dan Anak, Publikasi Pemerintah Daerah (Pemda) NTT, serta gaya hidup sehat.</p>
                </div>
            </div>
        </div>
        <!-- <?php echo d($data_artikel); ?> -->
        <div class="row gx-5">
            <?php foreach ($data_artikel as $item) : ?>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="/img/<?= $item['gambar_artikel']; ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Baru</div>
                            <a class="text-decoration-none link-dark stretched-link" href="artikel-berita-detail/<?= $item['slug'] ?>">
                                <h5 class="card-title mb-3"><?= $item['judul']; ?></h5>
                            </a>
                            <p class="card-text mb-0"><?= substr($item['isi'], 0, 150) ?></p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://pdki-indonesia-api.dgip.go.id/storage/data-merek/application-brand/2022/04/20/62fb6559-2c8c-4b02-bcee-73d5c7f757a2.jpg" width="10%" alt=" ..." />
                                    <div class="small">
                                        <div class="fw-bold">Publikasi :</div>
                                        <div class="text-muted"><?= $item['created_at']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Call to action-->
        <!-- <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
            <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                    <div class="fs-3 fw-bold text-white">New products, delivered to you.</div>
                    <div class="text-white-50">Sign up for our newsletter for the latest updates.</div>
                </div>
                <div class="ms-xl-4">
                    <div class="input-group mb-2">
                        <input class="form-control" type="text" placeholder="Email address..." aria-label="Email address..." aria-describedby="button-newsletter" />
                        <button class="btn btn-outline-light" id="button-newsletter" type="button">Sign up</button>
                    </div>
                    <div class="small text-white-50">We care about privacy, and will never share your data.</div>
                </div>
            </div>
        </aside> -->
    </div>

</section>
</main>

<?= $this->endSection(); ?>