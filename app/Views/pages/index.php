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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Selamat datang kembali, <b><?= $user['username']; ?></b> !!</li>
                </ol>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard h-100">
                            <a href="/tablelaporan" class="custom-link">
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