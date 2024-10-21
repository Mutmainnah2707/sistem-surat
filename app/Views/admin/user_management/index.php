<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
<?= $level ?>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <p class="text-capitalize m-0"><?= $level ?></p>
</h1>

<a href="<?= site_url('manajemen-pengguna/create/' . $level) ?>" class="btn btn-primary mb-3">
    <p class="text-capitalize m-0">Tambah <?= $level ?></p>
</a>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <p class="text-capitalize m-0">Daftar <?= $level ?></p>
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php if (!empty($users) && is_array($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><?= esc($user['level']) ?></td>
                                <td>
                                    <a href="<?= site_url("manajemen-pengguna/edit/{$level}/{$user['id']}") ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= site_url('manajemen-pengguna/delete/' . $user['id']) ?>')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>