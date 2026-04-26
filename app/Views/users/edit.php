<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit User</h5>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" value="<?= $user['email'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-select">
                                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                                <option value="petugas" <?= $user['role']=='petugas'?'selected':'' ?>>Petugas</option>
                                <option value="anggota" <?= $user['role']=='anggota'?'selected':'' ?>>Anggota</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">

                            <?php if ($user['foto']): ?>
                                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="100" class="mt-2 rounded">
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-success w-100">
                            <i class="bi bi-save"></i> Update
                        </button>

                        <a href="<?= base_url('users') ?>" class="btn btn-secondary w-100 mt-2">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>