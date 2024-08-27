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
                            <li class="breadcrumb-item active">Selamat datang kembali, <b><?= $user['namalengkap']; ?></b> !!</li>
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
                                        <form id="tambahTagihanForm" action="/simpanTagihan" method="post" onsubmit="return validateForm()">
                                            <?= csrf_field(); ?>
                                            <div id="produkContainer">
                                                <div class="produk-item mb-3">
                                                    <div class="mb-3">
                                                        <label for="produk" class="form-label">Pilih Produk</label>
                                                        <select class="form-select produk" name="produk[]" required>
                                                            <option value="" selected disabled>Pilih Produk</option>
                                                            <?php foreach ($produk as $p) : ?>
                                                                <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                                                                    <?= $p['nama']; ?> - Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
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
                                                        <input type="hidden" class="form-control total" name="total[]" readonly>
                                                        <span class="total-formatted"></span>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-produk">Hapus Produk</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm" id="addProductBtn">Tambah Produk</button>
                                            <div class="mb-3 mt-3">
                                                <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                                                <select class="form-select" id="pembayaran" name="pembayaran" required>
                                                    <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                                    <?php foreach ($pembayaran as $pb) : ?>
                                                        <option value="<?= $pb['id']; ?>"><?= $pb['nama']; ?></option>
                                                    <?php endforeach; ?>
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $bgClass; ?> text-white mb-4">
                            <div class="card-body">Pendapatan</div>
                            <a class="card-footer d-flex align-items-center justify-content-between" style="text-decoration:none;" role="button" data-bs-toggle="modal" data-bs-target="#pendapatanModal">
                                View Details
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="pendapatanModal" tabindex="-1" aria-labelledby="pendapatanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="pendapatanModalLabel">Pendapatan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?= $statusPerbandingan; ?> dan Total Pendapatan Keseluruhan yaitu Rp<?= number_format($totalPendapatan, 0, ',', '.'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Penggunaan Metode Pembayaran</div>
                            <a class="card-footer d-flex align-items-center justify-content-between" style="text-decoration:none;" role="button" data-bs-toggle="modal" data-bs-target="#metodeBayarModal">
                                View Details
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="metodeBayarModal" tabindex="-1" aria-labelledby="metodeBayarModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="metodeBayarModalLabel">Laporan Penggunaan Metode Pembayaran</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <?php foreach ($perbandinganPembayaran as $pembayaran): ?>
                                            <li>
                                                Metode Pembayaran: <?= $pembayaran['namaPembayaran']; ?> -
                                                Bulan Ini: <?= $pembayaran['countBulanIni']; ?>,
                                                Bulan Lalu: <?= $pembayaran['countBulanLalu']; ?>,
                                                Perubahan: <?= $pembayaran['status']; ?> sebesar <?= number_format($pembayaran['persentase'], 2); ?>%
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Produk Paling Banyak Dipesan</div>
                            <a class="card-footer d-flex align-items-center justify-content-between" style="text-decoration:none;" role="button" data-bs-toggle="modal" data-bs-target="#topProductsModal">
                                Lihat Detail
                            </a>
                            </a>
                        </div>
                    </div>
                    <div class="modal fade" id="topProductsModal" tabindex="-1" aria-labelledby="topProductsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="topProductsModalLabel">Produk Paling Banyak Dipesan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <?php if (!empty($topOrderedProducts)): ?>
                                            <?php foreach ($topOrderedProducts as $product): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= esc($product['nama']); ?>
                                                    <span class="badge bg-primary rounded-pill"><?= esc($product['total_pesanan']); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="list-group-item">Tidak ada data produk</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Pendapatan Bulanan
                            </div>
                            <div class="card-body"><canvas id="myPendapatanChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Stok Produk
                            </div>
                            <div class="card-body"><canvas id="myStokChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Metode Pembayaran
                            </div>
                            <div class="card-body"><canvas id="myPembayaranChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
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
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard h-100">
                            <a href="/tablekategori" class="custom-link">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-tags fa-2x"></i>
                                    <h5 class="card-title">List Kategori</h5>
                                    <p class="card-text">Mengatur Data Kategori Yang Terdaftar Di Toko Ini</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard h-100">
                            <a href="/tablepembayaran" class="custom-link">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-credit-card fa-2x"></i>
                                    <h5 class="card-title">List Metode Pembayaran</h5>
                                    <p class="card-text">Mengatur Data Metode Pembayaran Yang Terdaftar Di Toko Ini</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script id="stokProdukData" type="application/json">
            <?= json_encode($produk); ?>
        </script>

        <script id="pendapatanBulananData" type="application/json">
            <?= json_encode($pendapatanBulanan); ?>
        </script>

        <script id="metodePembayaranData" type="application/json">
            <?= json_encode($metodePembayaran); ?>
        </script>

        <!-- include the admin footer layout -->
        <?= $this->include('layout/footer'); ?>

    </div>
</div>

<!-- end content section -->
<?= $this->endSection(); ?>