<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Core Section Start -->
                <!-- Link to dashboard -->
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                    Dashboard
                </a>

                <?php if (in_groups("admin")) : ?>
                    <div class="sb-sidenav-menu-heading">User Management</div>

                    <!-- Link to Data Kasir page -->
                    <a class="nav-link" href="/tablecashier">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person"></i></div>
                        Akun Kasir
                    </a>
                <?php endif; ?>

                <div class="sb-sidenav-menu-heading">Data Management</div>

                <!-- Link to Data Transaksi page -->
                <a class="nav-link" href="/tabletagihan">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>
                    Laporan Transaksi
                </a>

                <!-- Link to Data Product page -->
                <a class="nav-link" href="/tableproduk">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                    Data Produk
                </a>

                <!-- Link to Data Kategori page -->
                <a class="nav-link" href="/tablekategori">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Data Kategori
                </a>

                <!-- Link to Data Pembayaran Method page -->
                <a class="nav-link" href="/tablepembayaran">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>
                    Metode Pembayaran
                </a>
                <!-- Core section end -->
            </div>
        </div>
    </nav>
</div>