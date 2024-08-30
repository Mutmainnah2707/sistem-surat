<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="page-heading">
        <h3>Detail Surat Masuk</h3>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if ($surat_masuk['file_surat'] && $fileExtension === 'pdf') : ?>
                <iframe src="<?= base_url('pdf/' . $surat_masuk['file_surat']); ?>" width="100%" height="750px"></iframe>
            <?php else: ?>
                <p>File surat bukan format PDF, silahkan download untuk melihat isinya:</p>
                <a href="<?= base_url('download/' . $surat_masuk['file_surat']); ?>" download class="btn btn-primary">Download Surat</a>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>