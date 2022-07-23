<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
        <!-- <p class="mb-4">Data Master Ringkasan Laporan</p> -->
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah Data Anak -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Anak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_anak; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-baby fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Ayah -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Ayah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_ayah; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-mars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Ibu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Ibu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_ibu; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-venus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Faskes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_faskes; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-house-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Jumlah Data Imunisasi 1 -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Imunisasi</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Hepatitis B <span class="float-right"><?php echo $total_imunisasi_1; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width:<?php echo $total_imunisasi_1; ?>%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">BCG <span class="float-right"><?php echo $total_imunisasi_2; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $total_imunisasi_2; ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Polio Tetes 1 <span class="float-right"><?php echo $total_imunisasi_3; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $total_imunisasi_3; ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">DPT-HB-Hib 1 <span class="float-right"><?php echo $total_imunisasi_4; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_4; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Polio Tetes 2 <span class="float-right"><?php echo $total_imunisasi_5; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_5; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">DPT-HB-Hib 2 <span class="float-right"><?php echo $total_imunisasi_6; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_6; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Polio Tetes 3 <span class="float-right"><?php echo $total_imunisasi_7; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_7; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">DPT-HB-Hib 3 <span class="float-right"><?php echo $total_imunisasi_8; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_8; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Polio Tetes 4 <span class="float-right"><?php echo $total_imunisasi_9; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_9; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Imunisasi 2 -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Imunisasi</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Polio Suntik (IPV) <span class="float-right"><?php echo $total_imunisasi_10; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_10; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Campak - Rubella (MR) <span class="float-right"><?php echo $total_imunisasi_11; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_11; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">DPT-Hib-HB Lanjutan <span class="float-right"><?php echo $total_imunisasi_12; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_12; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Campak - Rubella (MR) Lanjutan <span class="float-right"><?php echo $total_imunisasi_13; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_13; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PCV 1 <span class="float-right"><?php echo $total_imunisasi_14; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_14; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PCV 2 <span class="float-right"><?php echo $total_imunisasi_15; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_15; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Japanese Encephalitis <span class="float-right"><?php echo $total_imunisasi_16; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_16; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PCV 3 <span class="float-right"><?php echo $total_imunisasi_17; ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total_imunisasi_17; ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Berdasarkan Jenis Kelamins -->
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Gender</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <div>
                    <canvas id="chartJumlahJenisKelaminAnak"></canvas>
                </div>
                <script>
                    const data = {
                        labels: [
                            'Perempuan',
                            'Laki-laki',
                            // 'Yellow'
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: [<?php echo $total_jenis_kelamin_anak_perempuan; ?>,
                                <?php echo $total_jenis_kelamin_anak_laki; ?>,
                                // 100
                            ],
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                // 'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4
                        }]
                    };

                    const config = {
                        type: 'pie',
                        data: data,
                    };

                    const myChart = new Chart(
                        document.getElementById('chartJumlahJenisKelaminAnak'),
                        config
                    );
                </script>

            </div>
        </div>
    </div>

    <div class="row">

        <!-- Jumlah Artikel/Berita -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Artikel/Berita</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_artikel_berita; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Catatan Riwayat Pertumbuhan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Catatan Riwayat Pertumbuhan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_riwayat_pertumbuhan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-weight-scale fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Imunisasi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Imunisasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_riwayat_imunisasi; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Pengguna -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_pengguna; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>