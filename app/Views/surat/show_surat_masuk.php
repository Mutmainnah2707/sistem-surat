<?= $this->extend('dashboard/index') ?>

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
            <table class="table table-bordered">
                <tr>
                    <th>ID Surat Masuk</th>
                    <td><?= esc($surat_masuk['id_surat']) ?></td>
                </tr>
                <tr>
                    <th>Asal Surat</th>
                    <td><?= esc($surat_masuk['asal_surat']) ?></td>
                </tr>
                <tr>
                    <th>No Surat</th>
                    <td><?= esc($surat_masuk['no_surat']) ?></td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td><?= esc($surat_masuk['perihal']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Terima</th>
                    <td><?= esc($surat_masuk['tanggal_terima']) ?></td>
                </tr>
                <tr>
                    <th>Tujuan Surat</th>
                    <td><?= esc($surat_masuk['tujuan_surat']) ?></td>
                </tr>
                <tr>
                    <th>File Surat</th>
                    <td>
                        <?php if ($surat_masuk['file_surat']): ?>
                            <a href="<?= site_url('surat/download/' . $surat_masuk['file_surat']) ?>" target="_blank">Download File</a>
                        <?php else: ?>
                            Tidak ada file
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
