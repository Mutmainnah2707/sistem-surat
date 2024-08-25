<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Management</title>
    <link href="<?= base_url('assetAdmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Surat Management</h1>

        <a href="<?= site_url('surat/create_surat_masuk') ?>" class="btn btn-primary">Tambah Surat Masuk</a>
        <a href="<?= site_url('surat/create_surat_keluar') ?>" class="btn btn-secondary">Tambah Surat Keluar</a>

        <h2 class="my-4">Surat Masuk</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Surat</th>
                    <th>Asal Surat</th>
                    <th>No Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal Terima</th>
                    <th>Tujuan Surat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($surat_masuk as $surat): ?>
                <tr>
                    <td><?= $surat['id_surat'] ?></td>
                    <td><?= $surat['asal_surat'] ?></td>
                    <td><?= $surat['no_surat'] ?></td>
                    <td><?= $surat['perihal'] ?></td>
                    <td><?= $surat['tanggal_terima'] ?></td>
                    <td><?= $surat['tujuan_surat'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="my-4">Surat Keluar</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Surat</th>
                    <th>Asal Surat</th>
                    <th>No Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal Terima</th>
                    <th>Tujuan Surat</th>
                    <th>ID Surat Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($surat_keluar as $surat): ?>
                <tr>
                    <td><?= $surat['id_surat'] ?></td>
                    <td><?= $surat['asal_surat'] ?></td>
                    <td><?= $surat['no_surat'] ?></td>
                    <td><?= $surat['perihal'] ?></td>
                    <td><?= $surat['tanggal_terima'] ?></td>
                    <td><?= $surat['tujuan_surat'] ?></td>
                    <td><?= $surat['id_surat_masuk'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
