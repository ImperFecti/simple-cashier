<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title><?= $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('css/styles.css'); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0;">
    <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
            <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #<?= esc($transaksi['id']); ?></strong></p>
            </div>
            <hr>
        </div>

        <div class="container">
            <div class="col-md-12">
                <div class="text-center">
                    <img src="https://creazilla-store.fra1.digitaloceanspaces.com/cliparts/3414657/cashier-clipart-md.png" alt="Cashier Logo" draggable="false" height="70" />
                    <p class="pt-0">APLIKASI SIMPLE CASHIER</p>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <ul class="list-unstyled">
                        <li class="text-muted">Cashier: <span style="color:#5d9fc5 ;"><?= esc($transaksi['cashier_name']); ?></span></li>
                    </ul>
                </div>
                <div class="col-xl-4">
                    <p class="text-muted">Invoice</p>
                    <ul class="list-unstyled">
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#<?= esc($transaksi['id']); ?></li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: <?= esc($transaksi['created_at']); ?></li>
                    </ul>
                </div>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailTransaksi as $detail) : ?>
                            <tr>
                                <td><?= esc($detail['nama_produk']); ?></td>
                                <td><?= esc($detail['nama_kategori']); ?></td>
                                <td>Rp. <?= esc($detail['harga']); ?></td>
                                <td><?= esc($detail['jumlah']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <p class="ms-3">Metode Pembayaran : <b><?= esc($transaksi['nama_pembayaran']); ?></b></p>
                </div>
                <div class="col-xl-3">
                    <ul class="list-unstyled">
                        <li class="text-muted ms-3">
                            <span class="text-black me-4">SubTotal</span>
                            Rp. <?= number_format($subtotal, 2, ',', '.'); ?>
                        </li>
                        <li class="text-muted ms-3 mt-2">
                            <span class="text-black me-4">Pajak (5%)</span>
                            Rp. <?= number_format($pajak, 2, ',', '.'); ?>
                        </li>
                    </ul>
                    <p class="text-black float-start">
                        <span class="text-black me-3">Total Amount</span>
                        <span style="font-size: 25px;">Rp. <?= number_format($totalAmount, 2, ',', '.'); ?></span>
                    </p>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-xl-10">
                    <p>Terima Kasih Telah Melakukan Pembayaran</p>
                </div>
                <div class="col-xl-2">
                    <a href="/tabletagihan" type="button" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>