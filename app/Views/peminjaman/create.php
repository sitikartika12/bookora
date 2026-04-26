<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.card-box {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.book-card {
    border-radius: 15px;
    padding: 15px;
    background: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    text-align: center;
    transition: 0.2s;
}

.book-card:hover {
    transform: translateY(-5px);
}

.book-img {
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
}

.btn-custom {
    border-radius: 20px;
    padding: 6px 15px;
}

.selected-item {
    border-radius: 10px;
    background: #f8f9fa;
    padding: 10px;
    margin-bottom: 10px;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Peminjaman</h4>
        <small class="text-muted">Pilih buku yang ingin dipinjam</small>
    </div>

    <form action="<?= base_url('peminjaman/store') ?>" method="post">

        <!-- SEARCH -->
        <div class="card-box mb-3">
            <input type="text" id="search-buku"
                   class="form-control"
                   onkeyup="searchBuku()"
                   placeholder="🔍 Cari judul buku...">
        </div>

        <!-- LIST BUKU -->
        <div class="row g-3 mb-4">

        <?php foreach ($buku as $b): ?>
            <div class="col-md-3 buku-item">

                <div class="book-card">

                    <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                         class="book-img w-100 mb-2">

                    <div class="fw-semibold"><?= $b['judul'] ?></div>

                    <?php if ($b['tersedia'] <= 0): ?>
                        <span class="badge bg-danger mt-2">Habis</span>
                    <?php else: ?>
                        <div class="text-success small mt-1">
                            Stok: <?= $b['tersedia'] ?>
                        </div>

                        <button type="button"
                                class="btn btn-dark btn-sm mt-2"
                                onclick="pilihBuku(<?= $b['id_buku'] ?>, '<?= $b['judul'] ?>')">
                            <i class="bi bi-plus"></i> Pilih
                        </button>
                    <?php endif; ?>

                </div>

            </div>
        <?php endforeach; ?>

        </div>

        <!-- SELECTED -->
        <div class="card-box mb-3">
            <h6 class="fw-bold">Buku Dipilih</h6>
            <div id="selected-books"></div>
        </div>

        <!-- METODE -->
        <div class="card-box mb-3">
            <label class="form-label">Metode Peminjaman</label>
            <select name="metode" class="form-select"
                    onchange="toggleAlamat(this.value)">
                <option value="ambil">Ambil ke Perpustakaan</option>
                <option value="antar">Diantar ke Rumah</option>
            </select>

            <div id="form-alamat" class="mt-3" style="display:none;">
                <textarea name="alamat" class="form-control"
                          placeholder="Masukkan alamat lengkap"></textarea>
            </div>
        </div>

        <!-- BUTTON -->
        <button class="btn btn-dark btn-custom">
            <i class="bi bi-save"></i> Simpan Peminjaman
        </button>

    </form>

</div>

<!-- SCRIPT PILIH -->
<script>
function pilihBuku(id, judul) {

    let container = document.getElementById('selected-books');

    let html = `
        <div class="selected-item d-flex justify-content-between align-items-center">

            <div>
                <b>${judul}</b><br>
                <input type="hidden" name="id_buku[]" value="${id}">
                <input type="number" name="jumlah[]" value="1" min="1"
                       class="form-control mt-1" style="width:80px;">
            </div>

            <button type="button"
                    class="btn btn-sm btn-danger"
                    onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>

        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}
</script>

<!-- SEARCH -->
<script>
function searchBuku() {
    let input = document.getElementById("search-buku").value.toLowerCase();
    let items = document.getElementsByClassName("buku-item");

    for (let i = 0; i < items.length; i++) {
        let text = items[i].innerText.toLowerCase();
        items[i].style.display = text.includes(input) ? "" : "none";
    }
}
</script>

<!-- TOGGLE -->
<script>
function toggleAlamat(value) {
    document.getElementById('form-alamat').style.display =
        (value === 'antar') ? 'block' : 'none';
}
</script>

<?= $this->endSection() ?>