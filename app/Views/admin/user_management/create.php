<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Tambah <?= $level ?>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <p class="text-capitalize m-0">Tambah <?= $level ?></p>
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <p class="text-capitalize m-0">Form Tambah <?= $level ?></p>
        </h6>
    </div>

    <div class="card-body">
        <form action="<?= site_url('manajemen-pengguna/store/' . $level) ?>" method="post">
            <?= csrf_field() ?>

            <?= helper('form') ?>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('name') ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('email') ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : '' ?>" id="password" name="password" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= validation_show_error('password') ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="pass_confirm">Ulangi password</label>
                    <input type="password" class="form-control <?= validation_show_error('pass_confirm') ? 'is-invalid' : '' ?>" id="pass_confirm" name="pass_confirm" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= validation_show_error('pass_confirm') ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('manajemen-pengguna/' . $level) ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>