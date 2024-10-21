<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Laporan Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Laporan Surat Masuk</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Surat Masuk</h6>
        <a href="<?= site_url('laporan/printSuratMasuk') ?>" class="btn btn-primary btn-icon" target="_blank">
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
                    <?php if (!empty($incomingLetters)): ?>
                        <?php foreach ($incomingLetters as $incomingLetter): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($incomingLetter['letter_from']) ?></td>
                                <td><?= esc($incomingLetter['letter_number']) ?></td>
                                <td><?= esc($incomingLetter['subject']) ?></td>
                                <td><?= esc(date('d-m-Y', strtotime($incomingLetter['received_date']))) ?></td>
                                <td><?= esc($incomingLetter['receiver_name']) ?></td>
                                <td><?= esc($incomingLetter['status']) ? 'Sudah Dibaca' : 'Belum Dibaca' ?></td>
                                <td>
                                    <?php if (!empty($incomingLetter['letter_file'])): ?>
                                        <a href="<?= base_url('download/' . esc($incomingLetter['letter_file'])) ?>">Download File</a>
                                    <?php else: ?>
                                        Tidak Ada File
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>