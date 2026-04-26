<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Data Users</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h3 {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <h3>DATA USERS PERPUSTAKAAN</h3>

    <table>

        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td class="text-center"><?= ucfirst($u['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada data user
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

    <br><br>

    <div style="text-align:right;">
        Dicetak pada: <?= date('d-m-Y') ?>
    </div>

</body>

</html>