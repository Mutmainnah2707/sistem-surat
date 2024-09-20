<?= $this->extend('dashboard/index') ?>

<?= $this->section('title'); ?>
Detail Surat Keluar
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Detail Surat Keluar</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php if ($surat_keluar['file_surat'] && $fileExtension === 'pdf') : ?>
            <iframe src="<?= base_url('pdf/' . $surat_keluar['file_surat']); ?>" width="100%" height="731px"></iframe>
        <?php else: ?>
            <p>File surat bukan format PDF, silahkan download untuk melihat isinya:</p>
            <a href="<?= base_url('download/' . $surat_keluar['file_surat']); ?>" download class="btn btn-primary">Download Surat</a>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>