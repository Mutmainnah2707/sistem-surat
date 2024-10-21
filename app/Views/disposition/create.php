<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Tambah Disposisi
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Disposisi</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Disposisi</h6>
    </div>

    <div class="card-body">
        <form action="<?= site_url('disposisi/store/' . $id_surat) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?= helper('form') ?>

            <div class="form-group">
                <label for="recipient_id">Disposisi Ke</label>
                <select class="form-control <?= validation_show_error('recipient_id') ? 'is-invalid' : '' ?> selectpicker show-tick border" title="-- Pilih tujuan disposisi --" data-live-search="true" data-style="btn-white" id="recipient_id" name="recipient_id">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= (old('recipient_id') == $user['id']) ? 'selected' : '' ?>><?= $user['name'] ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
                <div class="invalid-feedback">
                    <?= validation_show_error('recipient_id'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="instruction">Keterangan</label>
                <textarea class="form-control <?= validation_show_error('instruction') ? 'is-invalid' : '' ?>" id="instruction" name="instruction" rows="3"><?= old('instruction') ?></textarea>
                <div class="invalid-feedback">
                    <?= validation_show_error('instruction'); ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>