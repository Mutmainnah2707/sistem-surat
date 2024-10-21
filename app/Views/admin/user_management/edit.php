<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Edit <?= $level ?>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <p class="text-capitalize m-0">Edit <?= $level ?></p>
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <p class="text-capitalize m-0">Form Edit <?= $level ?></p>
        </h6>
    </div>

    <div class="card-body">
        <form method="post" action="<?= site_url('manajemen-pengguna/update/' . $user['id']) ?>">
            <?= csrf_field() ?>

            <?= helper('form') ?>

            <input type="hidden" name="_method" value="PUT">

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>" value="<?= old('name') ? old('name') : $user['name'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('name'); ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ? old('email') : $user['email'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('email'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="level">Level</label>
                <select class="form-control <?= validation_show_error('level') ? 'is-invalid' : '' ?> selectpicker show-tick border" title="-- Pilih tujuan surat --" data-live-search="true" data-style="btn-white" id="level" name="level">
                    <?php if (!empty($groups)): ?>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['id'] ?>" <?= ((old('level') == $group['id']) || $user['id_level'] == $group['id']) ? 'selected' : '' ?>><?= $group['name'] ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('level'); ?>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('manajemen-pengguna/' . $level) ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>