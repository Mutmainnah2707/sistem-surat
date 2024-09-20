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

        .table,
        .table th,
        .table td {
            border: 1px solid black;
        }

        .table th,
        .table td {
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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php if (!empty($outgoingLetters)): ?>
                <?php foreach ($outgoingLetters as $outgoingLetter): ?>
                    <tr>
                        <td><?= ++$i ?></td>
                        <td><?= esc($outgoingLetter['letter_from']) ?></td>
                        <td><?= esc($outgoingLetter['letter_number']) ?></td>
                        <td><?= esc($outgoingLetter['subject']) ?></td>
                        <td><?= esc($outgoingLetter['received_date']) ?></td>
                        <td><?= esc($outgoingLetter['sender_name']) ?></td>
                        <td><?= esc($outgoingLetter['status']) ?></td>
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