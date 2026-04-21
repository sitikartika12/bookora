<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Status Pengiriman Saya</h3>

<table border="1">
<tr>
    <th>Alamat</th>
    <th>Status</th>
    <th>Biaya</th>
</tr>

<?php foreach ($pengiriman as $p): ?>

<tr>
    <td><?= $p['alamat'] ?></td>
    <td><?= $p['status'] ?></td>
    <td>Rp <?= number_format($p['biaya'], 0, ',', '.') ?></td>
</tr>

<?php endforeach; ?>

</table>
<?= $this->endSection() ?>