<!-- Import layout template -->
<?= $this->extend('layout/template'); ?>

<!-- Declare content section -->
<?= $this->section('content'); ?>

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
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <!-- User profile card -->
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <!-- Profile picture and basic info -->
                        <div class="col-md-4 gradient-custom text-center text-white d-flex flex-column justify-content-center align-items-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <h3 class="mt-5"><?= $user['namalengkap'] ?></h3>
                            <p><?= $user['username'] ?></p>
                            <!-- Edit profile link with an icon that triggers modal -->
                            <a href="#" class="custom-link mt-2" style="color: white;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fa-solid fa-user-pen"></i>
                                Edit Profile
                            </a>
                        </div>
                        <!-- User details -->
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Profile <?= $user['group_name'] ?></h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <!-- Email information -->
                                    <div class="col-6">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?= $user['email'] ?></p>
                                    </div>
                                    <!-- Phone number information -->
                                    <div class="col-6">
                                        <h6>Nomor Handphone</h6>
                                        <p class="text-muted"><?= $user['nomorhp'] ?></p>
                                    </div>
                                    <!-- Address information -->
                                    <div class="col-6">
                                        <h6>Alamat Rumah</h6>
                                        <p class="text-muted"><?= $user['alamat'] ?></p>
                                    </div>
                                    <!-- Created At information -->
                                    <div class="col-6">
                                        <h6>Terdaftar Sejak</h6>
                                        <p class="text-muted"><?= $user['created_at'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    </div>
</section>

<!-- End content section -->
<?= $this->endSection(); ?>