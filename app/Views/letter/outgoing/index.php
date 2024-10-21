<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Detail Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Surat Keluar</h1>

<a href="<?= site_url('surat-keluar/create') ?>" class="btn btn-primary mb-3">Input Surat Keluar</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Surat Keluar</h6>
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
                        <th>Tujuan Surat</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php if (!empty($outgoingletters)): ?>
                        <?php foreach ($outgoingletters as $letter): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($letter['letter_from']) ?></td>
                                <td><?= esc($letter['letter_number']) ?></td>
                                <td><?= esc($letter['subject']) ?></td>
                                <td><?= esc($letter['letter_date']) ?></td>
                                <td><?= esc($letter['receiver_name']) ?></td>
                                <td><?= esc($letter['status']) ?></td>
                                <td>
                                    <a href="<?= site_url('surat-keluar/show/' . $letter['id']) ?>" class="btn btn-info btn-sm my-1">Show</a>
                                    <?php if ($letter['status'] === 'Draft'): ?>
                                        <a href="<?= site_url('surat-keluar/edit/' . $letter['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <?php endif; ?>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('surat-keluar/delete/' . $letter['id']) ?>')">Delete</a>
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