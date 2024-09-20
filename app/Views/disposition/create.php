<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3>Tambah Disposisi</h3>

    <form action="<?= site_url('admin/disposisi/store' . esc($suratMasuk['id_surat'])) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="id_surat_masuk">Pilih Surat Masuk</label>
            <input type="text" class="form-control" id="id_surat_masuk" name="id_surat_masuk" value="<?= esc($suratMasuk['no_surat']) . " - " . esc($suratMasuk['asal_surat']) ?>" readonly required>
        </div>

        <div class="form-group">
            <label for="tanggal_disposisi">Tanggal Disposisi</label>
            <input type="date" class="form-control" id="tanggal_disposisi" name="tanggal_disposisi" value="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="form-group">
            <label for="disposisi_ke">Disposisi Ke</label>
            <select class="form-control" id="disposisi_ke" name="disposisi_ke" required>
                <option value="">-- Pilih Tujuan Disposisi --</option>
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
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="file_surat">Unggah File Surat</label>
            <input type="file" class="form-control-file" id="file_surat" name="file_surat" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?= $this->endSection() ?>