<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Tambah Surat Keluar</h3>
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

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('satker/surat_keluar') ?>" method="post" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Surat Keluar</h6>
            </div>
            <div class="card-body">
                <!-- Form Row 1 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="asal_surat">Asal Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat" value="<?= old('asal_surat') ?>" required>
                    </div>
                </div>
                <!-- Form Row 2 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" value="<?= old('perihal') ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_terima">Tanggal Terima</label>
                        <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima" value="<?= old('tanggal_terima') ?>" required>
                    </div>
                </div>
                <!-- Form Row 3 -->
                <div class="form-group">
                    <label for="tujuan_surat">Tujuan Surat</label>
                    <select class="form-control" id="tujuan_surat" name="tujuan_surat" required>
                        <option value="">Pilih Tujuan</option>
                        <option value="Satker" <?= old('tujuan_surat') === 'Satker' ? 'selected' : '' ?>>Satker</option>
                    </select>
                </div>
                <!-- Form Row 4 -->
                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat</label>
                    <input type="text" class="form-control" id="jenis_surat" name="jenis_surat" value="<?= old('jenis_surat') ?>" required>
                </div>
                <!-- Form Row 5 -->
                <div class="form-group">
                    <label for="file_surat">File Surat</label>
                    <input type="file" class="form-control" id="file_surat" name="file_surat" required>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
