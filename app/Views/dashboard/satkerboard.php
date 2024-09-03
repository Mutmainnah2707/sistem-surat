<?= $this->extend('dashboard/satker') ?>

<?= $this->section('content') ?>

<div class="row">
    <!-- Surat Masuk -->
    <div class="col-xl-6 col-md-6 mb-4 d-flex justify-content-center">
        <a href="/satker/surat_masuk" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Surat Masuk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Detail</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Surat Keluar -->
    <div class="col-xl-6 col-md-6 mb-4 d-flex justify-content-center">
        <a href="/satker/surat_keluar" class="card border-left-success shadow h-100 py-2 text-decoration-none">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Surat Keluar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Detail</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>
