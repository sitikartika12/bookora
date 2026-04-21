<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Peminjaman</h3>

<form action="<?= base_url('peminjaman/store') ?>" method="post">

<!-- ========================
     PILIH BUKU
======================== -->
<label>Pilih Buku</label><br>
<input type="text" id="search-buku" onkeyup="searchBuku()" placeholder="Cari judul buku...">
<br><br>

<div class="row">

<?php foreach ($buku as $b): ?>

<div class="buku-item" style="width:200px; display:inline-block; margin:10px; border:1px solid #ccc; padding:10px; text-align:center;">

    <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>" width="120" height="160"><br><br>

    <b><?= $b['judul'] ?></b><br><br>

    <?php if ($b['tersedia'] <= 0): ?>
        <p style="color:red;"><b>HABIS</b></p>
    <?php else: ?>
        <p style="color:green;">Tersedia: <?= $b['tersedia'] ?></p>

        <button type="button" onclick="pilihBuku(<?= $b['id_buku'] ?>, '<?= $b['judul'] ?>')">
            Pilih
        </button>
    <?php endif; ?>

</div>

<?php endforeach; ?>

</div>

<hr>

<!-- ========================
     BUKU DIPILIH
======================== -->
<h4>Buku yang dipilih:</h4>
<div id="selected-books"></div>

<br>

<!-- ========================
     METODE PINJAM
======================== -->
<label>Metode Peminjaman</label><br>

<select name="metode" onchange="toggleAlamat(this.value)" required>
    <option value="ambil">Ambil ke Perpustakaan</option>
    <option value="antar">Diantar ke Rumah</option>
</select>

<br><br>

<!-- ========================
     ALAMAT (HANYA ANTAR)
======================== -->
<div id="form-alamat" style="display:none;">
    <label>Alamat Pengiriman</label><br>
    <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
</div>

<br>

<button type="submit">Simpan Peminjaman</button>

</form>

<!-- ========================
     SCRIPT BUKU
======================== -->
<script>
function pilihBuku(id, judul) {
    let container = document.getElementById('selected-books');

    let html = `
        <div style="margin-bottom:10px; border:1px solid #ccc; padding:5px;">
            <b>${judul}</b><br>

            <input type="hidden" name="id_buku[]" value="${id}">

            Jumlah:
            <input type="number" name="jumlah[]" value="1" min="1">

            <button type="button" onclick="this.parentElement.remove()">Hapus</button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}
</script>

<!-- ========================
     SEARCH BUKU
======================== -->
<script>
function searchBuku() {
    let input = document.getElementById("search-buku");
    let filter = input.value.toLowerCase();
    let items = document.getElementsByClassName("buku-item");

    for (let i = 0; i < items.length; i++) {
        let text = items[i].innerText.toLowerCase();
        items[i].style.display = text.includes(filter) ? "" : "none";
    }
}
</script>

<!-- ========================
     TOGGLE ALAMAT
======================== -->
<script>
function toggleAlamat(value) {
    let alamat = document.getElementById('form-alamat');

    if (value === 'antar') {
        alamat.style.display = 'block';
    } else {
        alamat.style.display = 'none';
    }
}
</script>

<?= $this->endSection() ?>