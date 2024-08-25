<?= $this->extend('dashboard/satker') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Detail Surat Masuk</h3>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Surat Masuk</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>No Surat:</strong>
                    <p><?= esc($surat['no_surat']) ?></p>
                </div>
                <div class="col-md-6">
                    <strong>Asal Surat:</strong>
                    <p><?= esc($surat['asal_surat']) ?></p>
                </div>
                <div class="col-md-6">
                    <strong>Perihal:</strong>
                    <p><?= esc($surat['perihal']) ?></p>
                </div>
                <div class="col-md-6">
                    <strong>Tanggal Terima:</strong>
                    <p><?= esc($surat['tanggal_terima']) ?></p>
                </div>
                <div class="col-md-6">
                    <strong>Tujuan Surat:</strong>
                    <p><?= esc($surat['tujuan_surat']) ?></p>
                </div>
                <div class="col-md-6">
    <strong>File Surat:</strong>
    <?php if (!empty($surat['file_surat'])): ?>
        <a href="<?= site_url('download/' . esc($surat['file_surat'])) ?>" target="_blank">Download</a>
    <?php else: ?>
        <p>Tidak ada file</p>
    <?php endif; ?>
</div>

            </div>
            <a href="<?= site_url('satker/surat_masuk') ?>" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
