<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-people"></i> Data Users</h5>
        </div>

        <div class="card-body">

            <!-- FLASH -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- FILTER -->
            <form method="get" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari nama..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                        <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>

                <div class="col-md-5">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        Reset
                    </a>

                    <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>"
                       target="_blank"
                       class="btn btn-dark">
                        <i class="bi bi-printer"></i> Print
                    </a>
                </div>

            </form>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Foto</th>

                            <?php if (session()->get('role') == 'admin') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($users)): ?>
                            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $u['nama'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td><?= $u['username'] ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= ucfirst($u['role']) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php if ($u['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>"
                                                 width="50"
                                                 class="rounded-circle">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>

                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <td>

                                            <a href="<?= base_url('users/detail/' . $u['id']) ?>"
                                               class="btn btn-sm btn-info">
                                                Detail
                                            </a>

                                            <a href="<?= base_url('users/edit/' . $u['id']) ?>"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <a href="<?= base_url('users/wa/' . $u['id']) ?>"
                                               class="btn btn-sm btn-success"
                                               target="_blank">
                                                WA
                                            </a>

                                            <a href="<?= base_url('users/delete/' . $u['id']) ?>"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Hapus user ini?')">
                                                Hapus
                                            </a>

                                        </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data user
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                <?= $pager->links() ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>