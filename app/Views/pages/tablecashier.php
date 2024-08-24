<!-- import layout template -->
<?= $this->extend('layout/template'); ?>

<!-- Declare content section -->
<?= $this->section('content'); ?>
<div id="layoutSidenav">

    <!-- include the sidenav admin layout -->
    <?= $this->include('layout/sidenav'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data Akun Kasir</h1>
                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Manajemen Akun Kasir Toko
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="fa-solid fa-person-circle-plus fa-fade"></i> Tambah Kasir
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($cashier as $c) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= esc($c['username']); ?></td>
                                        <td><?= esc($c['email']); ?></td>
                                        <td><?= esc($c['group_name']); ?></td>
                                        <td><?= esc($c['created_at']); ?></td>
                                        <td><?= esc($c['updated_at']); ?></td>
                                        <td><?= ($c['active'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                        <td>
                                            <form action="<?= base_url('/deletecashier'); ?>" method="post" style="display:inline;">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $c['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus admin ini ?');"><i class="fa-solid fa-person-circle-minus"></i> Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCashierModal<?= $c['id'] ?>">
                                                <i class="fa-solid fa-person-circle-question"></i> Ubah
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editCashierModal<?= $c['id']; ?>" tabindex="-1" aria-labelledby="editCashierModalLabel<?= $c['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= site_url('/editcashier/' . $c['id']); ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCashierModalLabel<?= $c['id']; ?>">Ubah Data User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="username<?= $c['id']; ?>" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username<?= $c['id']; ?>" name="username" value="<?= $c['username']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="namalengkap<?= $c['id']; ?>" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="namalengkap<?= $c['id']; ?>" name="namalengkap" value="<?= $c['namalengkap']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email<?= $c['id']; ?>" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email<?= $c['id']; ?>" name="email" value="<?= $c['email']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nomorhp<?= $c['id']; ?>" class="form-label">Nomor HP</label>
                                                            <input type="nomorhp" class="form-control" id="nomorhp<?= $c['id']; ?>" name="nomorhp" value="<?= $c['nomorhp']; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat<?= $c['id']; ?>" class="form-label">Alamat</label>
                                                            <input type="alamat" class="form-control" id="alamat<?= $c['id']; ?>" name="alamat" value="<?= $c['alamat']; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="active<?= $c['id']; ?>" class="form-label">Status</label>
                                                            <select class="form-select" id="active<?= $c['id']; ?>" name="active" required>
                                                                <option value="1" <?= ($c['active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                                                <option value="0" <?= ($c['active'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                                                            </select>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Ubah Data Kasir</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mb-3">
                    <a href="/" type="button" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </main>

        <!-- include the admin footer layout -->
        <?= $this->include('layout/footer'); ?>

    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('/tambahcashier') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambahkan Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<!-- End of content section -->