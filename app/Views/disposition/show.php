<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Detail Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Detail Surat Masuk</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php if ($disposition['letter_file'] && $fileExtension === 'pdf') : ?>
            <iframe src="<?= base_url('file-surat/view-pdf/' . $disposition['letter_file']); ?>" width="100%" height="731px"></iframe>
        <?php else: ?>
            <p>File surat bukan format PDF, silahkan download untuk melihat isinya:</p>
            <a href="<?= base_url('download/' . $surat_masuk['file_surat']); ?>" download class="btn btn-primary">Download Surat</a>
        <?php endif ?>

        <div class="row">
            <div class="col-lg-6 mb-0">
                <p class="mb-0">Pengirim Disposisi: <?= $disposition['sender'] ?></p>
                <p class="mb-0">Penerima Disposisi: <?= $disposition['recipient'] ?></p>
                <p class="mb-0">Instruksi: <?= $disposition['instruction'] ?></p>
                <?php if (in_groups('admin') && $disposition['status'] === 'Pending'): ?>
                    <a href="<?= site_url('disposisi/forward/' . $disposition['id']) ?>" class="btn btn-success">Teruskan</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>