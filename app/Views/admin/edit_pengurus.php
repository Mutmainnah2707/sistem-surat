<?= $this->extend('dashboard/index') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <h3>Edit Pengurus Pondok</h3>
</div>

<div class="container-fluid">
    <form method="post" action="<?= site_url('pengurus/update/' . $pengurus['id']) ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= esc($pengurus['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= esc($pengurus['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= esc($pengurus['jabatan']) ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('pengurus') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
