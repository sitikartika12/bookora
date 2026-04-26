<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.profile-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    padding: 25px;
}

.avatar {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #dee2e6;
}

.label-title {
    width: 150px;
    font-weight: 600;
    color: #555;
}

.value-text {
    color: #333;
}
</style>

<div class="container">

    <h4 class="fw-bold mb-3">Detail User</h4>

    <div class="profile-card">

        <div class="text-center mb-4">

            <?php if (!empty($user['foto'])): ?>
                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" class="avatar">
            <?php else: ?>
                <img src="<?= base_url('assets/default-user.png') ?>" class="avatar">
            <?php endif; ?>

            <h5 class="mt-2"><?= $user['nama'] ?></h5>
            <span class="badge bg-dark"><?= ucfirst($user['role']) ?></span>

        </div>

        <hr>

        <table class="table table-borderless">

            <tr>
                <td class="label-title">Nama</td>
                <td class="value-text"><?= $user['nama'] ?></td>
            </tr>

            <tr>
                <td class="label-title">Email</td>
                <td class="value-text"><?= $user['email'] ?></td>
            </tr>

            <tr>
                <td class="label-title">Username</td>
                <td class="value-text"><?= $user['username'] ?></td>
            </tr>

            <tr>
                <td class="label-title">Password</td>
                <td class="value-text">••••••••</td>
            </tr>

            <tr>
                <td class="label-title">Role</td>
                <td class="value-text"><?= ucfirst($user['role']) ?></td>
            </tr>

        </table>

        <hr>

        <div class="d-flex gap-2">

            <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary">
                Kembali
            </a>

            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-dark">
                    Edit User
                </a>
            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>