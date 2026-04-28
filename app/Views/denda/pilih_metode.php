<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h4>Pilih Metode Pembayaran Denda</h4>

    <div class="card p-3 mt-3">

        <a href="<?= base_url('transaksi/denda/bayar/'.$id_transaksi.'?metode=langsung') ?>"
           class="btn btn-success mb-2">
            💵 Bayar Langsung
        </a>

        <a href="<?= base_url('transaksi/denda/bayar/'.$id_transaksi.'?metode=transfer') ?>"
           class="btn btn-primary mb-2">
            🏦 Transfer / Antar
        </a>

    </div>

</div>

<?= $this->endSection() ?>