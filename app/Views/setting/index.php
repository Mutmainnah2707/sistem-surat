<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Pengaturan Akun
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pengaturan Akun</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Input Pengaturan Akun</h6>
    </div>

    <div class="card-body">
        <form method="post" action="<?= site_url('settings/update') ?>">
            <?= csrf_field() ?>

            <?= helper('form') ?>

            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" class="form-control <?= validation_show_error('current_password') ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('current_password'); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="new_password">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" class="form-control <?= validation_show_error('new_password') ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('new_password'); ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="pass_confirm">Konfirmasi Password Baru</label>
                    <input type="password" id="pass_confirm" name="pass_confirm" class="form-control <?= validation_show_error('pass_confirm') ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('pass_confirm'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>