<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Peminjaman</h3>

<form action="<?= base_url('peminjaman/store') ?>" method="post">

<label>Pilih Buku</label><br>

<div id="buku-wrapper">

    <div>
        <select name="id_buku[]">
            <option value="">-- Pilih Buku --</option>
            <?php foreach ($buku as $b): ?>
                <option value="<?= $b['id_buku'] ?>">
                    <?= $b['judul'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="number" name="jumlah[]" value="1" min="1">
    </div>

</div>

<br>

<button type="button" onclick="tambahBuku()">+ Tambah Buku</button>

            </br>
            
<label>Petugas</label><br>
<select name="id_petugas" required>
    <option value="">-- Pilih Petugas --</option>
    <?php foreach($petugas as $p): ?>
        <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
    <?php endforeach; ?>
</select><br><br>

<label>Tanggal Pinjam</label><br>
<input type="date" name="tanggal_pinjam" required><br><br>

<label>Tanggal Kembali</label><br>
<input type="date" name="tanggal_kembali"><br><br>

<button type="submit">Simpan</button>

</form>

<script>
function tambahBuku() {
    let html = `
    <div>
        <select name="id_buku[]">
            <option value="">-- Pilih Buku --</option>
            <?php foreach ($buku as $b): ?>
                <option value="<?= $b['id_buku'] ?>">
                    <?= $b['judul'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="number" name="jumlah[]" value="1" min="1">
    </div>
    `;

    document.getElementById('buku-wrapper').insertAdjacentHTML('beforeend', html);
}
</script>

<?= $this->endSection() ?>