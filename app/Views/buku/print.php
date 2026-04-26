<!DOCTYPE html>
<html>
<head>
    <title>Print Data Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h3 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            font-size: 11px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .ttd {
            width: 200px;
            float: right;
            text-align: center;
        }

        @media print {
            body {
                margin: 10mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

<h3>DATA BUKU</h3>
<div class="sub">Perpustakaan Bookora</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th class="text-center">Tahun</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Tersedia</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; foreach ($buku as $b): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $b['judul'] ?></td>
            <td><?= $b['nama_kategori'] ?? '-' ?></td>
            <td><?= $b['nama_penulis'] ?? '-' ?></td>
            <td><?= $b['nama_penerbit'] ?? '-' ?></td>
            <td class="text-center"><?= $b['tahun_terbit'] ?></td>
            <td class="text-center"><?= $b['jumlah'] ?></td>
            <td class="text-center"><?= $b['tersedia'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- FOOTER TTD -->
<div class="footer">
    <div class="ttd">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><b>____________________</b></p>
    </div>
</div>

</body>
</html>