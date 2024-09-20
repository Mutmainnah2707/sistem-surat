<?= $this->extend('template/index') ?>

<?= $this->section('title'); ?>
Input Surat Masuk
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Input Surat Masuk</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Input Surat Masuk</h6>
    </div>

    <div class="card-body">
        <form action="<?= site_url('surat-masuk/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?= helper('form') ?>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="letter_from">Asal Surat</label>
                    <input type="text" name="letter_from" class="form-control <?= validation_show_error('letter_from') ? 'is-invalid' : '' ?>" id="letter_from" value="<?= old('letter_from') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('letter_from') ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="letter_number">Nomor Surat</label>
                    <input type="text" name="letter_number" class="form-control <?= validation_show_error('letter_number') ? 'is-invalid' : '' ?>" id="letter_number" value="<?= old('letter_number') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('letter_number'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="subject">Perihal</label>
                <input type="text" name="subject" class="form-control  <?= validation_show_error('subject') ? 'is-invalid' : '' ?>" id="subject" value="<?= old('subject') ?>">
                <div class="invalid-feedback">
                    <?= validation_show_error('subject'); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="letter_date">Tanggal Surat</label>
                    <input type="date" name="letter_date" class="form-control <?= validation_show_error('letter_date') ? 'is-invalid' : '' ?>" id="letter_date" value="<?= old('letter_date') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('letter_date'); ?>
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="received_date">Tanggal Terima</label>
                    <input type="date" name="received_date" class="form-control <?= validation_show_error('received_date') ? 'is-invalid' : '' ?>" id="received_date" value="<?= old('received_date') ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('received_date'); ?>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="receiver">Tujuan Surat</label>
                    <select class="form-control selectpicker show-tick border <?= validation_show_error('receiver') ? 'is-invalid' : '' ?>" title="-- Pilih tujuan surat --" data-live-search="true" data-style="btn-white" id="receiver" name="receiver">
                        <?php if (!empty($satkers)): ?>
                            <?php foreach ($satkers as $satker): ?>
                                <option value="<?= $satker['id'] ?>" <?= (old('receiver') == $satker['id']) ? 'selected' : '' ?>><?= $satker['name'] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= validation_show_error('receiver'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="letter_file">File surat</label>
                <small class="text-mute font-italic text-warning">( Ukuran maksimal 2MB tipe pdf, doc atau docx )</small>
                <div class="custom-file mb-3">
                    <input type="file" class="form-control custom-file-input <?= validation_show_error('letter_file') ? 'is-invalid' : '' ?>" id="letter_file" name="letter_file" onchange="letterFileLable()">
                    <label class="custom-file-label" for="letter_file">Pilih file surat...</label>
                    <div class="invalid-feedback">
                        <?= validation_show_error('letter_file'); ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('surat-masuk') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>