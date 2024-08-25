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
                <h1 class="mt-4">Data Metode Pembayaran</h1>
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
                                Manajemen Metode Pembayaran Toko
                            </div>
                            <?php if (in_groups("admin")): ?>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPembayaranModal">
                                        <i class="fa-solid fa-person-circle-plus fa-fade"></i> Tambah Metode
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <?php if (in_groups("admin")): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pembayaran as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= esc($p['nama']); ?></td>
                                        <td><?= esc($p['created_at']); ?></td>
                                        <td><?= esc($p['updated_at']); ?></td>
                                        <?php if (in_groups("admin")): ?>
                                            <td>
                                                <form action="<?= base_url('/deletepembayaran'); ?>" method="post" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus metode pembayaran ini ?');"><i class="fa-solid fa-person-circle-minus"></i> Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPembayaranModal<?= $p['id'] ?>">
                                                    <i class="fa-solid fa-person-circle-question"></i> Ubah
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <!-- Edit Kategori Modal -->
                                    <?php if (in_groups("admin")): ?>
                                        <div class="modal fade" id="editPembayaranModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="editPembayaranModalLabel<?= $p['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?= site_url('/editpembayaran/' . $p['id']); ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPembayaranModalLabel<?= $p['id']; ?>">Ubah Data Metode Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama<?= $p['id']; ?>" class="form-label">Nama Metode</label>
                                                                <input type="text" class="form-control" id="nama<?= $p['id']; ?>" name="nama" value="<?= $p['nama']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Ubah Data Metode</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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

<!-- Add Kategori Modal -->
<?php if (in_groups("admin")): ?>
    <div class="modal fade" id="addPembayaranModal" tabindex="-1" aria-labelledby="addPembayaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('/tambahpembayaran') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPembayaranModalLabel">Tambah Metode Pembayaran Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah Metode Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>
<!-- End of content section -->