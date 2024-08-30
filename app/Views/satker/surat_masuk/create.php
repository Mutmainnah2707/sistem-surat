<?= $this->extend('dashboard/satker') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Tambah Surat Masuk</h3>
</div>

<div class="container-fluid">
    <form action="<?= site_url('satker/surat_masuk/store') ?>" method="post">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Surat Masuk</h6>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="asal_surat">Asal Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat" value="<?= old('asal_surat') ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_surat">No Surat</label>
                        <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?= old('no_surat') ?>" required>
                    </div>
                </div>
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
                <div class="form-group">
                    <label for="tujuan_surat">Tujuan Surat</label>
                    <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat" value="Satker" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>