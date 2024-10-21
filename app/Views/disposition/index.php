<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Disposisi
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Disposisi</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Disposisi</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Disposisi</th>
                        <th>Disposisi Ke</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php if (!empty($dispositions)): ?>
                        <?php foreach ($dispositions as $disposition): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc(date('d-m-Y', strtotime($disposition['created_at']))) ?></td>
                                <td><?= esc($disposition['recipient']) ?></td>
                                <td><?= esc($disposition['instruction']) ?></td>
                                <td><?= esc($disposition['status']) ?></td>
                                <td>
                                    <a href="<?= site_url('disposisi/show/' . $disposition['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('disposisi/delete/' . $disposition['id']) ?>')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>