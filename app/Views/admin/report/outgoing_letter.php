<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Laporan Surat Keluar
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Laporan Surat Keluar</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-outgoingLetters-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Keluar</h6>
        <a href="<?= site_url('laporan/printSuratKeluar') ?>" class="btn btn-primary btn-icon" target="_blank">
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
                        <th>Tanggal Surat</th>
                        <th>Tujuan Surat</th>
                        <th>Status</th>
                        <th>File Surat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php if (!empty($outgoingLetters)): ?>
                        <?php foreach ($outgoingLetters as $outgoingLetter): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($outgoingLetter['letter_from']) ?></td>
                                <td><?= esc($outgoingLetter['letter_number']) ?></td>
                                <td><?= esc($outgoingLetter['subject']) ?></td>
                                <td class="text-left"><?= esc($outgoingLetter['letter_date']) ?></td>
                                <td><?= esc($outgoingLetter['receiver_name']) ?></td>
                                <td><?= esc($outgoingLetter['status']) ?></td>
                                <td>
                                    <?php if (!empty($outgoingLetter['letter_file'])): ?>
                                        <a href="<?= base_url('download/' . esc($outgoingLetter['letter_file'])) ?>">Download File</a>
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