<!-- Import layout template -->
<?= $this->extend('layout/template'); ?>

<!-- Declare content section -->
<?= $this->section('content'); ?>
<div id="layoutSidenav">

    <!-- include the sidenav admin layout -->
    <?= $this->include('layout/sidenav'); ?>

    <div id="layoutSidenav_content">
        <!-- Profile page section -->
        <section class="vh-100" style="background-color: #f4f5f7;">
            <div class="container py-5 h-100">
                <!-- Alert -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('warning')) : ?>
                    <div class="alert alert-warning" role="alert">
                        <?= session()->getFlashdata('warning') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <!-- End Alert -->

                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="container col-lg-6">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <h3>Profile <?= esc($user['group_name']) ?></h3>
                                <p class="text-muted">Personal account details.</p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Edit Profile
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4 border-top pt-4">
                            <div class="col">
                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Nama Lengkap</div>
                                    <div class="col-sm-9"><?= esc($user['namalengkap']) ?></div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Username</div>
                                    <div class="col-sm-9"><?= esc($user['username']) ?></div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Alamat Email</div>
                                    <div class="col-sm-9"><?= esc($user['email']) ?></div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Alamat Rumah</div>
                                    <div class="col-sm-9"><?= esc($user['alamat']) ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Nomor Handphone</div>
                                    <div class="col-sm-9"><?= esc($user['nomorhp']) ?></div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">Terdaftar Sejak</div>
                                    <div class="col-sm-9"><?= esc($user['created_at']) ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="/" type="button" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>

                    <!-- <!-- Edit Profile Modal -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/updateprofile/<?= $user['id'] ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="namalengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?= $user['namalengkap'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Rumah</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomorhp" class="form-label">Nomor Handphone</label>
                                            <input type="numeric" class="form-control" id="nomorhp" name="nomorhp" value="<?= $user['nomorhp'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Profile Modal -->
                </div>
            </div>
        </section>
    </div>
</div>
<!-- End content section -->
<?= $this->endSection(); ?>