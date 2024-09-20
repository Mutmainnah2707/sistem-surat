<?= $this->extend('template/index'); ?>

<?= $this->section('title'); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">

    <?php if (in_groups(['admin', 'satker', 'penpon'])): ?>
        <!-- Surat Masuk -->
        <div class="col-lg-4 mb-4">
            <a href="<?= site_url('surat-masuk') ?>" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Detail</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-inbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>

    <?php if (in_groups(['admin', 'satker'])): ?>
        <!-- Surat Keluar -->
        <div class="col-lg-4 mb-4">
            <a href="<?= site_url('surat-keluar') ?>" class="card border-left-success shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Surat Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Detail</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>

    <?php if (in_groups('admin')): ?>
        <!-- Disposisi -->
        <div class="col-lg-4 mb-4">
            <a href="<?= site_url('disposisi') ?>" class="card border-left-info shadow h-100 py-2 text-decoration-none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Detail</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif ?>

</div>
<?= $this->endSection(); ?>