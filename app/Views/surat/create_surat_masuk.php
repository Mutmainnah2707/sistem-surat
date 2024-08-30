<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Tambah Surat Masuk</h3>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Surat Masuk</h6>
        </div>
        <div class="card-body">
            <form action="<?= site_url('surat/store_surat_masuk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="asal_surat">Asal Surat</label>
                    <input type="text" name="asal_surat" class="form-control" id="asal_surat" value="<?= old('asal_surat') ?>" required>
                </div>

                <div class="form-group">
                    <label for="no_surat">Nomor Surat</label>
                    <input type="text" name="no_surat" class="form-control" id="no_surat" value="<?= old('no_surat') ?>" required>
                </div>

                <div class="form-group">
                    <label for="perihal">Perihal</label>
                    <input type="text" name="perihal" class="form-control" id="perihal" value="<?= old('perihal') ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control" id="tanggal_surat" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_terima">Tanggal Terima</label>
                    <input type="date" name="tanggal_terima" class="form-control" id="tanggal_terima" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label for="tujuan_surat">Tujuan Surat</label>
                    <select class="form-control" id="tujuan_surat" name="tujuan_surat" required>
                    <option value="">-- Pilih Tujuan Surat --</option>
                    <option value="Rektor">Rektor</option>
                    <option value="Rektor">WR1</option>
                    <option value="Rektor">WR2</option>
                    <option value="Rektor">WR3</option>
                    <option value="Rektor">WR4</option>
                    <option value="Satker">Satker LPPM</option>
                    <option value="Satker">Satker Fakultas Teknik</option>
                    <option value="Satker">Satker Fakultas MIPA</option>
                    <option value="Satker">Satker Fakultas Syari'ah dan ES</option>
                    <option value="Satker">Satker Fakultas Tarbiyah</option>
                    <option value="Satker">Satker Fakultas Ushuluddin</option>
                    <option value="Pimpinan Pondok">Satker Fakultas IKBIS</option>
                    <option value="Semua">Semua</option>
                </select>
                </div>

                <div class="form-group">
                    <label for="file_surat">File Surat</label>
                    <input type="file" name="file_surat" class="form-control-file" id="file_surat">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('surat/surat_masuk') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
