<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Detail Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Detail Surat Masuk</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php if ($letter['letter_file'] && $fileExtension === 'pdf') : ?>
            <iframe src="<?= base_url('file-surat/view-pdf/' . $letter['letter_file']); ?>" width="100%" height="731px"></iframe>
        <?php else: ?>
            <p>File surat bukan format PDF, silahkan download untuk melihat isinya:</p>
            <a href="<?= base_url('download/' . $surat_masuk['file_surat']); ?>" download class="btn btn-primary">Download Surat</a>
        <?php endif ?>

        <div class="row mt-2">
            <div class="col-lg-6 mb-0">
                <table class="table table-bordered">
                    <tr>
                        <td>Diteruskan kepada</td>
                        <td>: <?= $disposition['sender'] ?></td>
                    </tr>
                    <tr>
                        <td>Disposisi</td>
                        <td>: <?= $disposition['recipient'] ?></td>
                    </tr>
                    <tr>
                        <td>Instruksi</td>
                        <td>: <?= $disposition['instruction'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 mb-0">
                <table class="table table-bordered">
                    <tr>
                        <td>Diteruskan kepada</td>
                        <td>: <?= $disposition['sender'] ?></td>
                    </tr>
                    <tr>
                        <td>Disposisi</td>
                        <td>: <?= $disposition['recipient'] ?></td>
                    </tr>
                    <tr>
                        <td>Instruksi</td>
                        <td>: <?= $disposition['instruction'] ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <?php if (in_groups('admin') && $disposition['status'] === 'Pending'): ?>
                    <a href="<?= site_url('disposisi/forward/' . $disposition['id']) ?>" class="btn btn-success">Teruskan Disposisi</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>