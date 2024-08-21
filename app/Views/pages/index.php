<!-- import layout template -->
<?= $this->extend('layout/template'); ?>

<!-- declare content section -->
<?= $this->section('content'); ?>
<div id="layoutSidenav">

    <!-- include the sidenav admin layout -->
    <?= $this->include('layout/sidenav'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="mt-3">
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
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h1>Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat datang kembali, <b><?= $user['username']; ?></b> !!</li>
                        </ol>
                    </div>
                    <?php if (in_groups("cashier")) : ?>
                        <div>
                            <a href="#" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahTagihanModal">
                                <i class="fa-solid fa-cart-plus fa-bounce"></i> Bayar Tagihan
                            </a>
                        </div>
                        <!-- Tambah Tagihan Modal -->
                        <div class="modal fade" id="tambahTagihanModal" tabindex="-1" aria-labelledby="tambahTagihanModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahTagihanModalLabel">Tambah Tagihan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="tambahTagihanForm" action="/simpanTagihan" method="post">
                                            <?= csrf_field(); ?>
                                            <div id="produkContainer">
                                                <div class="produk-item mb-3">
                                                    <div class="mb-3">
                                                        <label for="produk" class="form-label">Pilih Produk</label>
                                                        <select class="form-select produk" name="produk[]" required>
                                                            <option value="" selected disabled>Pilih Produk</option>
                                                            <?php foreach ($produk as $p) : ?>
                                                                <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                                                                    <?= $p['nama']; ?> - Rp<?= $p['harga']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah" class="form-label">Jumlah</label>
                                                        <input type="number" class="form-control jumlah" name="jumlah[]" value="1" min="1" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total" class="form-label">Total Harga</label>
                                                        <input type="text" class="form-control total" name="total[]" readonly>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-produk">Hapus Produk</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm" id="addProductBtn">Tambah Produk</button>
                                            <div class="mb-3 mt-3">
                                                <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                                                <select class="form-select" id="pembayaran" name="pembayaran" required>
                                                    <option value="" selected disabled>Pilih Metode Pembayaran</option> <!-- Opsi awal kosong -->
                                                    <option value="tunai">Tunai</option>
                                                    <option value="qris">Qris</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" form="tambahTagihanForm">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard h-100">
                            <a href="/tabletagihan" class="custom-link">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-money-bills fa-2x"></i>
                                    <h5 class="card-title">Laporan Tagihan Transaksi</h5>
                                    <p class="card-text">Mengatur Data Laporan Tagihan Transaksi Pelanggan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php if (in_groups("admin")): ?>
                        <div class="col-md-3 mb-4">
                            <div class="card dashboard h-100">
                                <a href="/tablecashier" class="custom-link">
                                    <div class="card-body text-center">
                                        <i class="fa-solid fa-person-half-dress fa-2x"></i>
                                        <h5 class="card-title">Akun Kasir</h5>
                                        <p class="card-text">Mengatur Akun Kasir Yang Terdaftar</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard h-100">
                            <a href="/tableproduk" class="custom-link">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-utensils fa-2x"></i>
                                    <h5 class="card-title">List Produk</h5>
                                    <p class="card-text">Mengatur Data Produk Yang Terdaftar Di Toko Ini</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- include the admin footer layout -->
        <?= $this->include('layout/footer'); ?>

    </div>
</div>

<!-- end content section -->
<?= $this->endSection(); ?>