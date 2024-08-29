<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Laporan Surat Masuk</h3>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Surat Masuk</h6>
            <a href="<?= base_url('laporan/printSuratMasuk') ?>" class="btn btn-primary btn-icon" target="_blank">
                <i class="fas fa-print"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal Surat</th>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Terima</th>
                            <th>Tujuan Surat</th>
                            <th>Status</th>
                            <th>File Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        <?php if (!empty($surat_masuk) && is_array($surat_masuk)): ?>
                            <?php foreach ($surat_masuk as $item): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($item['asal_surat']) ?></td>
                                <td><?= esc($item['no_surat']) ?></td>
                                <td><?= esc($item['perihal']) ?></td>
                                <td><?= esc($item['tanggal_terima']) ?></td>
                                <td><?= esc($item['tujuan_surat']) ?></td>
                                <td>
                                    <?= $item['status'] ? 'Sudah Dibaca' : 'Belum Dibaca' ?>
                                </td>
                                <td>
                                    <?php if (!empty($item['file_surat'])): ?>
                                        <a href="<?= base_url('download/' . esc($item['file_surat'])) ?>">Download File</a>
                                    <?php else: ?>
                                        Tidak Ada File
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No data found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '<?= session()->getFlashdata('success') ?>',
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection() ?>
