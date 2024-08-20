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
                <h1 class="mt-4">Data Tagihan Transaksi</h1>
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
                                Manajemen Tagihan Transaksi
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Cashier</th>
                                    <th>Nama Cashier</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal</th>
                                    <?php if (in_groups("admin")): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($transaksi as $t) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= esc($t['id_cashier']); ?></td>
                                        <td><?= esc($t['username']); ?></td>
                                        <td><?= esc($t['jumlah']); ?></td>
                                        <td></td>
                                        <td><?= esc($t['pembayaran']); ?></td>
                                        <td><?= esc($t['created_at']); ?></td>
                                        <?php if (in_groups("admin")): ?>
                                            <td>
                                                <form action="<?= base_url('/deleteproduk'); ?>" method="post" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $t['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini ?');"><i class="fa-solid fa-person-circle-minus"></i> Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal<?= $t['id'] ?>">
                                                    <i class="fa-solid fa-person-circle-question"></i> Ubah
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- include the admin footer layout -->
        <?= $this->include('layout/footer'); ?>

    </div>
</div>

<?= $this->endSection(); ?>
<!-- End of content section -->