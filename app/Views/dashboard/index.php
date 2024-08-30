<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Surat</title>
    <link href="<?= base_url('assetAdmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assetAdmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('/') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('logo/logo1.png') ?>" alt="Logo" style="max-width: 100px; height: auto;">
                    <!-- Ganti dengan ikon surat jika perlu -->
                </div>
                <div class="sidebar-brand-text mx-3"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= uri_string() === 'dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Surat Masuk -->
            <li class="nav-item <?= uri_string() === 'surat/surat_masuk' || uri_string() === 'surat/create_surat_masuk' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('surat/surat_masuk') ?>">
                    <i class="fas fa-fw fa-inbox"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>

            <!-- Nav Item - Surat Keluar -->
            <li class="nav-item <?= uri_string() === 'surat/surat_keluar' || uri_string() === 'surat/create_surat_keluar' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('surat/surat_keluar') ?>">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Laporan -->
            <li class="nav-item <?= uri_string() === 'laporan/masuk' || uri_string() === 'laporan/keluar' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseLaporan" class="collapse <?= uri_string() === 'laporan/masuk' || uri_string() === 'laporan/keluar' ? 'show' : '' ?>" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= uri_string() === 'laporan/masuk' ? 'active' : '' ?>" href="<?= site_url('laporan/masuk') ?>">Laporan Masuk</a>
                        <a class="collapse-item <?= uri_string() === 'laporan/keluar' ? 'active' : '' ?>" href="<?= site_url('laporan/keluar') ?>">Laporan Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Admin -->
            <li class="nav-item <?= uri_string() === 'admin/list-admin' || uri_string() === 'admin/list-satker' || uri_string() === 'admin/list-pengurus' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="true" aria-controls="collapsePengguna">
                    <i class="fas fa-users"></i>
                    <span>Admin</span>
                </a>
                <div id="collapsePengguna" class="collapse <?= uri_string() === 'admin/list-admin' || uri_string() === 'admin/list-satker' || uri_string() === 'admin/list-pengurus' ? 'show' : '' ?>" aria-labelledby="headingPengguna" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= uri_string() === 'admin/list-admin' ? 'active' : '' ?>" href="<?= site_url('admin/list-admin') ?>">Daftar Admin</a>
                        <a class="collapse-item <?= uri_string() === 'admin/list-satker' ? 'active' : '' ?>" href="<?= site_url('admin/list-satker') ?>">Daftar Satker</a>
                        <a class="collapse-item <?= uri_string() === 'admin/list-pengurus' ? 'active' : '' ?>" href="<?= site_url('admin/list-pengurus') ?>">Daftar Pengurus Pondok</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Disposisi -->
            <li class="nav-item <?= uri_string() === 'admin/disposisi' || uri_string() === 'admin/disposisi/create' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('admin/disposisi') ?>">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Disposisi</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Settings -->
            <li class="nav-item <?= uri_string() === 'settings' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('settings') ?>">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('auth/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Content -->
            <div id="content">

                <!-- Topbar Navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php if ($jumlahBelumDibaca > 0): ?>
                                    <span class="badge badge-danger badge-counter"><?= $jumlahBelumDibaca ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Surat Masuk Belum Dibaca
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="<?= site_url('surat/surat_masuk') ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-envelope text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold"><?= $jumlahBelumDibaca ?> Surat Masuk Belum Dibaca</span>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="<?= base_url('assetAdmin/img/undraw_profile.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= site_url('profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->



                    <!-- Content Row -->
                    <div class="row">
                        <?= $this->renderSection('content') ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Content -->

            <!-- Footer -->
            <footer class="footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>© 2024 Sistem Surat Menyurat UA</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="<?= base_url('assetAdmin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/js/sb-admin-2.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>