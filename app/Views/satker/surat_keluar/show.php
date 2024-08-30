<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Detail Surat Keluar</h3>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Surat Keluar</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID Surat Keluar</th>
                    <td><?= esc($surat_keluar['id_surat']) ?></td>
                </tr>
                <tr>
                    <th>Asal Surat</th>
                    <td><?= esc($surat_keluar['asal_surat']) ?></td>
                </tr>
                <tr>
                    <th>No Surat</th>
                    <td><?= esc($surat_keluar['no_surat']) ?></td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td><?= esc($surat_keluar['perihal']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Terima</th>
                    <td><?= esc($surat_keluar['tanggal_terima']) ?></td>
                </tr>
                <tr>
                    <th>Tujuan Surat</th>
                    <td><?= esc($surat_keluar['tujuan_surat']) ?></td>
                </tr>
                <tr>
                    <th>Jenis Surat</th>
                    <td><?= esc($surat_keluar['jenis_surat']) ?></td>
                </tr>
                <tr>
                    <th>File Surat</th>
                    <td>
                        <?php if ($surat_keluar['file_surat']): ?>
                            <a href="<?= site_url('surat/download/' . $surat_keluar['file_surat']) ?>" target="_blank">Download File</a>
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