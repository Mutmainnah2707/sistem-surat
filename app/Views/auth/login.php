<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="<?= base_url('assetAdmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assetAdmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <style>
        .show-password-btn {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 1;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <!-- Display Flash Messages -->
                                    <?php if (session()->getFlashdata('success')) : ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('success') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Display Validation Errors -->
                                    <?php if (isset($validation)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Display Login Error -->
                                    <?php if (isset($error)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" action="<?= base_url('auth/authenticate') ?>" method="POST">
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user shadow-sm"
                                                id="exampleInputEmail" name="email"
                                                placeholder="Masukkan Email..." value="<?= old('email') ?>">
                                        </div>
                                        <div class="form-group position-relative">
                                            <input type="password" class="form-control form-control-user shadow-sm"
                                                id="exampleInputPassword" name="password" placeholder="Masukkan Password...">
                                            <span class="show-password-btn" onclick="togglePassword()">
                                                <i id="password-eye" class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        <button type="submit" class="btn btn-login btn-user btn-block">Login</button>
                                        <hr>
                                        <!-- Uncomment this if you have registration page -->
                                        <!-- <div class="text-center">
                                            <a class="small" href="<?= base_url('register') ?>">Belum punya akun? klik disini!</a>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assetAdmin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assetAdmin/js/sb-admin-2.min.js') ?>"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('exampleInputPassword');
            var passwordEye = document.getElementById('password-eye');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordEye.classList.remove('fa-eye');
                passwordEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordEye.classList.remove('fa-eye-slash');
                passwordEye.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
