<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('template/') ?>assets/images/approve.png">

    <!-- Theme CSS -->
    <link href="<?= base_url('template/') ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/jquery-form-validator/form-validator/theme-default.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/css/theme.min.css">
    <title>Sign In | SIMPUN (Sistem Informasi Pengelolaan Usulan Pensiun)</title>
</head>

<body>
<noscript>
    <style>
        #main-login {
            display: none;
        }
        .disabled-js {
            position: absolute;
            width: 100%;
            height: 100vh;
            left:0;
            top:0;
            z-index: 9999;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h1{ /* even if this h1 is inside head tags it will be first hidden, so we have to display it again after all body elements are hidden*/
            display: block;
            color: red;
        }
    </style>
    <div class="disabled-js">
        <h1>JavaScript is not enabled, please check your browser settings.</h1>
    </div>
</noscript>
    <!-- container -->
    <div id="main-login" class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <img class="position-fixed z-n1 opacity-25"
                src="https://png.pngtree.com/thumb_back/fw800/background/20240430/pngtree-tree-planting-on-black-soil-in-forest-background-image_15722421.jpg" alt="Background"
                style="height: 100vh;margin:0;padding:0;top:0;left:0">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0 z-1">
                <!-- Logo ICON -->
                <!-- <div class="mx-auto text-center my-4"><i class="bi bi-browser-edge fs-1 text-primary "></i></div> -->
                <!-- Logo IMAGE -->
                <div class="my-4 d-flex gap-5 justify-content-center align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Lambang_Kabupaten_Balangan.png/640px-Lambang_Kabupaten_Balangan.png"
                        alt="Logo Kab. Balangan" width="50">
                    <!-- <img src="http://silka.balangankab.go.id/assets/silka3copy.png" alt="Logo Kab. Balangan"
                        width="150">
                    <img src="https://www.iosys.co.uk/images/ssl-security-encryption.png" alt="Logo Kab. Balangan"
                        width="100"> -->
                </div>
                <!-- Card -->
                <div class="card rounded-lg">
                    <!-- Card body -->
                    <div class="card-body p-6">
                        <div class="mb-4 text-center">
                            <a href="<?= base_url() ?>">
                                <h2 class="font-bold"><span class="text-primary text-xl">SIMPUN</span></h2>
                                <h4>Sistem Informasi Pengusulan Pensiun</h4>
                            </a>
                            <p class="mb-4">Layanan SILKa Integrasi, silahkan masuk menggukana akun sso anda.</p>
                        </div>
                        <?php
                        $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';
                        if (!$this->session->csrf_token) {
                            $this->session->csrf_token = hash('sha1', time());
                        }
                        ?>

                        <div>

                            <div class="d-grid mt-3">
                                <a href="<?= base_url("oauth/sso/authorize") ?>" class="btn btn-lg btn-success">
                                    Login with SSO</a>
                            </div>

                            <div class="d-md-flex justify-content-between mt-4">
                                <div>
                                    <a href="<?= base_url('auth/forget') ?>" class="text-inherit fs-5">Forgot your
                                        password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mx-auto mt-4 mb-3 text-center text-black">&copy; <?= date('Y') ?> Dikembangkan Oleh Bidang PPIK. Version <?= phpversion(); ?></p>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="<?= base_url('template/') ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script
        src="<?= base_url('template/') ?>assets/libs/jquery-form-validator/form-validator/jquery.form-validator.min.js">
    </script>

    <!-- Theme JS -->
    <script src="<?= base_url('template/') ?>assets/js/theme.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/auth.js"></script>
</body>

</html>