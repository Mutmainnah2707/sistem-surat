<?php if (session()->get('level') === 'satker'): ?>
    <?= $this->extend('dashboard/satkersetting') ?>
<?php elseif (session()->get('level') === 'pengurus'): ?>
    <?= $this->extend('dashboard/pengurussetting') ?>
<?php else: ?>
    <?= $this->extend('dashboard/index') ?>
<?php endif; ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Pengaturan Akun</h3>
</div>


<div class="container-fluid">
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

    <form method="post" action="<?= site_url('settings/update-password') ?>">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="current_password">Password Saat Ini:</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="new_password">Password Baru:</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password Baru:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
