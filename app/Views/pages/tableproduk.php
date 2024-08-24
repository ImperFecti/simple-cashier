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
                <h1 class="mt-4">Data Produk</h1>
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
                                Manajemen Produk Toko
                            </div>
                            <?php if (in_groups("admin")): ?>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                        <i class="fa-solid fa-person-circle-plus fa-fade"></i> Tambah Produk
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
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <?php if (in_groups("admin")): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($produk as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= esc($p['kategori_name']); ?></td>
                                        <td><?= esc($p['nama']); ?></td>
                                        <td><?= esc($p['deskripsi']); ?></td>
                                        <td><?= esc($p['harga']); ?></td>
                                        <td><?= esc($p['stok']); ?></td>
                                        <?php if (in_groups("admin")): ?>
                                            <td>
                                                <form action="<?= base_url('/deleteproduk'); ?>" method="post" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini ?');"><i class="fa-solid fa-person-circle-minus"></i> Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal<?= $p['id'] ?>">
                                                    <i class="fa-solid fa-person-circle-question"></i> Ubah
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                        <td><?= esc($p['updated_at']); ?></td>
                                    </tr>
                                    <!-- Edit Product Modal -->
                                    <?php if (in_groups("admin")): ?>
                                        <div class="modal fade" id="editProductModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?= $p['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?= site_url('/editproduk/' . $p['id']); ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editProductModalLabel<?= $p['id']; ?>">Ubah Data Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama<?= $p['id']; ?>" class="form-label">Nama Produk</label>
                                                                <input type="text" class="form-control" id="nama<?= $p['id']; ?>" name="nama" value="<?= $p['nama']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="id_kategori<?= $p['id']; ?>" class="form-label">Kategori</label>
                                                                <select class="form-select" id="id_kategori<?= $p['id']; ?>" name="id_kategori" required>
                                                                    <?php foreach ($kategori as $k): ?>
                                                                        <option value="<?= $k['id']; ?>" <?= ($p['id_kategori'] == $k['id']) ? 'selected' : ''; ?>>
                                                                            <?= esc($k['nama']); ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="deskripsi<?= $p['id']; ?>" class="form-label">Deskripsi Produk</label>
                                                                <input type="text" class="form-control" id="deskripsi<?= $p['id']; ?>" name="deskripsi" value="<?= $p['deskripsi']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga<?= $p['id']; ?>" class="form-label">Harga Produk</label>
                                                                <input type="number" class="form-control" id="harga<?= $p['id']; ?>" name="harga" value="<?= $p['harga']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="stok<?= $p['id']; ?>" class="form-label">Stok Produk</label>
                                                                <input type="number" class="form-control" id="stok<?= $p['id']; ?>" name="stok" value="<?= $p['stok']; ?>" min="0" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Ubah Data Produk</button>
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

<!-- Add Product Modal -->
<?php if (in_groups("admin")): ?>
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('/tambahproduk') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="id_kategori" name="id_kategori" required>
                                <option value="" disabled selected>Pilih Kategori Produk</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id']; ?>" <?= ($p['id_kategori'] == $k['id']) ? 'selected' : ''; ?>>
                                        <?= esc($k['nama']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deksripsi Produk</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" id="harga" name="harga" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Produk</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambahkan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>
<!-- End of content section -->