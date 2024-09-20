<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Surat Masuk</h1>

<?php if (in_groups('admin')): ?>
    <a href="<?= site_url('surat-masuk/create') ?>" class="btn btn-primary mb-3">Input Surat Masuk</a>
<?php endif ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="display cell-border" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Asal Surat</th>
                        <th>No Surat</th>
                        <th>Perihal</th>
                        <th>Tanggal Surat</th>
                        <th>Tanggal Terima</th>
                        <th>Tujuan Surat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php if (!empty($incomingLetters)): ?>
                        <?php foreach ($incomingLetters as $letter): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= ($letter['letter_from']) ? esc($letter['letter_from']) : esc($letter['sender']) ?></td>
                                <td><?= esc($letter['letter_number']) ?></td>
                                <td><?= esc($letter['subject']) ?></td>
                                <td><?= esc(date('d-m-Y', strtotime($letter['letter_date']))) ?></td>
                                <td><?= esc(date('d-m-Y', strtotime($letter['received_date']))) ?></td>
                                <td><?= esc($letter['receiver']) ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="<?= site_url('surat-masuk/show/' . $letter['letter_id']) ?>" class="btn btn-info btn-sm mr-1">Show</a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('surat-masuk/delete/' . $letter['letter_id']) ?>')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>