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

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
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
            <?php if (!empty($incomingLetters)): ?>
                <?php foreach ($incomingLetters as $incomingLetter): ?>
                    <tr>
                        <td><?= ++$i ?></td>
                        <td><?= esc($incomingLetter['letter_from']) ?></td>
                        <td><?= esc($incomingLetter['letter_number']) ?></td>
                        <td><?= esc($incomingLetter['subject']) ?></td>
                        <td><?= esc(date('d-m-Y', strtotime($incomingLetter['received_date']))) ?></td>
                        <td><?= esc($incomingLetter['receiver_name']) ?></td>
                        <td><?= esc($incomingLetter['status']) ? 'Belum Dibaca' : 'Sudah Dibaca' ?></td>
                        <td><?= esc($incomingLetter['letter_file']) ? 'Ada' : 'Tidak Ada' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data surat masuk</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>