<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3>Edit Disposisi</h3>

    <form action="<?= site_url('disposisi/update/' . $disposisi['id_surat_masuk']) ?>" method="post">
        <div class="form-group">
            <label for="tanggal_disposisi">Tanggal Disposisi</label>
            <input type="date" class="form-control" id="tanggal_disposisi" name="tanggal_disposisi" value="<?= esc($disposisi['tanggal_disposisi']) ?>" required>
        </div>

        <div class="form-group">
            <label for="disposisi_ke">Disposisi Ke</label>
            <input type="text" class="form-control" id="disposisi_ke" name="disposisi_ke" value="<?= esc($disposisi['disposisi_ke']) ?>" required>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?= esc($disposisi['keterangan']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection() ?>