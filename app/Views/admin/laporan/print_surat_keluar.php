<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        h4 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h4>Laporan Surat Keluar</h4>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Asal Surat</th>
                <th>No Surat</th>
                <th>Perihal</th>
                <th>Tanggal Terima</th>
                <th>Tujuan Surat</th>
                <th>Jenis Surat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php if (!empty($surat_keluar) && is_array($surat_keluar)): ?>
                <?php foreach ($surat_keluar as $item): ?>
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= esc($item['asal_surat']) ?></td>
                    <td><?= esc($item['no_surat']) ?></td>
                    <td><?= esc($item['perihal']) ?></td>
                    <td><?= esc($item['tanggal_terima']) ?></td>
                    <td><?= esc($item['tujuan_surat']) ?></td>
                    <td><?= esc($item['jenis_surat']) ?></td>
                    <td><?= $item['is_draft'] ? 'Draft' : 'Terkirim' ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data surat keluar</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
