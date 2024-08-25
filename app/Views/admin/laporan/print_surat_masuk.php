<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h3>Laporan Surat Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Asal Surat</th>
                <th>No Surat</th>
                <th>Perihal</th>
                <th>Tanggal Terima</th>
                <th>Tujuan Surat</th>
                <th>Status</th>
                <th>File Surat</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php if (!empty($surat_masuk) && is_array($surat_masuk)): ?>
                <?php foreach ($surat_masuk as $item): ?>
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= esc($item['asal_surat']) ?></td>
                    <td><?= esc($item['no_surat']) ?></td>
                    <td><?= esc($item['perihal']) ?></td>
                    <td><?= esc($item['tanggal_terima']) ?></td>
                    <td><?= esc($item['tujuan_surat']) ?></td>
                    <td><?= $item['status'] == 0 ? 'Belum Dibaca' : 'Sudah Dibaca' ?></td>
                    <td><?= !empty($item['file_surat']) ? 'Ada' : 'Tidak Ada' ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
