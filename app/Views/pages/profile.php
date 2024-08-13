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
                            <!-- Edit profile link with an icon -->
                            <a href="/editprofile" class="custom-link mt-2" style="color: white;">
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
            </div>
        </div>

    </div>
</section>

<!-- End content section -->
<?= $this->endSection(); ?>