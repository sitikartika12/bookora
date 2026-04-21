<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penarikan</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no=1; foreach ($penarikan as $p): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['alamat'] ?></td>
        <td><?= $p['status'] ?></td>
        <td>
            <a href="<?= base_url('penarikan/ambil/'.$p['id_penarikan']) ?>">
                Ambil
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>