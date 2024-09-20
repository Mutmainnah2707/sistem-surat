<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Site Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('/') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('logo/logo1.png') ?>" alt="Logo" style="max-width: 100px; height: auto;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= uri_string() === 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Surat
    </div>

    <?php if (in_groups(['admin', 'satker', 'penpon'])): ?>
        <!-- Surat Masuk -->
        <li class="nav-item <?= uri_string() === 'surat-masuk' || uri_string() === 'surat-masuk/create' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('surat-masuk') ?>">
                <i class="fas fa-fw fa-inbox"></i>
                <span>Surat Masuk</span>
            </a>
        </li>
    <?php endif ?>

    <?php if (in_groups(['admin', 'satker'])): ?>
        <!-- Surat Keluar -->
        <li class="nav-item <?= uri_string() === 'surat-keluar' || uri_string() === 'surat-keluar/create' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('surat-keluar') ?>">
                <i class="fas fa-fw fa-paper-plane"></i>
                <span>Surat Keluar</span>
            </a>
        </li>
    <?php endif ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if (in_groups('admin')): ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Laporan -->
        <li class="nav-item <?= uri_string() === 'laporan/surat-masuk' || uri_string() === 'laporan/surat-keluar' ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseLaporan" class="collapse <?= uri_string() === 'laporan/surat-masuk' || uri_string() === 'laporan/surat-keluar' ? 'show' : '' ?>" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= uri_string() === 'laporan/surat-masuk' ? 'active' : '' ?>" href="<?= site_url('laporan/surat-masuk') ?>">Laporan Masuk</a>
                    <a class="collapse-item <?= uri_string() === 'laporan/surat-keluar' ? 'active' : '' ?>" href="<?= site_url('laporan/surat-keluar') ?>">Laporan Keluar</a>
                </div>
            </div>
        </li>

        <!-- User Management -->
        <li class="nav-item <?= uri_string() === 'manajemen-pengguna/admin' || uri_string() === 'manajemen-pengguna/satker' || uri_string() === 'manajemen-pengguna/penpon' ? 'active' : '' ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="true" aria-controls="collapsePengguna">
                <i class="fas fa-users"></i>
                <span>User Management</span>
            </a>
            <div id="collapsePengguna" class="collapse <?= uri_string() === 'manajemen-pengguna/admin' || uri_string() === 'manajemen-pengguna/satker' || uri_string() === 'manajemen-pengguna/penpon' ? 'show' : '' ?>" aria-labelledby="headingPengguna" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= uri_string() === 'manajemen-pengguna/admin' ? 'active' : '' ?>" href="<?= site_url('manajemen-pengguna/admin') ?>">Admin</a>
                    <a class="collapse-item <?= uri_string() === 'manajemen-pengguna/satker' ? 'active' : '' ?>" href="<?= site_url('manajemen-pengguna/satker') ?>">Satker</a>
                    <a class="collapse-item <?= uri_string() === 'manajemen-pengguna/penpon' ? 'active' : '' ?>" href="<?= site_url('manajemen-pengguna/penpon') ?>">Pengurus Pondok</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    <?php endif ?>

    <!-- Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>