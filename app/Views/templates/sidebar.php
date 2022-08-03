<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin/dasbor">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-baby"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SINKA NTT</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dasbor'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dasbor</span></a>
    </li>

    <?php if (in_groups('admin')) : ?>
        <!-- Divider Data Kesehatan Anak -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Data Masyarakat
        </div>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('anak'); ?>">
                <i class="fas fa-baby"></i>
                <span>Anak</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('ayah'); ?>">
                <i class="fas fa-mars"></i>
                <span>Ayah</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('ibu'); ?>">
                <i class="fas fa-venus"></i>
                <span>Ibu</span></a>
        </li>

        <!-- Divider Interface -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Catatan Kesehatan
        </div>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('riwayat-imunisasi'); ?>">
                <i class="fas fa-syringe"></i>
                <span>Riwayat Imunisasi</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('riwayat-pertumbuhan'); ?>">
                <i class="fas fa-weight-scale"></i>
                <span>Riwayat Pertumbuhan</span></a>
        </li>

        <!-- Divider Imunisasi -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Publikasi
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('artikel'); ?>">
                <i class="fas fa-newspaper"></i>
                <span>Artikel / Berita</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('jadwal-imunisasi'); ?>">
                <i class="fas fa-calendar"></i>
                <span>Jadwal Imunisasi</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('faskes'); ?>">
                <i class="fas fa-house-medical"></i>
                <span>Lokasi Faskes</span></a>
        </li>
    <?php endif; ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <?php if (in_groups('admin')) : ?>
        <!-- Divider Interface -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-map-location-dot"></i>
                <span>Alamat</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kustom Alamat:</h6>
                    <a class="collapse-item" href="kota-kabupaten">Kota/Kabupaten</a>
                    <a class="collapse-item" href="kecamatan">Kecamatan</a>
                    <a class="collapse-item" href="kelurahan-desa">Kelurahan/Desa</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('jenis-imunisasi'); ?>">
                <i class="fas fa-pills"></i>
                <span>Imunisasi</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('artikel-kategori'); ?>">
                <i class="fas fa-tags"></i>
                <span>Kategori Artikel</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-users"></i>
                <span>Pengguna</span></a>
        </li>
    <?php endif ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>