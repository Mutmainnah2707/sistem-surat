<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Edit Admin</h3>
</div>

<div class="container-fluid">
    <form method="post" action="<?= site_url('admin/update-admin/' . $admin['id']) ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">

        <div class="form-group">
            <label for="nama">Nama Admin:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= esc($admin['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= esc($admin['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="level">Level:</label>
            <input type="text" id="level" name="level" class="form-control" value="<?= esc($admin['level']) ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('admin/list-admin') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>