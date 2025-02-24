<!-- import layout template -->
<?= $this->extend('layout/template'); ?>

<!-- declare content section -->
<?= $this->section('content'); ?>
<div id="layoutSidenav">

    <!-- include the sidenav admin layout -->
    <?= $this->include('layout/sidenav'); ?>

    <div id="layoutSidenav_content">
        <main class="container-fluid px-4">
            <h1 class="mt-4"><i class="fa-regular fa-calendar-days"></i> Absensi</h1>
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

            <div class="container-fluid py-4">
                <button type="button" class="btn btn-info">
                    <div class="d-flex align-items-center">
                        <div><i class="fa-regular fa-clock fa-2x me-2"></i></div>
                        <div>
                            <h5 class="mb-0">07:00</h5>
                            <p class="mb-0">Jam Masuk</p>
                        </div>
                    </div>
                </button>
                <button type="button" class="btn btn-warning">
                    <div class="d-flex align-items-center">
                        <div><i class="fa-solid fa-clock fa-2x me-2"></i></div>
                        <div>
                            <h5 class="mb-0">15:00</h5>
                            <p class="mb-0">Jam Keluar</p>
                        </div>
                    </div>
                </button>
                <button type="button" class="btn btn-success">
                    <div class="d-flex align-items-center">
                        <div><i class="fa-solid fa-check fa-2x me-2"></i></div>
                        <h5 class="mb-0">HADIR</h5>
                    </div>
                </button>
                <button type="button" class="btn btn-danger">
                    <div class="d-flex align-items-center">
                        <div><i class="fa-solid fa-xmark fa-2x me-2"></i></div>
                        <h5 class="mb-0">KELUAR</h5>
                    </div>
                </button>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Absensi Kasir
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kasir</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($absensi as $a) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $a['namalengkap']; ?></td>
                                    <td><?= $a['tanggal']; ?></td>
                                    <td><?= $a['waktu_masuk']; ?></td>
                                    <td><?= $a['waktu_keluar']; ?></td>
                                    <td><?= $a['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </main>

        <!-- include the footer admin layout -->
        <?= $this->include('layout/footer'); ?>

    </div>
</div>

<?= $this->endSection(); ?>
<!-- End of content section -->