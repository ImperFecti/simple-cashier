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
                                    <th>ID Cashier</th>
                                    <th>Nama Cashier</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal</th>
                                    <th>Detail Tagihan</th>
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
                                        <td><?= esc($t['cashier_name']); ?></td>
                                        <td><?= esc($t['nama_pembayaran']); ?></td>
                                        <td><?= esc($t['created_at']); ?></td>
                                        <td>
                                            <a href="/buktitagihan/<?= esc($t['id']); ?>" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-person-circle-question fa-fade"></i> Detail
                                            </a>
                                        </td>
                                        <?php if (in_groups("admin")): ?>
                                            <td>
                                                <form action="<?= base_url('/deletetagihan'); ?>" method="post" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $t['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus tagihan ini ?');"><i class="fa-solid fa-person-circle-minus"></i> Delete</button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
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

<?= $this->endSection(); ?>
<!-- End of content section -->